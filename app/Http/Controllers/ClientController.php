<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{

  public function index(Request $request): View
{
    $search = $request->query('search');

    $clients = Client::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

    return view('clients.index', compact('clients', 'search'));
}

   


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'city'  => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        Client::create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client ajouté avec succès.');
    }

    


    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:clients,email,' . $client->id],
            'phone' => ['nullable', 'string', 'max:30'],
            'city'  => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client mis à jour avec succès.');
    }

    

    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Client supprimé avec succès.');
    }
}