<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    /**
     * Affiche le rapport de ventes pour une période donnée.
     */
    public function index(Request $request): View
    {
        $periode = $request->query('periode', 'ce_mois');

        [$debut, $fin] = $this->resoudrePeriode($periode, $request);

        $factures = $this->facturesPourPeriode($debut, $fin);

        return view('reports.index', [
            'factures'       => $factures,
            'totalHt'        => $factures->sum('total_ht'),
            'totalTtc'       => $factures->sum('total_ttc'),
            'nombreFactures' => $factures->count(),
            'periode'        => $periode,
            'debut'          => $debut,
            'fin'            => $fin,
        ]);
    }

    /**
     * Exporte le rapport de l'utilisateur connecté en CSV.
     */
    public function exportCsv(Request $request): StreamedResponse
    {
        $periode = $request->query('periode', 'ce_mois');

        [$debut, $fin] = $this->resoudrePeriode($periode, $request);

        $factures = $this->facturesPourPeriode($debut, $fin);

        $nomFichier = 'rapport_ventes_'
            . $debut->format('Y-m-d')
            . '_'
            . $fin->format('Y-m-d')
            . '.csv';

        $callback = function () use ($factures) {

            $handle = fopen('php://output', 'w');

            // BOM UTF-8 pour Excel
            fwrite($handle, "\xEF\xBB\xBF");

            // Séparateur Excel
            fwrite($handle, "SEP=;\r\n");

            // En-têtes
            fputcsv($handle, [
                'Numéro',
                'Client',
                'Date',
                'Statut',
                'Total HT (DH)',
                'Total TTC (DH)',
            ], ';');

            // Factures de l'utilisateur connecté uniquement
            foreach ($factures as $facture) {

                fputcsv($handle, [
                    $facture->numero,
                    $facture->client->name ?? 'Client supprimé',
                    $facture->date_facture->format('d/m/Y'),
                    $this->libelleStatut($facture->statut),
                    number_format(
                        (float) $facture->total_ht,
                        2,
                        ',',
                        ''
                    ),
                    number_format(
                        (float) $facture->total_ttc,
                        2,
                        ',',
                        ''
                    ),
                ], ';');
            }

            // Total
            fputcsv($handle, [
                '',
                '',
                '',
                'TOTAL',
                number_format(
                    (float) $factures->sum('total_ht'),
                    2,
                    ',',
                    ''
                ),
                number_format(
                    (float) $factures->sum('total_ttc'),
                    2,
                    ',',
                    ''
                ),
            ], ';');

            fclose($handle);
        };

        return response()->streamDownload(
            $callback,
            $nomFichier,
            [
                'Content-Type' => 'text/csv; charset=UTF-8',
            ]
        );
    }

    /**
     * Récupère uniquement les factures appartenant
     * à l'utilisateur connecté.
     */
    private function facturesPourPeriode(
        Carbon $debut,
        Carbon $fin
    ): Collection {

        return Facture::with('client')
            ->where('user_id', auth()->id())
            ->whereBetween('date_facture', [$debut, $fin])
            ->orderBy('date_facture')
            ->get();
    }

    /**
     * Libellés lisibles des statuts.
     */
    private function libelleStatut(?string $statut): string
    {
        return match ($statut) {
            'payee'     => 'Payée',
            'en_retard' => 'En retard',
            'annulee'   => 'Annulée',
            default     => 'En attente',
        };
    }

    /**
     * Convertit le nom de période en date de début et de fin.
     */
    private function resoudrePeriode(
        string $periode,
        Request $request
    ): array {

        return match ($periode) {

            'mois_dernier' => [
                now()->subMonthNoOverflow()->startOfMonth(),
                now()->subMonthNoOverflow()->endOfMonth(),
            ],

            'cette_annee' => [
                now()->startOfYear(),
                now()->endOfYear(),
            ],

            'personnalise' => [
                Carbon::parse(
                    $request->query(
                        'date_debut',
                        now()->startOfMonth()->toDateString()
                    )
                ),

                Carbon::parse(
                    $request->query(
                        'date_fin',
                        now()->toDateString()
                    )
                ),
            ],

            default => [
                now()->startOfMonth(),
                now()->endOfMonth(),
            ],
        };
    }
}
