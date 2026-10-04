<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Product;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Afficher la liste des produits.
     */
    public function index(Request $request): View
    {
        $userId = auth()->id();
        $search = $request->query('search');

        $products = Product::where('user_id', $userId)
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('sku', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        $fournisseurs = Fournisseur::where('user_id', $userId)
            ->orderBy('name')
            ->get();

        return view('products.index', compact('products', 'search', 'fournisseurs'));
    }

    /**
     * Enregistrer un nouveau produit.
     */
    public function store(Request $request)
    {
        $userId = auth()->id();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products', 'sku')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'fournisseur_id' => [
                'nullable',
                Rule::exists('fournisseurs', 'id')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'category' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $product = Product::create([
            'user_id' => $userId,
            'name' => $validated['name'],
            'sku' => $validated['sku'] ?? null,
            'fournisseur_id' => $validated['fournisseur_id'] ?? null,
            'category' => $validated['category'] ?? null,
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'description' => $validated['description'] ?? null,
        ]);

        Activity::log('produit', 'Nouveau produit ajouté : ' . $product->name);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Afficher un produit.
     */
    public function show(Product $product)
    {
        $product = Product::where('user_id', auth()->id())
            ->findOrFail($product->id);

        return view('products.show', compact('product'));
    }

    /**
     * Modifier un produit.
     */
    public function update(Request $request, Product $product)
    {
        $userId = auth()->id();

        $product = Product::where('user_id', $userId)
            ->findOrFail($product->id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('products', 'sku')
                    ->where(fn ($query) => $query->where('user_id', $userId))
                    ->ignore($product->id),
            ],
            'category' => ['nullable', 'string', 'max:255'],
            'fournisseur_id' => [
                'nullable',
                Rule::exists('fournisseurs', 'id')->where(fn ($query) => $query->where('user_id', $userId)),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit modifié avec succès.');
    }

    /**
     * Supprimer un produit.
     */
    public function destroy(Product $product)
    {
        $product = Product::where('user_id', auth()->id())
            ->findOrFail($product->id);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}