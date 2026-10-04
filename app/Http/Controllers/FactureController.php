<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Devis;
use App\Models\Facture;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FactureController extends Controller
{
    /**
     * Liste des factures.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        $search = $request->query('search');
        $statut = $request->query('statut');

        $factures = Facture::with('client')
            ->where('user_id', $userId)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('numero', 'like', "%{$search}%")
                      ->orWhereHas('client', fn ($clientQuery) => $clientQuery->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($statut, fn ($query, $statut) => $query->where('statut', $statut))
            ->latest()
            ->get();

        return view('factures.index', compact('factures', 'search', 'statut'));
    }

    /**
     * Formulaire de création d'une facture.
     */
    public function create(): View
    {
        $userId = auth()->id();

        $clients = Client::where('user_id', $userId)->orderBy('name')->get();
        $products = Product::where('user_id', $userId)->orderBy('name')->get();
        $numero = Facture::genererNumero();

        return view('factures.create', compact('clients', 'products', 'numero'));
    }

    /**
     * Enregistrer une nouvelle facture avec ses lignes.
     */
    public function store(Request $request): RedirectResponse
    {
        $userId = auth()->id();

        $validated = $request->validate([
            'client_id' => [
                'required',
                Rule::exists('clients', 'id')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'date_facture' => ['required', 'date'],
            'date_echeance' => ['nullable', 'date', 'after_or_equal:date_facture'],
            'notes' => ['nullable', 'string'],
            'lignes' => ['required', 'array', 'min:1'],
            'lignes.*.product_id' => [
                'required',
                Rule::exists('products', 'id')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'lignes.*.quantite' => ['required', 'integer', 'min:1'],
            'lignes.*.prix_unitaire' => ['required', 'numeric', 'min:0'],
        ]);

        // Vérifier le stock AVANT création
        foreach ($validated['lignes'] as $ligne) {
            $product = Product::where('user_id', $userId)->findOrFail($ligne['product_id']);

            if ($product->stock < $ligne['quantite']) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'lignes' => "Stock insuffisant pour \"{$product->name}\" (disponible : {$product->stock}, demandé : {$ligne['quantite']})."
                    ]);
            }
        }

        $facture = Facture::create([
            'user_id'       => $userId,
            'numero'        => Facture::genererNumero(),
            'client_id'     => $validated['client_id'],
            'date_facture'  => $validated['date_facture'],
            'date_echeance' => $validated['date_echeance'] ?? null,
            'statut'        => 'en_attente',
            'notes'         => $validated['notes'] ?? null,
        ]);

        foreach ($validated['lignes'] as $ligne) {
            $product = Product::where('user_id', $userId)->findOrFail($ligne['product_id']);

            $facture->lignes()->create([
                'product_id'    => $product->id,
                'product_name'  => $product->name,
                'quantite'      => $ligne['quantite'],
                'prix_unitaire' => $ligne['prix_unitaire'],
                'total_ligne'   => $ligne['quantite'] * $ligne['prix_unitaire'],
            ]);

            $product->decrement('stock', $ligne['quantite']);
        }

        $facture->recalculerTotaux();

        Activity::log('facture', 'Facture ' . $facture->numero . ' créée pour ' . $facture->client->name);

        return redirect()
            ->route('factures.index')
            ->with('success', 'Facture créée avec succès.');
    }

    /**
     * Transforme un devis accepté en facture.
     */
    public function convertirDepuisDevis(Devis $devis): RedirectResponse
    {
        $userId = auth()->id();

        $devis = Devis::where('user_id', $userId)
            ->with('lignes', 'facture')
            ->findOrFail($devis->id);

        if ($devis->statut !== 'accepte') {
            return redirect()
                ->route('devis.show', $devis)
                ->with('error', 'Seul un devis accepté peut être transformé en facture.');
        }

        if ($devis->facture) {
            return redirect()
                ->route('factures.show', $devis->facture)
                ->with('success', 'Une facture existe déjà pour ce devis.');
        }

        foreach ($devis->lignes as $ligne) {
            $product = Product::where('user_id', $userId)->find($ligne->product_id);

            if (! $product || $product->stock < $ligne->quantite) {
                $nom = $product->name ?? $ligne->product_name;
                $disponible = $product->stock ?? 0;

                return redirect()
                    ->route('devis.show', $devis)
                    ->with('error', "Stock insuffisant pour \"{$nom}\" (disponible : {$disponible}, demandé : {$ligne->quantite}). Impossible de générer la facture.");
            }
        }

        $facture = Facture::creerDepuisDevis($devis);

        // sécurité si la méthode ne met pas encore user_id
        if ($facture->user_id !== $userId) {
            $facture->update(['user_id' => $userId]);
        }

        Activity::log('facture', 'Facture ' . $facture->numero . ' générée depuis le devis ' . $devis->numero);

        return redirect()
            ->route('factures.show', $facture)
            ->with('success', 'Facture créée à partir du devis ' . $devis->numero . '.');
    }

    /**
     * Afficher le détail d'une facture.
     */
    public function show(Facture $facture): View
    {
        $facture = Facture::where('user_id', auth()->id())
            ->with('client', 'devis', 'lignes.product')
            ->findOrFail($facture->id);

        return view('factures.show', compact('facture'));
    }

    /**
     * Changer le statut d'une facture.
     */
    public function updateStatut(Request $request, Facture $facture): RedirectResponse
    {
        $validated = $request->validate([
            'statut' => ['required', 'in:en_attente,payee,en_retard'],
        ]);

        $facture = Facture::where('user_id', auth()->id())->findOrFail($facture->id);

        $facture->update($validated);

        if ($validated['statut'] === 'payee') {
            Activity::log('facture', 'Facture ' . $facture->numero . ' marquée comme payée');
        }

        return redirect()
            ->route('factures.show', $facture)
            ->with('success', 'Statut mis à jour.');
    }

    /**
     * Supprimer une facture.
     */
    public function destroy(Facture $facture): RedirectResponse
    {
        $facture = Facture::where('user_id', auth()->id())->findOrFail($facture->id);

        $facture->delete();

        return redirect()
            ->route('factures.index')
            ->with('success', 'Facture supprimée.');
    }

    public function downloadPdf(Facture $facture)
    {
        $facture = Facture::where('user_id', auth()->id())
            ->with('client', 'lignes')
            ->findOrFail($facture->id);

        $pdf = Pdf::loadView('factures.pdf', compact('facture'))
            ->setPaper('a4');

        return $pdf->download($facture->numero . '.pdf');
    }
}