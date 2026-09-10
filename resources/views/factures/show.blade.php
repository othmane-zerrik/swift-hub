<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $facture->numero }} - SwiftHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #0A0A0A; --bg: #FFFFFF; --border: #E6E6E3; --hover: #FBF1F1;
            --text: #171717; --muted: #8B8B86; --accent: #D62828; --accent-soft: #FCE8E8;
            --green: #16A34A; --green-soft: #E8F7EE; --amber: #C9862F; --amber-soft: #FBF0E1;
            --gray-soft: #F1F1EF; --font-body: 'Plus Jakarta Sans', sans-serif; --font-mono: 'JetBrains Mono', monospace;
        }
        body { font-family: var(--font-body); background: var(--bg); color: var(--text); }
        .font-mono { font-family: var(--font-mono); }
        h1, h2, h3 { font-family: var(--font-body); letter-spacing: -0.02em; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 8px; text-align: left; font-size: 14px; }
        thead th { color: var(--muted); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.03em; border-bottom: 1px solid var(--border); }
        tbody tr { border-bottom: 1px solid var(--border); }
        .badge { font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 999px; display: inline-block; }
        .badge-en_attente { background: var(--amber-soft); color: var(--amber); }
        .badge-payee { background: var(--green-soft); color: var(--green); }
        .badge-en_retard { background: var(--accent-soft); color: var(--accent); }
        .field-input { border: 1px solid var(--border); border-radius: 10px; padding: 10px 14px; font-size: 14px; }
    </style>
</head>
<body class="text-[16px]">

<div class="max-w-3xl mx-auto p-8">

    <div class="flex items-start justify-between mb-8">
        <div>
            <a href="{{ route('factures.index') }}" class="text-sm font-semibold flex items-center gap-1 mb-3" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Retour aux factures
            </a>
            <div class="flex items-center gap-3">
                <h2 class="text-2xl font-extrabold tracking-tight font-mono">{{ $facture->numero }}</h2>
                <span class="badge badge-{{ $facture->statut }}">
                    @switch($facture->statut)
                        @case('en_attente') En attente @break
                        @case('payee') Payée @break
                        @case('en_retard') En retard @break
                    @endswitch
                </span>
            </div>
            <p class="text-[15px] mt-1" style="color: var(--muted);">
                Émise le {{ $facture->date_facture->format('d/m/Y') }}
                @if($facture->date_echeance) — échéance le {{ $facture->date_echeance->format('d/m/Y') }} @endif
            </p>
            @if($facture->devis)
                <p class="text-sm mt-1" style="color: var(--muted);">
                    Générée depuis le devis
                    <a href="{{ route('devis.show', $facture->devis) }}" class="font-semibold underline" style="color: var(--accent);">{{ $facture->devis->numero }}</a>
                </p>
            @endif
        </div>

        <form method="POST" action="{{ route('factures.destroy', $facture) }}" onsubmit="return confirm('Supprimer cette facture ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 rounded-lg text-sm font-semibold transition hover:bg-[var(--hover)]" style="color: var(--accent);">
                Supprimer
            </button>
        </form>
    </div>

    <div class="rounded-2xl p-6 mb-6" style="border: 1px solid var(--border);">
        <div class="mb-6 pb-6" style="border-bottom: 1px solid var(--border);">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color: var(--muted);">Client</p>
            <p class="font-semibold mt-1">{{ $facture->client->name }}</p>
            <p class="text-sm" style="color: var(--muted);">{{ $facture->client->email }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th style="text-align:center;">Qté</th>
                    <th style="text-align:right;">Prix unit.</th>
                    <th style="text-align:right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facture->lignes as $ligne)
                <tr>
                    <td>{{ $ligne->product_name }}</td>
                    <td style="text-align:center;">{{ $ligne->quantite }}</td>
                    <td style="text-align:right;" class="font-mono">{{ number_format($ligne->prix_unitaire, 2) }} DH</td>
                    <td style="text-align:right;" class="font-mono font-semibold">{{ number_format($ligne->total_ligne, 2) }} DH</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex items-center justify-end gap-4 mt-6 pt-6" style="border-top: 1px solid var(--border);">
            <p class="font-semibold" style="color: var(--muted);">Total</p>
            <p class="font-mono text-3xl font-bold">{{ number_format($facture->total_ttc, 2) }} DH</p>
        </div>
    </div>

    <div class="rounded-2xl p-6" style="border: 1px solid var(--border);">
        <p class="font-bold mb-3">Changer le statut</p>
        <form method="POST" action="{{ route('factures.statut', $facture) }}" class="flex items-center gap-3">
            @csrf
            @method('PUT')
            <select name="statut" class="field-input">
                <option value="en_attente" @selected($facture->statut === 'en_attente')>En attente</option>
                <option value="payee" @selected($facture->statut === 'payee')>Payée</option>
                <option value="en_retard" @selected($facture->statut === 'en_retard')>En retard</option>
            </select>
            <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                Mettre à jour
            </button>
        </form>
    </div>

</div>
</body>
</html>