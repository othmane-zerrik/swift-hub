<?php

namespace App\Http\Controllers;
use App\Models\Activity;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Afficher la liste des produits.
     */
   public function index(Request $request): View
{
    $search = $request->query('search');

    $products = Product::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

    $fournisseurs = \App\Models\Fournisseur::orderBy('name')->get();

    return view('products.index', compact('products', 'search', 'fournisseurs'));
}
    /**
     * Enregistrer un nouveau produit.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:255', 'unique:products,sku'],
            'fournisseur_id' => ['nullable', 'exists:fournisseurs,id'],
            'category' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ]);

    

        $product = Product::create($validated);
 
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
        return view('products.show', compact('product'));
    }

    /**
     * Modifier un produit.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'sku' => [
                'nullable',
                'string',
                'max:255',
                'unique:products,sku,' . $product->id,
            ],

            'category' => ['nullable', 'string', 'max:255'],
            'fournisseur_id' => ['nullable', 'exists:fournisseurs,id'],
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
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}