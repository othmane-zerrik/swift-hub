<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Credit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CreditController extends Controller
{
    /**
     * Liste des crédits (clients et fournisseurs), triés par échéance la plus proche.
     */
    public function index(Request $request): View
    {
        $type = $request->query('type'); // 'client', 'fournisseur', ou vide = tous

        $credits = Credit::when($type, fn ($query, $type) => $query->where('type', $type))
            ->orderBy('date_echeance')
            ->get();

        return view('credits.index', compact('credits', 'type'));
    }

    /**
     * Formulaire de création d'un crédit.
     */
    

    /**
     * Enregistrer un nouveau crédit.
     */
    public function store(Request $request): RedirectResponse
    {
          $validated = $request->validate([
            'type'           => ['required', 'in:client,fournisseur'],
            'client_id'      => ['nullable', 'required_if:type,client', 'exists:clients,id'],
            'fournisseur_id' => ['nullable', 'required_if:type,fournisseur', 'exists:fournisseurs,id'],
            'montant'        => ['required', 'numeric', 'min:0.01'],
            'date_credit'    => ['required', 'date'],
            'date_echeance'  => ['required', 'date', 'after_or_equal:date_credit'],
            'notes'          => ['nullable', 'string'],
        ]);
 
        if ($validated['type'] === 'client') {
            $client = \App\Models\Client::findOrFail($validated['client_id']);
            $validated['tiers_nom'] = $client->name;
            $validated['fournisseur_id'] = null;
        } else {
            $fournisseur = \App\Models\Fournisseur::findOrFail($validated['fournisseur_id']);
            $validated['tiers_nom'] = $fournisseur->name;
            $validated['client_id'] = null;
        }
 
        Credit::create($validated);

        return redirect()
            ->route('credits.index')
            ->with('success', 'Crédit enregistré avec succès.');
    }

    /**
     * Enregistrer un paiement (partiel ou total) sur un crédit.
     */
    public function enregistrerPaiement(Request $request, Credit $credit): RedirectResponse
    {
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
        $credit->delete();

        return redirect()
            ->route('credits.index')
            ->with('success', 'Crédit supprimé.');
    }
    public function create(): View
    {
        $clients = Client::orderBy('name')->get();
        $fournisseurs = \App\Models\Fournisseur::orderBy('name')->get();
 
        return view('credits.create', compact('clients', 'fournisseurs'));
    }
}