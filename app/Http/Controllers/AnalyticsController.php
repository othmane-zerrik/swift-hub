<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Facture;
use App\Models\FactureLigne;
use App\Models\Product;
use Illuminate\View\View;

class AnalyticsController extends Controller
{
    public function index(): View
    {
        $userId = auth()->id();

        // --- 1. Taux de conversion des devis ---
        $totalDevis = Devis::where('user_id', $userId)->count();

        $devisAcceptes = Devis::where('user_id', $userId)
            ->where('statut', 'accepte')
            ->count();

        $devisRefuses = Devis::where('user_id', $userId)
            ->where('statut', 'refuse')
            ->count();

        $devisEnAttente = Devis::where('user_id', $userId)
            ->whereIn('statut', ['brouillon', 'envoye'])
            ->count();

        $tauxConversion = $totalDevis > 0
            ? round(($devisAcceptes / $totalDevis) * 100, 1)
            : 0;

        // --- 2. Top 5 clients par chiffre d'affaires ---
        $topClients = Facture::selectRaw('client_id, SUM(total_ttc) as total')
            ->where('user_id', $userId)
            ->with('client')
            ->groupBy('client_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get()
            ->filter(fn ($facture) => $facture->client !== null);

        // --- 3. Top 5 produits les plus vendus ---
        $topProduits = FactureLigne::join('factures', 'facture_lignes.facture_id', '=', 'factures.id')
            ->where('factures.user_id', $userId)
            ->selectRaw('
                facture_lignes.product_id,
                facture_lignes.product_name,
                SUM(facture_lignes.quantite) as total_quantite,
                SUM(facture_lignes.total_ligne) as total_montant
            ')
            ->groupBy('facture_lignes.product_id', 'facture_lignes.product_name')
            ->orderByDesc('total_quantite')
            ->limit(5)
            ->get();

        // --- 4. Alertes stock bas ---
        $produitsStockBas = Product::where('user_id', $userId)
            ->where('stock', '<=', Product::LOW_STOCK_THRESHOLD)
            ->orderBy('stock')
            ->get();

        // --- 5. Comparaison mois actuel vs mois précédent ---
        $moisActuel = now();
        $moisPrecedent = now()->subMonth();

        $caMoisActuel = Facture::where('user_id', $userId)
            ->where('statut', 'payee')
            ->whereMonth('date_facture', $moisActuel->month)
            ->whereYear('date_facture', $moisActuel->year)
            ->sum('total_ttc');

        $caMoisPrecedent = Facture::where('user_id', $userId)
            ->where('statut', 'payee')
            ->whereMonth('date_facture', $moisPrecedent->month)
            ->whereYear('date_facture', $moisPrecedent->year)
            ->sum('total_ttc');

        $ventesMoisActuel = Facture::where('user_id', $userId)
            ->whereMonth('date_facture', $moisActuel->month)
            ->whereYear('date_facture', $moisActuel->year)
            ->count();

        $ventesMoisPrecedent = Facture::where('user_id', $userId)
            ->whereMonth('date_facture', $moisPrecedent->month)
            ->whereYear('date_facture', $moisPrecedent->year)
            ->count();

        $evolutionCa = $caMoisPrecedent > 0
            ? round((($caMoisActuel - $caMoisPrecedent) / $caMoisPrecedent) * 100, 1)
            : ($caMoisActuel > 0 ? 100 : 0);

        $evolutionVentes = $ventesMoisPrecedent > 0
            ? round((($ventesMoisActuel - $ventesMoisPrecedent) / $ventesMoisPrecedent) * 100, 1)
            : ($ventesMoisActuel > 0 ? 100 : 0);

        return view('analytics.index', compact(
            'totalDevis',
            'devisAcceptes',
            'devisRefuses',
            'devisEnAttente',
            'tauxConversion',
            'topClients',
            'topProduits',
            'produitsStockBas',
            'caMoisActuel',
            'caMoisPrecedent',
            'evolutionCa',
            'ventesMoisActuel',
            'ventesMoisPrecedent',
            'evolutionVentes',
            'moisActuel',
            'moisPrecedent'
        ));
    }
}