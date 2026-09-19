<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #171717;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .header-table td { vertical-align: top; padding: 0; }
        .brand-name { font-size: 22px; font-weight: bold; color: #D62828; margin: 0; }
        .brand-sub { font-size: 11px; color: #8B8B86; margin-top: 2px; }
        .doc-title { font-size: 20px; font-weight: bold; color: #0A0A0A; text-align: right; margin: 0; }
        .doc-number { font-size: 13px; color: #8B8B86; text-align: right; margin-top: 2px; font-family: monospace; }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
            color: #ffffff;
            background-color: #C9862F;
        }
        .status-payee { background-color: #16A34A; }
        .status-en_retard { background-color: #D62828; }

        .info-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .info-box {
            width: 48%;
            padding: 14px;
            background-color: #F5F3F1;
            border-radius: 6px;
        }
        .info-label { font-size: 9px; text-transform: uppercase; color: #8B8B86; font-weight: bold; letter-spacing: 1px; }
        .info-value { font-size: 13px; font-weight: bold; margin-top: 4px; }
        .info-detail { font-size: 11px; color: #8B8B86; margin-top: 3px; }

        table.lines { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.lines thead th {
            background-color: #D62828;
            color: #ffffff;
            font-size: 10px;
            text-transform: uppercase;
            padding: 8px 10px;
            text-align: left;
        }
        table.lines thead th.right { text-align: right; }
        table.lines tbody td {
            padding: 8px 10px;
            border-bottom: 1px solid #E6E6E3;
            font-size: 11.5px;
        }
        table.lines tbody td.right { text-align: right; font-family: monospace; }

        table.total-table { width: 100%; margin-top: 10px; }
        table.total-table td { padding: 4px 0; font-size: 12px; }
        table.total-table td.label { color: #8B8B86; }
        table.total-table td.value { text-align: right; font-family: monospace; font-weight: bold; }
        .total-row td { font-size: 16px; font-weight: bold; color: #D62828; border-top: 2px solid #0A0A0A; padding-top: 8px; }

        .footer { margin-top: 40px; text-align: center; font-size: 10px; color: #8B8B86; }
    </style>
</head>
<body>

    <table class="header-table">
        <tr>
            <td style="width: 50%;">
                <p class="brand-name">SwiftHub</p>
                <p class="brand-sub">Gestion commerciale</p>
            </td>
            <td style="width: 50%;">
                <p class="doc-title">FACTURE</p>
                <p class="doc-number">{{ $facture->numero }}</p>
            </td>
        </tr>
    </table>

    <table class="info-table">
        <tr>
            <td style="width: 48%;">
                <div class="info-box">
                    <div class="info-label">Facturé à</div>
                    <div class="info-value">{{ $facture->client->name }}</div>
                    <div class="info-detail">{{ $facture->client->email }}</div>
                    @if($facture->client->phone)
                        <div class="info-detail">{{ $facture->client->phone }}</div>
                    @endif
                </div>
            </td>
            <td style="width: 4%;"></td>
            <td style="width: 48%;">
                <div class="info-box">
                    <div class="info-label">Détails</div>
                    <div class="info-detail">Date d'émission : <strong>{{ $facture->date_facture->format('d/m/Y') }}</strong></div>
                    @if($facture->date_echeance)
                        <div class="info-detail">Échéance : <strong>{{ $facture->date_echeance->format('d/m/Y') }}</strong></div>
                    @endif
                    <div class="info-detail" style="margin-top: 6px;">
                        Statut :
                        <span class="status-badge status-{{ $facture->statut }}">
                            @switch($facture->statut)
                                @case('payee') Payée @break
                                @case('en_retard') En retard @break
                                @default En attente
                            @endswitch
                        </span>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <table class="lines">
        <thead>
            <tr>
                <th>Produit / Service</th>
                <th class="right">Quantité</th>
                <th class="right">Prix unitaire</th>
                <th class="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facture->lignes as $ligne)
            <tr>
                <td>{{ $ligne->product_name }}</td>
                <td class="right">{{ $ligne->quantite }}</td>
                <td class="right">{{ number_format($ligne->prix_unitaire, 2) }} DH</td>
                <td class="right">{{ number_format($ligne->total_ligne, 2) }} DH</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="total-table">
        <tr>
            <td class="label" style="width: 80%;">Total HT</td>
            <td class="value" style="width: 20%;">{{ number_format($facture->total_ht, 2) }} DH</td>
        </tr>
        <tr class="total-row">
            <td>Total TTC</td>
            <td class="value">{{ number_format($facture->total_ttc, 2) }} DH</td>
        </tr>
    </table>

    @if($facture->notes)
        <div style="margin-top: 25px; padding: 12px; background-color: #F5F3F1; border-radius: 6px; font-size: 11px; color: #3F3F3D;">
            <strong>Notes :</strong> {{ $facture->notes }}
        </div>
    @endif

    <div class="footer">
        Document généré par SwiftHub — Gestion commerciale
    </div>

</body>
</html>