<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle facture - SwiftHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #0A0A0A; --bg: #FFFFFF; --border: #E6E6E3; --text: #171717;
            --muted: #8B8B86; --accent: #D62828; --accent-soft: #FCE8E8;
            --font-body: 'Plus Jakarta Sans', sans-serif; --font-mono: 'JetBrains Mono', monospace;
        }
        body { font-family: var(--font-body); background: var(--bg); color: var(--text); }
        .font-mono { font-family: var(--font-mono); }
        h1, h2, h3 { font-family: var(--font-body); letter-spacing: -0.02em; }
        .field-label { font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 6px; display: block; }
        .field-input { width: 100%; border: 1px solid var(--border); border-radius: 10px; padding: 10px 14px; font-size: 15px; font-family: var(--font-body); }
        .field-input:focus { outline: none; border-color: var(--accent); }
        .ligne-row { border: 1px solid var(--border); border-radius: 14px; }
    </style>
</head>
<body class="text-[16px]" style="background: var(--bg);">

<div class="max-w-4xl mx-auto p-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('factures.index') }}" class="text-sm font-semibold flex items-center gap-1 mb-2" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Retour aux factures
            </a>
            <h2 class="text-2xl font-extrabold tracking-tight">Nouvelle facture</h2>
            <p class="text-[15px] mt-1" style="color: var(--muted);">Numéro : <span class="font-mono font-semibold">{{ $numero }}</span></p>
        </div>
    </div>

    @if ($errors->any())
        <div class="rounded-xl p-4 mb-6" style="background: var(--accent-soft); border: 1px solid #F5C2C2;">
            <p class="font-semibold text-sm" style="color: var(--accent);">Corrige les champs suivants :</p>
            <ul class="text-sm mt-1 list-disc pl-5" style="color: var(--accent);">
                @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('factures.store') }}" id="facture-form">
        @csrf

        <div class="rounded-2xl p-6 mb-6" style="border: 1px solid var(--border);">
            <h3 class="font-bold mb-4">Informations générales</h3>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="field-label">Client</label>
                    <select name="client_id" required class="field-input">
                        <option value="">Choisir un client...</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="field-label">Date de facturation</label>
                    <input type="date" name="date_facture" value="{{ date('Y-m-d') }}" required class="field-input">
                </div>
                <div>
                    <label class="field-label">Date d'échéance</label>
                    <input type="date" name="date_echeance" value="{{ date('Y-m-d', strtotime('+30 days')) }}" class="field-input">
                </div>
            </div>
        </div>

        <div class="rounded-2xl p-6 mb-6" style="border: 1px solid var(--border);">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold">Produits</h3>
                <button type="button" onclick="ajouterLigne()" class="flex items-center gap-2 px-4 py-2 rounded-lg font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                    </svg>
                    Ajouter une ligne
                </button>
            </div>

            <div id="lignes-container" class="space-y-3"></div>
            <p id="empty-lignes-msg" class="text-sm text-center py-8" style="color: var(--muted);">
                Aucune ligne pour l'instant. Clique sur "Ajouter une ligne" pour commencer.
            </p>

            <div class="flex items-center justify-end gap-4 mt-6 pt-6" style="border-top: 1px solid var(--border);">
                <p class="font-semibold" style="color: var(--muted);">Total de la facture</p>
                <p id="total-general" class="font-mono text-3xl font-bold" style="color: var(--ink);">0.00 DH</p>
            </div>
        </div>

        <div class="rounded-2xl p-6 mb-6" style="border: 1px solid var(--border);">
            <label class="field-label">Notes (optionnel)</label>
            <textarea name="notes" rows="3" class="field-input" placeholder="Conditions de paiement, remarques..."></textarea>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('factures.index') }}" class="px-5 py-2.5 rounded-xl font-semibold text-sm transition hover:bg-[var(--hover)]" style="color: var(--muted);">Annuler</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                Enregistrer la facture
            </button>
        </div>
    </form>

</div>

<template id="ligne-template">
    <div class="ligne-row p-4 flex items-end gap-3">
        <div class="flex-1">
            <label class="field-label">Produit</label>
            <select class="field-input ligne-product" required>
                <option value="">Choisir...</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                        {{ $product->name }} — {{ number_format($product->price, 2) }} DH ({{ $product->stock }} en stock)
                    </option>
                @endforeach
            </select>
        </div>
        <div style="width: 100px;">
            <label class="field-label">Qté</label>
            <input type="number" min="1" value="1" class="field-input ligne-quantite" required>
        </div>
        <div style="width: 130px;">
            <label class="field-label">Prix unit.</label>
            <input type="number" step="0.01" min="0" class="field-input ligne-prix" required>
        </div>
        <div style="width: 130px;">
            <label class="field-label">Total ligne</label>
            <p class="font-mono font-semibold ligne-total py-2.5">0.00 DH</p>
        </div>
        <button type="button" onclick="supprimerLigne(this)" class="w-10 h-10 rounded-lg flex items-center justify-center hover:bg-[var(--hover)] flex-shrink-0" title="Supprimer">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m2 0-.7 12.1a2 2 0 0 1-2 1.9H8.7a2 2 0 0 1-2-1.9L6 7" />
            </svg>
        </button>
    </div>
</template>

<script>
    let ligneIndex = 0;
    function ajouterLigne() {
        const template = document.getElementById('ligne-template');
        const clone = template.content.cloneNode(true);
        const container = document.getElementById('lignes-container');
        const index = ligneIndex++;
        const row = clone.querySelector('.ligne-row');
        const select = row.querySelector('.ligne-product');
        const qte = row.querySelector('.ligne-quantite');
        const prix = row.querySelector('.ligne-prix');
        select.name = `lignes[${index}][product_id]`;
        qte.name = `lignes[${index}][quantite]`;
        prix.name = `lignes[${index}][prix_unitaire]`;
        select.addEventListener('change', function () {
            const opt = select.options[select.selectedIndex];
            prix.value = opt.dataset.price || 0;
            calculerLigne(row);
        });
        qte.addEventListener('input', () => calculerLigne(row));
        prix.addEventListener('input', () => calculerLigne(row));
        container.appendChild(row);
        document.getElementById('empty-lignes-msg').style.display = 'none';
    }
    function supprimerLigne(btn) {
        btn.closest('.ligne-row').remove();
        if (document.querySelectorAll('.ligne-row').length === 0) {
            document.getElementById('empty-lignes-msg').style.display = 'block';
        }
        calculerTotalGeneral();
    }
    function calculerLigne(row) {
        const qte = parseFloat(row.querySelector('.ligne-quantite').value) || 0;
        const prix = parseFloat(row.querySelector('.ligne-prix').value) || 0;
        row.querySelector('.ligne-total').textContent = (qte * prix).toFixed(2) + ' DH';
        calculerTotalGeneral();
    }
    function calculerTotalGeneral() {
        let total = 0;
        document.querySelectorAll('.ligne-row').forEach(function (row) {
            const qte = parseFloat(row.querySelector('.ligne-quantite').value) || 0;
            const prix = parseFloat(row.querySelector('.ligne-prix').value) || 0;
            total += qte * prix;
        });
        document.getElementById('total-general').textContent = total.toFixed(2) + ' DH';
    }
    document.addEventListener('DOMContentLoaded', () => ajouterLigne());
</script>

</body>
</html>