<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau devis - SwiftHub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --ink: #0A0A0A;
            --bg: #F7F7F5;
            --surface: #FFFFFF;
            --surface-soft: #FDFDFC;
            --border: #E9E9E5;
            --border-strong: #E0E0DC;
            --hover: #FBF1F1;
            --text: #171717;
            --text-soft: #3F3F3D;
            --muted: #8B8B86;
            --muted-soft: #A8A8A3;
            --accent: #D62828;
            --accent-dark: #B01F1F;
            --accent-soft: #FCE8E8;
            --accent-glow: rgba(214, 40, 40, 0.12);
            --accent-glow-lg: rgba(214, 40, 40, 0.35);
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --radius: 16px;
            --shadow-sm: 0 1px 2px rgba(10,10,10,0.04);
            --shadow-md: 0 6px 24px -6px rgba(10,10,10,0.08);
            --shadow-lg: 0 12px 32px rgba(15,15,15,0.08), 0 4px 8px rgba(15,15,15,0.04);
            --shadow-xl: 0 24px 60px rgba(15,15,15,0.14), 0 8px 16px rgba(15,15,15,0.06);
            --shadow-accent: 0 8px 24px -8px rgba(214, 40, 40, 0.35);
        }

        * { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }

        body {
            font-family: var(--font-body);
            background:
                radial-gradient(1200px 600px at 100% 0%, rgba(214,40,40,0.04) 0%, transparent 60%),
                radial-gradient(1000px 500px at 0% 100%, rgba(214,40,40,0.03) 0%, transparent 60%),
                var(--bg);
            color: var(--text);
            min-height: 100vh;
            font-feature-settings: "ss01", "cv11";
        }

        h1, h2, h3, h4 { font-family: var(--font-body); letter-spacing: -0.025em; }
        .font-mono { font-family: var(--font-mono); }
        .icon { width: 18px; height: 18px; stroke-width: 1.6; flex-shrink: 0; }

        ::selection { background: var(--accent); color: #fff; }
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDDDD8; border-radius: 10px; border: 3px solid var(--bg); }
        ::-webkit-scrollbar-thumb:hover { background: #C7C7C1; }

        /* ══════════════ TOPBAR ══════════════ */
        .page-topbar {
            position: sticky; top: 0; z-index: 20;
            backdrop-filter: saturate(180%) blur(16px);
            -webkit-backdrop-filter: saturate(180%) blur(16px);
            background: rgba(247,247,245,0.85);
            border-bottom: 1px solid var(--border);
        }

        .btn-back {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 14px 8px 10px;
            border-radius: 10px;
            font-size: 13px; font-weight: 600;
            color: var(--muted);
            transition: all .2s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: -0.005em;
        }
        .btn-back:hover { background: var(--hover); color: var(--accent); }
        .btn-back svg { transition: transform .25s ease; }
        .btn-back:hover svg { transform: translateX(-3px); }

        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; color: #fff;
            background: linear-gradient(135deg, #F26B6B, var(--accent));
            box-shadow: 0 4px 12px -4px var(--accent-glow), var(--shadow-accent);
            letter-spacing: -0.02em;
        }

        /* ══════════════ CARTES SECTION ══════════════ */
        .form-section {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: box-shadow .25s ease;
            animation: sectionIn .35s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
        .form-section:hover { box-shadow: var(--shadow-md); }
        .form-section:nth-of-type(1) { animation-delay: .02s; }
        .form-section:nth-of-type(2) { animation-delay: .08s; }
        .form-section:nth-of-type(3) { animation-delay: .14s; }

        @keyframes sectionIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-section-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-soft);
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px;
        }

        .form-section-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%);
            color: var(--accent);
            box-shadow: 0 3px 10px -3px rgba(214,40,40,0.25), inset 0 1px 0 rgba(255,255,255,0.7);
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .form-section:hover .form-section-icon { transform: rotate(-8deg) scale(1.06); }

        .form-section-body { padding: 24px; }

        /* ══════════════ CHAMPS ══════════════ */
        .field-label {
            display: block;
            font-size: 12.5px;
            font-weight: 650;
            color: var(--text-soft);
            margin-bottom: 8px;
            letter-spacing: -0.005em;
        }
        .field-label .required-dot { color: var(--accent); }

        .field-input {
            width: 100%;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 11px 14px;
            font-size: 14.5px;
            font-family: var(--font-body);
            background: var(--surface);
            color: var(--text);
            transition: all .18s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
        }
        .field-input::placeholder { color: var(--muted-soft); }
        .field-input:hover { border-color: var(--border-strong); }
        .field-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 4px var(--accent-glow), var(--shadow-sm);
        }
        textarea.field-input { resize: vertical; min-height: 88px; }

        select.field-input {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath d='M6 8L1 3h10z' fill='%238C8C87'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            padding-right: 36px;
        }

        .numero-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 999px;
            font-size: 12px; font-weight: 700;
            background: linear-gradient(135deg, #FEF6F6 0%, #FCE8E8 100%);
            color: var(--accent);
            border: 1px solid #F5D5D5;
            box-shadow: 0 2px 8px -2px rgba(214,40,40,0.12);
            letter-spacing: -0.005em;
        }

        /* ══════════════ BOUTONS ══════════════ */
        .btn-primary {
            position: relative;
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            background: linear-gradient(180deg, #E13333 0%, var(--accent) 50%, var(--accent-dark) 100%);
            color: #fff;
            box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset, 0 4px 14px rgba(214,40,40,0.28), 0 1px 2px rgba(214,40,40,0.2);
            transition: all .2s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: -0.01em;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset, 0 8px 22px rgba(214,40,40,0.35), 0 2px 4px rgba(214,40,40,0.25);
            filter: brightness(1.05);
        }
        .btn-primary:active { transform: translateY(0); }

        .btn-secondary {
            display: inline-flex; align-items: center; justify-content: center; gap: 6px;
            background: var(--surface);
            color: var(--accent);
            border: 1px solid #F5D5D5;
            transition: all .2s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: -0.005em;
        }
        .btn-secondary:hover {
            background: var(--accent-soft);
            border-color: var(--accent);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.3);
        }

        .btn-ghost {
            display: inline-flex; align-items: center; justify-content: center;
            transition: all .18s ease;
            letter-spacing: -0.01em;
        }
        .btn-ghost:hover { background: var(--hover); color: var(--text); }

        /* ══════════════ LIGNES PRODUITS ══════════════ */
        .ligne-row {
            background: linear-gradient(135deg, #FEFEFE 0%, var(--surface) 100%);
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all .2s ease;
            animation: ligneIn .35s cubic-bezier(.34,1.4,.64,1) both;
        }
        .ligne-row:hover {
            border-color: var(--border-strong);
            box-shadow: var(--shadow-sm);
        }
        @keyframes ligneIn {
            from { opacity: 0; transform: translateX(-8px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .ligne-numero {
            width: 26px; height: 26px;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-family: var(--font-mono);
            font-size: 11px; font-weight: 700;
            background: linear-gradient(135deg, #FEF6F6 0%, #FCE8E8 100%);
            color: var(--accent);
            border: 1px solid #F5D5D5;
            flex-shrink: 0;
        }

        .btn-remove-ligne {
            width: 36px; height: 36px; border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--muted);
            border: 1px solid transparent;
            transition: all .2s cubic-bezier(.34,1.56,.64,1);
        }
        .btn-remove-ligne:hover {
            background: var(--accent-soft);
            color: var(--accent);
            border-color: #F5D5D5;
            transform: scale(1.08);
        }
        .btn-remove-ligne:hover svg { color: var(--accent); }

        /* ══════════════ TOTAL BOX ══════════════ */
        .total-box {
            position: relative;
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px;
            border-radius: 14px;
            background: linear-gradient(135deg, #FEF6F6 0%, #FCE8E8 100%);
            border: 1px solid #F5D5D5;
            box-shadow: 0 4px 14px -6px rgba(214,40,40,0.15), inset 0 1px 0 rgba(255,255,255,0.7);
            overflow: hidden;
            animation: sectionIn .3s ease;
        }
        .total-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #F26B6B, var(--accent) 60%, #B91C1C);
        }
        .total-box-label {
            font-size: 12.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--accent);
        }
        .total-box-amount {
            font-family: var(--font-mono);
            font-size: 28px;
            font-weight: 800;
            color: var(--accent);
            letter-spacing: -0.03em;
            line-height: 1;
        }
        .total-box-amount small {
            font-family: var(--font-body);
            font-size: 13px;
            font-weight: 700;
            color: var(--accent);
            opacity: 0.7;
        }

        /* ══════════════ EMPTY LIGNES ══════════════ */
        .empty-lignes {
            display: flex; flex-direction: column; align-items: center;
            padding: 40px 24px;
            border: 1.5px dashed var(--border-strong);
            border-radius: 14px;
            background: var(--surface-soft);
            text-align: center;
            transition: all .25s ease;
        }
        .empty-lignes:hover {
            border-color: #F5D5D5;
            background: linear-gradient(135deg, #FEFEFE 0%, #FEF6F6 100%);
        }

        /* ══════════════ ALERT ERREUR ══════════════ */
        .alert-error {
            display: flex; align-items: flex-start; gap: 12px;
            padding: 14px 18px;
            border-radius: 14px;
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            border: 1px solid #FECACA;
            color: #B91C1C;
            font-size: 13.5px;
            font-weight: 600;
            box-shadow: 0 4px 12px -4px rgba(220,38,38,0.15);
            animation: slideDown .3s ease;
        }
        .alert-error svg { flex-shrink: 0; margin-top: 1px; }
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }

        @media (max-width: 640px) {
            .ligne-row { flex-direction: column; align-items: stretch; gap: 12px; }
            .ligne-row > * { width: 100% !important; }
            .total-box { flex-direction: column; align-items: flex-start; gap: 8px; }
        }
    </style>
</head>

<body class="text-[16px]">

{{-- ══════════════ TOPBAR ══════════════ --}}
<header class="page-topbar">
    <div class="max-w-5xl mx-auto px-6 py-3 flex items-center justify-between">
        <a href="{{ route('devis.index') }}" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Retour aux devis
        </a>

        <div class="flex items-center gap-3">
            <div class="text-right hidden sm:block">
                <p class="font-semibold text-[13.5px] leading-tight">{{ auth()->user()->name }}</p>
                <p class="text-[11px] mt-0.5" style="color: var(--muted);">Compte utilisateur</p>
            </div>
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
        </div>
    </div>
</header>


{{-- ══════════════ CONTENU ══════════════ --}}
<div class="max-w-5xl mx-auto px-6 py-8">

    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-[32px] font-extrabold tracking-tight leading-tight">Nouveau devis</h1>
            <p class="mt-2 text-[15px]" style="color: var(--muted);">
                Créez une proposition commerciale pour votre client.
            </p>
        </div>
        <div>
            <span class="numero-badge">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.5A1.5 1.5 0 0 1 10.5 2h3A1.5 1.5 0 0 1 15 3.5V5a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1V3.5Z" />
                </svg>
                N° <span class="font-mono">{{ $numero }}</span>
            </span>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert-error mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
            </svg>
            <div class="flex-1">
                <p class="font-bold mb-1">Corrigez les erreurs suivantes :</p>
                <ul class="list-disc pl-5 space-y-0.5 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('devis.store') }}" id="devis-form" class="space-y-6">
        @csrf

        {{-- ════ SECTION : Infos générales ════ --}}
        <div class="form-section">
            <div class="form-section-header">
                <div class="flex items-center gap-3">
                    <div class="form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Informations générales</h3>
                        <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Client, date et validité du devis</p>
                    </div>
                </div>
            </div>

            <div class="form-section-body">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-1">
                        <label class="field-label" for="select-client">Client <span class="required-dot">*</span></label>
                        <select name="client_id" id="select-client" required class="field-input">
                            <option value="">Choisir un client…</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="field-label" for="date-devis">Date du devis <span class="required-dot">*</span></label>
                        <input type="date" name="date_devis" id="date-devis"
                               value="{{ old('date_devis', date('Y-m-d')) }}" required class="field-input">
                    </div>
                    <div>
                        <label class="field-label" for="date-validite">
                            Valable jusqu'au
                            <span style="color: var(--muted-soft); font-weight: 500;">(optionnel)</span>
                        </label>
                        <input type="date" name="date_validite" id="date-validite"
                               value="{{ old('date_validite') }}" class="field-input">
                    </div>
                </div>
            </div>
        </div>

        {{-- ════ SECTION : Produits ════ --}}
        <div class="form-section">
            <div class="form-section-header">
                <div class="flex items-center gap-3">
                    <div class="form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Lignes du devis</h3>
                        <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Ajoutez les produits et quantités</p>
                    </div>
                </div>

                <button type="button" onclick="ajouterLigne()" class="btn-secondary px-3.5 py-2 rounded-lg font-semibold text-[12.5px]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                    </svg>
                    Ajouter une ligne
                </button>
            </div>

            <div class="form-section-body">
                <div id="lignes-container" class="space-y-3"></div>

                <div id="empty-lignes-msg" class="empty-lignes">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-3"
                         style="background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%); box-shadow: 0 4px 12px -4px rgba(214,40,40,0.2);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                        </svg>
                    </div>
                    <p class="text-[13.5px] font-semibold" style="color: var(--text-soft);">Aucune ligne pour l'instant</p>
                    <p class="text-[12.5px] mt-1" style="color: var(--muted);">Cliquez sur « Ajouter une ligne » ci-dessus pour commencer.</p>
                </div>

                {{-- Total --}}
                <div class="total-box mt-6" id="total-box" style="display: none;">
                    <div>
                        <p class="total-box-label">Total du devis</p>
                        <p class="text-[12px] mt-1" style="color: var(--accent); opacity: 0.75;">
                            <span id="nb-lignes">0</span> <span id="nb-lignes-label">ligne</span>
                        </p>
                    </div>
                    <p class="total-box-amount">
                        <span id="total-general">0.00</span> <small>DH</small>
                    </p>
                </div>
            </div>
        </div>

        {{-- ════ SECTION : Notes ════ --}}
        <div class="form-section">
            <div class="form-section-header">
                <div class="flex items-center gap-3">
                    <div class="form-section-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a1 1 0 0 1 1 1v16l-6-3-6 3V4a1 1 0 0 1 1-1ZM9 8h6M9 11.5h6" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Notes</h3>
                        <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Conditions particulières, remarques…</p>
                    </div>
                </div>
            </div>

            <div class="form-section-body">
                <label class="field-label" for="notes">
                    Notes <span style="color: var(--muted-soft); font-weight: 500;">(optionnel)</span>
                </label>
                <textarea name="notes" id="notes" rows="4" class="field-input"
                          placeholder="Ex : Livraison sous 15 jours, garantie 1 an, acompte de 30% à la commande…">{{ old('notes') }}</textarea>
            </div>
        </div>

        {{-- ════ Actions ════ --}}
        <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-end gap-2.5 pt-2">
            <a href="{{ route('devis.index') }}" class="btn-ghost px-5 py-2.5 rounded-xl font-semibold text-[13.5px]" style="color: var(--muted);">
                Annuler
            </a>
            <button type="submit" class="btn-primary px-6 py-2.5 rounded-xl font-semibold text-[13.5px]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Enregistrer le devis
            </button>
        </div>
    </form>

</div>


{{-- ══════════════ TEMPLATE DE LIGNE ══════════════ --}}
<template id="ligne-template">
    <div class="ligne-row p-3.5 flex items-end gap-3">
        <div class="flex items-center pb-2.5">
            <div class="ligne-numero">1</div>
        </div>

        <div class="flex-1 min-w-0">
            <label class="field-label">Produit <span class="required-dot">*</span></label>
            <select class="field-input ligne-product" required>
                <option value="">Choisir un produit…</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                        {{ $product->name }} — {{ number_format($product->price, 2, ',', ' ') }} DH
                    </option>
                @endforeach
            </select>
        </div>

        <div style="width: 90px;">
            <label class="field-label">Qté</label>
            <input type="number" min="1" value="1" class="field-input ligne-quantite font-mono" required style="text-align: center;">
        </div>

        <div style="width: 120px;">
            <label class="field-label">Prix unit.</label>
            <input type="number" step="0.01" min="0" class="field-input ligne-prix font-mono" required style="text-align: right;">
        </div>

        <div style="width: 130px;">
            <label class="field-label">Total ligne</label>
            <div class="flex items-center justify-end h-[42px] px-3 rounded-xl"
                 style="background: var(--surface-soft); border: 1px solid var(--border);">
                <p class="font-mono font-bold text-[14px] ligne-total" style="color: var(--text);">0.00 DH</p>
            </div>
        </div>

        <button type="button" onclick="supprimerLigne(this)"
                class="btn-remove-ligne flex-shrink-0 mb-0.5" title="Supprimer cette ligne">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-colors" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m2 0-.7 12.1a2 2 0 0 1-2 1.9H8.7a2 2 0 0 1-2-1.9L6 7" />
            </svg>
        </button>
    </div>
</template>


<script>
    // ══════════════ VARIABLES GLOBALES ══════════════
    let ligneIndex = 0;
    const container = document.getElementById('lignes-container');
    const template = document.getElementById('ligne-template');
    const emptyMsg = document.getElementById('empty-lignes-msg');
    const totalBox = document.getElementById('total-box');
    const totalGeneral = document.getElementById('total-general');
    const nbLignesSpan = document.getElementById('nb-lignes');
    const nbLignesLabel = document.getElementById('nb-lignes-label');

    // ══════════════ FORMATAGE NOMBRE ══════════════
    function formatMoney(value) {
        return new Intl.NumberFormat('fr-FR', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }).format(value);
    }

    // ══════════════ AJOUTER UNE LIGNE ══════════════
    function ajouterLigne() {
        const clone = template.content.cloneNode(true);
        const row = clone.querySelector('.ligne-row');

        const index = ligneIndex++;
        const select = row.querySelector('.ligne-product');
        const qte = row.querySelector('.ligne-quantite');
        const prix = row.querySelector('.ligne-prix');

        // Names pour Laravel
        select.name = `lignes[${index}][product_id]`;
        qte.name = `lignes[${index}][quantite]`;
        prix.name = `lignes[${index}][prix_unitaire]`;

        // Événements
        select.addEventListener('change', function () {
            const opt = this.options[this.selectedIndex];
            prix.value = opt.dataset.price || '';
            calculerLigne(row);
        });
        qte.addEventListener('input', () => calculerLigne(row));
        prix.addEventListener('input', () => calculerLigne(row));

        container.appendChild(row);

        // Renuméroter + refresh UI
        renumeroter();
        refreshUI();

        // Focus sur le select
        setTimeout(() => select.focus(), 100);
    }

    // ══════════════ SUPPRIMER UNE LIGNE ══════════════
    function supprimerLigne(btn) {
        const row = btn.closest('.ligne-row');

        // Animation de sortie
        row.style.transition = 'all .25s ease';
        row.style.opacity = '0';
        row.style.transform = 'translateX(-12px)';

        setTimeout(() => {
            row.remove();
            renumeroter();
            refreshUI();
            calculerTotalGeneral();
        }, 220);
    }

    // ══════════════ RENUMÉROTER LES LIGNES ══════════════
    function renumeroter() {
        const rows = container.querySelectorAll('.ligne-row');
        rows.forEach((row, index) => {
            row.querySelector('.ligne-numero').textContent = index + 1;
        });
    }

    // ══════════════ CALCUL D'UNE LIGNE ══════════════
    function calculerLigne(row) {
        const qte = parseFloat(row.querySelector('.ligne-quantite').value) || 0;
        const prix = parseFloat(row.querySelector('.ligne-prix').value) || 0;
        const total = qte * prix;

        row.querySelector('.ligne-total').textContent = formatMoney(total) + ' DH';
        calculerTotalGeneral();
    }

    // ══════════════ CALCUL DU TOTAL GÉNÉRAL ══════════════
    function calculerTotalGeneral() {
        let total = 0;

        container.querySelectorAll('.ligne-row').forEach(function (row) {
            const qte = parseFloat(row.querySelector('.ligne-quantite').value) || 0;
            const prix = parseFloat(row.querySelector('.ligne-prix').value) || 0;
            total += qte * prix;
        });

        totalGeneral.textContent = formatMoney(total);
    }

    // ══════════════ REFRESH UI (affichage total / empty) ══════════════
    function refreshUI() {
        const rows = container.querySelectorAll('.ligne-row');

        if (rows.length === 0) {
            emptyMsg.style.display = '';
            totalBox.style.display = 'none';
        } else {
            emptyMsg.style.display = 'none';
            totalBox.style.display = '';

            nbLignesSpan.textContent = rows.length;
            nbLignesLabel.textContent = rows.length > 1 ? 'lignes' : 'ligne';
        }
    }

    // ══════════════ INITIALISATION ══════════════
    document.addEventListener('DOMContentLoaded', function () {
        // Ajoute automatiquement une première ligne
        ajouterLigne();
    });

    // ══════════════ VALIDATION À LA SOUMISSION ══════════════
    document.getElementById('devis-form').addEventListener('submit', function (e) {
        const rows = container.querySelectorAll('.ligne-row');
        if (rows.length === 0) {
            e.preventDefault();
            alert('Ajoutez au moins une ligne au devis.');
        }
    });
</script>

</body>
</html>