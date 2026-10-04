<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Credit;
use App\Models\Fournisseur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CreditController extends Controller
{
    /**
     * Liste des crédits (clients et fournisseurs), triés par échéance la plus proche.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        $type = $request->query('type');

        $credits = Credit::where('user_id', $userId)
            ->when($type, fn ($query, $type) => $query->where('type', $type))
            ->orderBy('date_echeance')
            ->get();

        return view('credits.index', compact('credits', 'type'));
    }

    /**
     * Formulaire de création d'un crédit.
     */
    public function create(): View
    {
        $userId = auth()->id();

        $clients = Client::where('user_id', $userId)
            ->orderBy('name')
            ->get();

        $fournisseurs = Fournisseur::where('user_id', $userId)
            ->orderBy('name')
            ->get();

        return view('credits.create', compact('clients', 'fournisseurs'));
    }

    /**
     * Enregistrer un nouveau crédit.
     */
    public function store(Request $request): RedirectResponse
    {
        $userId = auth()->id();

        $validated = $request->validate([
            'type' => ['required', 'in:client,fournisseur'],
            'client_id' => [
                'nullable',
                'required_if:type,client',
                Rule::exists('clients', 'id')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'fournisseur_id' => [
                'nullable',
                'required_if:type,fournisseur',
                Rule::exists('fournisseurs', 'id')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'montant' => ['required', 'numeric', 'min:0.01'],
            'date_credit' => ['required', 'date'],
            'date_echeance' => ['required', 'date', 'after_or_equal:date_credit'],
            'notes' => ['nullable', 'string'],
        ]);

        if ($validated['type'] === 'client') {
            $client = Client::where('user_id', $userId)->findOrFail($validated['client_id']);
            $validated['tiers_nom'] = $client->name;
            $validated['fournisseur_id'] = null;
        } else {
            $fournisseur = Fournisseur::where('user_id', $userId)->findOrFail($validated['fournisseur_id']);
            $validated['tiers_nom'] = $fournisseur->name;
            $validated['client_id'] = null;
        }

        Credit::create([
            'user_id' => $userId,
            'type' => $validated['type'],
            'client_id' => $validated['client_id'] ?? null,
            'fournisseur_id' => $validated['fournisseur_id'] ?? null,
            'tiers_nom' => $validated['tiers_nom'],
            'montant' => $validated['montant'],
            'date_credit' => $validated['date_credit'],
            'date_echeance' => $validated['date_echeance'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('credits.index')
            ->with('success', 'Crédit enregistré avec succès.');
    }

    /**
     * Enregistrer un paiement (partiel ou total) sur un crédit.
     */
    public function enregistrerPaiement(Request $request, Credit $credit): RedirectResponse
    {
        $credit = Credit::where('user_id', auth()->id())->findOrFail($credit->id);

        $validated = $request->validate([
            'montant_paiement' => ['required', 'numeric', 'min:0.01', 'max:' . $credit->montant_restant],
        ]);

        $credit->update([
            'montant_paye' => $credit->montant_paye + $validated['montant_paiement'],
        ]);

        return redirect()
            ->route('credits.index')
            ->with('success', 'Paiement enregistré.');
    }

    /**
     * Supprimer un crédit.
     */
    public function destroy(Credit $credit): RedirectResponse
    {
        $credit = Credit::where('user_id', auth()->id())->findOrFail($credit->id);

        $credit->delete();

        return redirect()
            ->route('credits.index')
            ->with('success', 'Crédit supprimé.');
    }
}