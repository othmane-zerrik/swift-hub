<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Facture;
use Illuminate\View\View;

class FinanceController extends Controller
{
    /**
     * Vue d'ensemble financière : chiffre d'affaires, crédits clients/fournisseurs.
     */
    public function index(): View
    {
        $userId = auth()->id();

        // --- Chiffre d'affaires (basé sur les factures payées) ---
        $caTotal = Facture::where('user_id', $userId)
            ->where('statut', 'payee')
            ->sum('total_ttc');

        $caMoisCourant = Facture::where('user_id', $userId)
            ->where('statut', 'payee')
            ->whereMonth('date_facture', now()->month)
            ->whereYear('date_facture', now()->year)
            ->sum('total_ttc');

        $enAttentePaiement = Facture::where('user_id', $userId)
            ->where('statut', 'en_attente')
            ->sum('total_ttc');

        $enRetardPaiement = Facture::where('user_id', $userId)
            ->where('statut', 'en_retard')
            ->sum('total_ttc');

        // --- Chiffre d'affaires des 6 derniers mois ---
        $caParMois = collect(range(5, 0))->map(function ($i) use ($userId) {
            $date = now()->subMonths($i);

            return [
                'label' => $date->translatedFormat('M'),
                'montant' => Facture::where('user_id', $userId)
                    ->where('statut', 'payee')
                    ->whereMonth('date_facture', $date->month)
                    ->whereYear('date_facture', $date->year)
                    ->sum('total_ttc'),
            ];
        });

        $caMaxMois = $caParMois->max('montant') ?: 1;

        // --- Crédits clients (ce qu'on nous doit) ---
        $creditsClients = Credit::where('user_id', $userId)
            ->where('type', 'client')
            ->get();

        $totalDuParClients = $creditsClients->sum('montant_restant');
        $totalRecuClients = $creditsClients->sum('montant_paye');

        // --- Crédits fournisseurs (ce qu'on doit) ---
        $creditsFournisseurs = Credit::where('user_id', $userId)
            ->where('type', 'fournisseur')
            ->get();

        $totalDuAuxFournisseurs = $creditsFournisseurs->sum('montant_restant');
        $totalPayeFournisseurs = $creditsFournisseurs->sum('montant_paye');

        return view('finances.index', compact(
            'caTotal',
            'caMoisCourant',
            'enAttentePaiement',
            'enRetardPaiement',
            'caParMois',
            'caMaxMois',
            'totalDuParClients',
            'totalRecuClients',
            'totalDuAuxFournisseurs',
            'totalPayeFournisseurs'
        ));
    }
}