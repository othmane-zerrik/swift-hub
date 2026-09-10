<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Devis;
use App\Models\DevisLigne;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\View\View;

class DevisController extends Controller
{
    /**
     * Liste des devis.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $statut = $request->query('statut');

        $devis = Devis::with('client')
            ->when($search, function ($query, $search) {
                $query->where('numero', 'like', "%{$search}%")
                      ->orWhereHas('client', fn ($q) => $q->where('name', 'like', "%{$search}%"));
            })
            ->when($statut, fn ($query, $statut) => $query->where('statut', $statut))
            ->latest()
            ->get();

        return view('devis.index', compact('devis', 'search', 'statut'));
    }

    /**
     * Formulaire de création d'un devis.
     */
    public function create(): View
    {
        $clients = Client::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $numero = Devis::genererNumero();

        return view('devis.create', compact('clients', 'products', 'numero'));
    }

    /**
     * Enregistrer un nouveau devis avec ses lignes.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_id'                => ['required', 'exists:clients,id'],
            'date_devis'               => ['required', 'date'],
            'date_validite'            => ['nullable', 'date', 'after_or_equal:date_devis'],
            'notes'                    => ['nullable', 'string'],
            'lignes'                   => ['required', 'array', 'min:1'],
            'lignes.*.product_id'      => ['required', 'exists:products,id'],
            'lignes.*.quantite'        => ['required', 'integer', 'min:1'],
            'lignes.*.prix_unitaire'   => ['required', 'numeric', 'min:0'],
        ]);

        $devis = Devis::create([
            'numero'        => Devis::genererNumero(),
            'client_id'     => $validated['client_id'],
            'date_devis'    => $validated['date_devis'],
            'date_validite' => $validated['date_validite'] ?? null,
            'statut'        => 'brouillon',
            'notes'         => $validated['notes'] ?? null,
        ]);

        foreach ($validated['lignes'] as $ligne) {
            $product = Product::findOrFail($ligne['product_id']);

            $devis->lignes()->create([
                'product_id'    => $product->id,
                'product_name'  => $product->name,
                'quantite'      => $ligne['quantite'],
                'prix_unitaire' => $ligne['prix_unitaire'],
                'total_ligne'   => $ligne['quantite'] * $ligne['prix_unitaire'],
            ]);
        }

        $devis->recalculerTotaux();

 
        Activity::log('devis', 'Devis ' . $devis->numero . ' créé pour ' . $devis->client->name);
        return redirect()
            ->route('devis.index')
            ->with('success', 'Devis créé avec succès.');
    }

    /**
     * Afficher le détail d'un devis (côté équipe, connecté).
     */
    public function show(Devis $devis): View
    {
        $devis->load('client', 'lignes.product');

        $lienClient = static::lienConsultation($devis);

        return view('devis.show', compact('devis', 'lienClient'));
    }

    /**
     * Changer le statut d'un devis (ex: envoyé manuellement).
     */
    public function updateStatut(Request $request, Devis $devis): RedirectResponse
    {
        $validated = $request->validate([
            'statut' => ['required', 'in:brouillon,envoye,accepte,refuse'],
        ]);

        $devis->update($validated);

        return redirect()
            ->route('devis.show', $devis)
            ->with('success', 'Statut mis à jour.');
    }

    /**
     * Supprimer un devis.
     */
    public function destroy(Devis $devis): RedirectResponse
    {
        $devis->delete();

        return redirect()
            ->route('devis.index')
            ->with('success', 'Devis supprimé.');
    }

    /**
     * Génère le lien public signé (valable 30 jours) à envoyer au client.
     */
    public static function lienConsultation(Devis $devis): string
    {
        return URL::temporarySignedRoute(
            'devis.consulter',
            now()->addDays(30),
            ['devis' => $devis->id]
        );
    }

    /**
     * Page publique consultée par le client (sans compte, via lien signé).
     */
    public function consulter(Devis $devis): View
    {
        $devis->load('client', 'lignes');

        $accepterUrl = URL::temporarySignedRoute('devis.accepter', now()->addDays(30), ['devis' => $devis->id]);
        $refuserUrl  = URL::temporarySignedRoute('devis.refuser', now()->addDays(30), ['devis' => $devis->id]);

        return view('devis.consulter', compact('devis', 'accepterUrl', 'refuserUrl'));
    }

    /**
     * Le client accepte le devis (via lien signé).
     */
    public function accepter(Devis $devis): View
    {
       
         if ($devis->statut === 'brouillon' || $devis->statut === 'envoye') {
            $devis->update(['statut' => 'accepte']);
            Activity::log('devis', 'Devis ' . $devis->numero . ' accepté par le client');
        }

        $devis->load('client', 'lignes');

        return view('devis.consulter', ['devis' => $devis, 'reponse' => 'accepte']);
    }

    /**
     * Le client refuse le devis (via lien signé).
     */
    public function refuser(Devis $devis): View
    {
       
        if ($devis->statut === 'brouillon' || $devis->statut === 'envoye') {
            $devis->update(['statut' => 'refuse']);
            Activity::log('devis', 'Devis ' . $devis->numero . ' refusé par le client');
        }
        $devis->load('client', 'lignes');

        return view('devis.consulter', ['devis' => $devis, 'reponse' => 'refuse']);
    }
}