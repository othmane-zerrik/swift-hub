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
        $userId = auth()->id();
        $search = $request->query('search');

        $fournisseurs = Fournisseur::where('user_id', $userId)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('city', 'like', "%{$search}%");
                });
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
        $userId = auth()->id();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'city'  => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        Fournisseur::create([
            'user_id' => $userId,
            'name'    => $validated['name'],
            'email'   => $validated['email'] ?? null,
            'phone'   => $validated['phone'] ?? null,
            'city'    => $validated['city'] ?? null,
            'notes'   => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur ajouté avec succès.');
    }

    /**
     * Mettre à jour un fournisseur existant.
     */
    public function update(Request $request, Fournisseur $fournisseur): RedirectResponse
    {
        $userId = auth()->id();

        $fournisseur = Fournisseur::where('user_id', $userId)
            ->findOrFail($fournisseur->id);

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
        $fournisseur = Fournisseur::where('user_id', auth()->id())
            ->findOrFail($fournisseur->id);

        $fournisseur->delete();

        return redirect()
            ->route('fournisseurs.index')
            ->with('success', 'Fournisseur supprimé avec succès.');
    }
}