<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FournisseurController extends Controller
{
    /**
     * Afficher la liste des fournisseurs.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $fournisseurs = Fournisseur::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('city', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('fournisseurs.index', compact('fournisseurs', 'search'));
    }

    /**
     * Enregistrer un nouveau fournisseur.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'city'  => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        Fournisseur::create($validated);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur ajouté avec succès.');
    }

    /**
     * Mettre à jour un fournisseur existant.
     */
    public function update(Request $request, Fournisseur $fournisseur): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'city'  => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $fournisseur->update($validated);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur mis à jour avec succès.');
    }

    /**
     * Supprimer un fournisseur.
     */
    public function destroy(Fournisseur $fournisseur): RedirectResponse
    {
        $fournisseur->delete();

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur supprimé avec succès.');
    }
}