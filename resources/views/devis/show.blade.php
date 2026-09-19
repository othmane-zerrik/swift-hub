<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Devis {{ $devis->numero }} - SwiftHub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --ink: #0A0A0A;
            --bg: #FFFFFF;
            --surface: #FFFFFF;
            --border: #E6E6E3;
            --hover: #FBF1F1;
            --text: #171717;
            --muted: #8B8B86;
            --accent: #D62828;
            --accent-soft: #FCE8E8;
            --green: #16A34A;
            --green-soft: #E8F7EE;
            --gray-soft: #F1F1EF;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }
        body { font-family: var(--font-body); background: var(--bg); color: var(--text); }
        .font-mono { font-family: var(--font-mono); }
        h1, h2, h3 { font-family: var(--font-body); letter-spacing: -0.02em; }

        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 8px; text-align: left; font-size: 14px; }
        thead th { color: var(--muted); font-weight: 600; font-size: 12px; text-transform: uppercase; letter-spacing: 0.03em; border-bottom: 1px solid var(--border); }
        tbody tr { border-bottom: 1px solid var(--border); }

        .badge { font-size: 12px; font-weight: 600; padding: 4px 12px; border-radius: 999px; display: inline-block; }
        .badge-brouillon { background: var(--gray-soft); color: #5F5E5A; }
        .badge-envoye { background: #E6F1FB; color: #185FA5; }
        .badge-accepte { background: var(--green-soft); color: var(--green); }
        .badge-refuse { background: var(--accent-soft); color: var(--accent); }

        .field-input {
            border: 1px solid var(--border); border-radius: 10px;
            padding: 10px 14px; font-size: 14px; font-family: var(--font-mono);
            background: var(--gray-soft); color: var(--text);
        }

        .copy-btn { transition: background .15s ease; }
        .copy-btn:hover { background: var(--hover); }
    </style>
</head>

<body class="text-[16px]">
    
<div class="max-w-3xl mx-auto p-8">
     @if(session('error'))
        <div class="rounded-xl p-4 mb-6" style="background: var(--accent-soft); border: 1px solid #F5C2C2;">
            <p class="font-semibold text-sm" style="color: var(--accent);">{{ session('error') }}</p>
        </div>
    @endif
    {{-- HEADER --}}
    <div class="flex items-start justify-between mb-8">
        <div>
            <a href="{{ route('devis.index') }}" class="text-sm font-semibold flex items-center gap-1 mb-3" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Retour aux devis
            </a>
        
            <div class="flex items-center gap-3">
                <h2 class="text-2xl font-extrabold tracking-tight font-mono">{{ $devis->numero }}</h2>
                <span class="badge badge-{{ $devis->statut }}">
                    @switch($devis->statut)
                        @case('brouillon') Brouillon @break
                        @case('envoye') Envoyé @break
                        @case('accepte') Accepté @break
                        @case('refuse') Refusé @break
                    @endswitch
                </span>
            </div>
            <p class="text-[15px] mt-1" style="color: var(--muted);">
                Créé le {{ $devis->date_devis->format('d/m/Y') }}
                @if($devis->date_validite) — valable jusqu'au {{ $devis->date_validite->format('d/m/Y') }} @endif
            </p>
        </div>

        <form method="POST" action="{{ route('devis.destroy', $devis) }}" onsubmit="return confirm('Supprimer ce devis ?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 rounded-lg text-sm font-semibold transition hover:bg-[var(--hover)]" style="color: var(--accent);">
                Supprimer
            </button>
        </form>
    </div>

    {{-- Lien de consultation client --}}
    <div class="rounded-2xl p-6 mb-6" style="background: var(--accent-soft); border: 1px solid #F5C2C2;">
        <div class="flex items-center gap-2 mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757M10.81 15.312a4.5 4.5 0 0 1-1.242-7.244l4.5-4.5a4.5 4.5 0 0 1 6.364 6.364l-1.757 1.757" />
            </svg>
            <p class="font-bold" style="color: var(--accent);">Lien à envoyer au client</p>
        </div>
        <p class="text-sm mb-3" style="color: #993C1D;">
            Envoie ce lien par WhatsApp ou email. Le client pourra voir le devis et l'accepter ou le refuser, sans créer de compte.
        </p>
        <div class="flex items-center gap-2">
            <input type="text" readonly value="{{ $lienClient }}" id="lien-client" class="field-input flex-1" onclick="this.select()">
            <button type="button" onclick="copierLien()" class="copy-btn px-4 py-2.5 rounded-lg font-semibold text-sm text-white flex-shrink-0" style="background: var(--accent);">
                <span id="copy-label">Copier</span>
            </button>
        </div>
    </div>
    
@if($devis->statut === 'accepte')
    <div class="rounded-2xl p-6 mb-6" style="background: var(--green-soft, #E8F7EE); border: 1px solid #B7E4C7;">
        @if($devis->facture)
            <p class="font-semibold" style="color: #16A34A;">
                ✓ Ce devis a déjà été transformé en facture.
            </p>
            <a href="{{ route('factures.show', $devis->facture) }}" class="text-sm font-semibold underline" style="color: #16A34A;">
                Voir la facture {{ $devis->facture->numero }} →
            </a>
        @else
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-bold" style="color: #16A34A;">Devis accepté</p>
                    <p class="text-sm mt-1" style="color: #166534;">Transforme-le en facture pour finaliser la vente.</p>
                </div>
                
                <form method="POST" action="{{ route('devis.facturer', $devis) }}">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: #16A34A;">
                        Transformer en facture
                    </button>
                </form>
            </div>
        @endif
    </div>
@endif

    {{-- Détail du devis --}}
    <div class="rounded-2xl p-6 mb-6" style="border: 1px solid var(--border);">

        <div class="mb-6 pb-6" style="border-bottom: 1px solid var(--border);">
            <p class="text-xs font-semibold uppercase tracking-wide" style="color: var(--muted);">Client</p>
            <p class="font-semibold mt-1">{{ $devis->client->name }}</p>
            <p class="text-sm" style="color: var(--muted);">{{ $devis->client->email }}</p>
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
                @foreach($devis->lignes as $ligne)
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
            <p class="font-mono text-3xl font-bold">{{ number_format($devis->total_ttc, 2) }} DH</p>
        </div>

        @if($devis->notes)
        <div class="mt-6 pt-6 text-sm" style="border-top: 1px solid var(--border); color: var(--muted);">
            <p class="font-semibold mb-1" style="color: var(--text);">Notes</p>
            {{ $devis->notes }}
        </div>
        @endif

    </div>

    {{-- Changer le statut manuellement --}}
    <div class="rounded-2xl p-6" style="border: 1px solid var(--border);">
        <p class="font-bold mb-3">Changer le statut manuellement</p>
        <form method="POST" action="{{ route('devis.statut', $devis) }}" class="flex items-center gap-3">
            @csrf
            @method('PUT')
            <select name="statut" class="field-input" style="font-family: var(--font-body);">
                <option value="brouillon" @selected($devis->statut === 'brouillon')>Brouillon</option>
                <option value="envoye" @selected($devis->statut === 'envoye')>Envoyé</option>
                <option value="accepte" @selected($devis->statut === 'accepte')>Accepté</option>
                <option value="refuse" @selected($devis->statut === 'refuse')>Refusé</option>
            </select>
            <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                Mettre à jour
            </button>
        </form>
    </div>

</div>


<script>
    function copierLien() {
        const input = document.getElementById('lien-client');
        input.select();
        navigator.clipboard.writeText(input.value).then(function () {
            const label = document.getElementById('copy-label');
            label.textContent = 'Copié !';
            setTimeout(() => label.textContent = 'Copier', 2000);
        });
    }
</script>

</body>
</html>