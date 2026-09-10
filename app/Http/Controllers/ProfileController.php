<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Afficher la page "Mon compte".
     */
    public function edit(): View
    {
        return view('settings.edit');
    }

    /**
     * Mettre à jour le nom et l'email.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ], [
            'email.unique' => 'Cet email est déjà utilisé par un autre compte.',
        ]);

        $user->update($validated);

        return redirect()
            ->route('settings.edit')
            ->with('success', 'Informations mises à jour avec succès.');
    }

    /**
     * Changer le mot de passe.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'password.confirmed' => 'La confirmation ne correspond pas au nouveau mot de passe.',
            'password.min'       => 'Le mot de passe doit contenir au moins 8 caractères.',
        ]);

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.'])
                ->withInput();
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('settings.edit')
            ->with('success', 'Mot de passe changé avec succès.');
    }
}