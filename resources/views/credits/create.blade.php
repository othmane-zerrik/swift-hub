
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau crédit - SwiftHub</title>

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

        ::selection { background: var(--accent); color: #fff; }

        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDDDD8; border-radius: 10px; border: 3px solid var(--bg); }
        ::-webkit-scrollbar-thumb:hover { background: #C7C7C1; }

        /* ══════════════ HEADER / TOPBAR ══════════════ */
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
        .btn-back:hover {
            background: var(--hover);
            color: var(--accent);
        }
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

        /* ══════════════ CARD PRINCIPALE ══════════════ */
        .form-card {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            animation: cardIn .4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .form-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, #F26B6B, var(--accent) 60%, #B91C1C);
        }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-card-header {
            padding: 24px 28px 18px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-soft);
        }

        .form-card-icon {
            width: 44px; height: 44px;
            border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #F26B6B 0%, var(--accent) 60%, #A81F1F 100%);
            color: #fff;
            box-shadow: 0 6px 16px -6px rgba(214,40,40,0.5), inset 0 1px 0 rgba(255,255,255,0.25);
            flex-shrink: 0;
            position: relative;
        }
        .form-card-icon::after {
            content: ''; position: absolute; inset: 0; border-radius: inherit;
            background: linear-gradient(180deg, rgba(255,255,255,0.18) 0%, transparent 50%);
            pointer-events: none;
        }

        .form-card-body { padding: 28px; }

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

        /* ══════════════ CARTES TYPE (Choix) ══════════════ */
        .type-choice {
            position: relative;
            display: block;
            padding: 18px;
            border: 2px solid var(--border);
            border-radius: 14px;
            cursor: pointer;
            background: var(--surface);
            transition: all .25s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            user-select: none;
        }
        .type-choice::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 12px;
            padding: 1px;
            background: linear-gradient(135deg, transparent 40%, rgba(214,40,40,0.15) 100%);
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            opacity: 0;
            transition: opacity .25s ease;
            pointer-events: none;
        }
        .type-choice:hover {
            border-color: var(--border-strong);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        .type-choice:hover::before { opacity: 1; }

        .type-choice.selected {
            border-color: var(--accent);
            background: linear-gradient(135deg, #FEF6F6 0%, #FCE8E8 100%);
            box-shadow: 0 8px 22px -8px rgba(214,40,40,0.35), inset 0 1px 0 rgba(255,255,255,0.6);
        }
        .type-choice.selected::before { opacity: 1; }

        .type-choice-icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
            color: #6B7280;
            flex-shrink: 0;
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
        }
        .type-choice.selected .type-choice-icon {
            background: linear-gradient(135deg, #F26B6B 0%, var(--accent) 100%);
            color: #fff;
            box-shadow: 0 6px 16px -6px rgba(214,40,40,0.55), inset 0 1px 0 rgba(255,255,255,0.25);
            transform: rotate(-8deg) scale(1.05);
        }

        .type-choice-check {
            position: absolute;
            top: 12px; right: 12px;
            width: 22px; height: 22px;
            border-radius: 50%;
            border: 2px solid var(--border-strong);
            background: var(--surface);
            display: flex; align-items: center; justify-content: center;
            transition: all .25s cubic-bezier(.34,1.56,.64,1);
        }
        .type-choice-check svg {
            opacity: 0;
            transform: scale(0.5);
            transition: all .25s cubic-bezier(.34,1.56,.64,1);
            color: #fff;
            width: 11px; height: 11px;
        }
        .type-choice.selected .type-choice-check {
            background: var(--accent);
            border-color: var(--accent);
            box-shadow: 0 4px 10px -3px rgba(214,40,40,0.5);
        }
        .type-choice.selected .type-choice-check svg {
            opacity: 1;
            transform: scale(1);
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
        .btn-primary svg { transition: transform .25s cubic-bezier(.34,1.56,.64,1); }
        .btn-primary:hover svg { transform: rotate(90deg); }

        .btn-ghost {
            display: inline-flex; align-items: center; justify-content: center;
            transition: all .18s ease;
            letter-spacing: -0.01em;
        }
        .btn-ghost:hover { background: var(--hover); color: var(--text); }

        /* ══════════════ SECTION DIVIDER ══════════════ */
        .section-label {
            display: flex; align-items: center; gap: 10px;
            font-size: 11px; font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--muted);
            margin: 24px 0 14px;
        }
        .section-label::after {
            content: ''; flex: 1; height: 1px;
            background: linear-gradient(to right, var(--border), transparent);
        }

        /* ══════════════ ANIMATION FIELD ══════════════ */
        .field-anim { animation: fieldIn .35s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes fieldIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation: none !important; transition: none !important; }
        }
    </style>
</head>

<body class="text-[16px]">

{{-- ══════════════ TOPBAR ══════════════ --}}
<header class="page-topbar">
    <div class="max-w-3xl mx-auto px-6 py-3 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <a href="{{ route('credits.index') }}" class="btn-back">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Retour aux crédits
            </a>
        </div>

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
<div class="max-w-3xl mx-auto px-6 py-8">

    {{-- En-tête de page --}}
    <div class="mb-8">
        <h1 class="text-[32px] font-extrabold tracking-tight leading-tight">Nouveau crédit</h1>
        <p class="mt-2 text-[15px]" style="color: var(--muted);">
            Enregistrez une dette client ou fournisseur à suivre.
        </p>
    </div>

    {{-- Alerte erreur --}}
    @if ($errors->any())
        <div class="alert-error mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
            </svg>
            <div class="flex-1">
                <p class="font-bold mb-1">Veuillez corriger les erreurs suivantes :</p>
                <ul class="list-disc pl-5 space-y-0.5 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Carte du formulaire --}}
    <div class="form-card">
        <div class="form-card-header">
            <div class="flex items-center gap-3.5">
                <div class="form-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 6v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6M3 6l2-3h14l2 3M9 12h6" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-[16px] font-bold tracking-tight leading-tight">Informations du crédit</h3>
                    <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">
                        Tous les champs marqués <span style="color: var(--accent); font-weight: 700;">*</span> sont obligatoires.
                    </p>
                </div>
            </div>
        </div>

        <div class="form-card-body">
            <form method="POST" action="{{ route('credits.store') }}" class="space-y-4">
                @csrf

                {{-- ═══ Choix du type ═══ --}}
                <div>
                    <label class="field-label">Type de crédit <span class="required-dot">*</span></label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                        {{-- Client --}}
                        <label class="type-choice" id="choice-client">
                            <input type="radio" name="type" value="client" class="hidden" onchange="selectType('client')" required>
                            <div class="flex items-start gap-3.5">
                                <div class="type-choice-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-[14px] tracking-tight">Crédit Client</p>
                                    <p class="text-[12px] mt-1 leading-relaxed" style="color: var(--muted);">
                                        Un client vous doit de l'argent
                                    </p>
                                </div>
                            </div>
                            <div class="type-choice-check">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </label>

                        {{-- Fournisseur --}}
                        <label class="type-choice" id="choice-fournisseur">
                            <input type="radio" name="type" value="fournisseur" class="hidden" onchange="selectType('fournisseur')" required>
                            <div class="flex items-start gap-3.5">
                                <div class="type-choice-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M4 10v9a1 1 0 0 0 1 1h4v-6h6v6h4a1 1 0 0 0 1-1v-9" />
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-bold text-[14px] tracking-tight">Crédit Fournisseur</p>
                                    <p class="text-[12px] mt-1 leading-relaxed" style="color: var(--muted);">
                                        Vous devez de l'argent à un fournisseur
                                    </p>
                                </div>
                            </div>
                            <div class="type-choice-check">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- ═══ Champ client ═══ --}}
                <div id="field-client" style="display: none;">
                    <label class="field-label" for="select-client">Client <span class="required-dot">*</span></label>
                    <select name="client_id" id="select-client" class="field-input">
                        <option value="">Sélectionner un client…</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                {{ $client->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ═══ Champ fournisseur ═══ --}}
                <div id="field-fournisseur" style="display: none;">
                    <label class="field-label" for="select-fournisseur">Fournisseur <span class="required-dot">*</span></label>
                    <select name="fournisseur_id" id="select-fournisseur" class="field-input">
                        <option value="">Sélectionner un fournisseur…</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                {{ $fournisseur->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ═══ Section : Montant & Dates ═══ --}}
                <div class="section-label">Détails financiers</div>

                <div>
                    <label class="field-label" for="input-montant">Montant (DH) <span class="required-dot">*</span></label>
                    <div class="relative">
                        <input type="number" step="0.01" min="0.01" name="montant" id="input-montant"
                               value="{{ old('montant') }}" required
                               class="field-input font-mono" placeholder="0.00"
                               style="padding-right: 50px; font-size: 15px; font-weight: 600;">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[12px] font-bold"
                              style="color: var(--muted-soft); letter-spacing: 0.05em;">DH</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="field-label" for="input-date-credit">Date du crédit <span class="required-dot">*</span></label>
                        <input type="date" name="date_credit" id="input-date-credit"
                               value="{{ old('date_credit', date('Y-m-d')) }}" required
                               class="field-input">
                    </div>
                    <div>
                        <label class="field-label" for="input-date-echeance">Date d'échéance <span class="required-dot">*</span></label>
                        <input type="date" name="date_echeance" id="input-date-echeance"
                               value="{{ old('date_echeance') }}" required
                               class="field-input">
                    </div>
                </div>

                {{-- ═══ Section : Notes ═══ --}}
                <div class="section-label">Informations complémentaires</div>

                <div>
                    <label class="field-label" for="input-notes">
                        Notes <span style="color: var(--muted-soft); font-weight: 500;">(optionnel)</span>
                    </label>
                    <textarea name="notes" id="input-notes" rows="3"
                              class="field-input"
                              placeholder="Détails, raison du crédit, référence de facture…">{{ old('notes') }}</textarea>
                </div>

                {{-- ═══ Actions ═══ --}}
                <div class="flex flex-col-reverse sm:flex-row sm:items-center justify-end gap-2.5 pt-6 mt-2"
                     style="border-top: 1px solid var(--border);">
                    <a href="{{ route('credits.index') }}"
                       class="btn-ghost px-5 py-2.5 rounded-xl font-semibold text-[13.5px]"
                       style="color: var(--muted);">
                        Annuler
                    </a>
                    <button type="submit"
                            class="btn-primary px-6 py-2.5 rounded-xl font-semibold text-[13.5px]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                        </svg>
                        Enregistrer le crédit
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Note en bas --}}
    <p class="mt-6 text-center text-[12px] font-medium" style="color: var(--muted-soft);">
        <svg xmlns="http://www.w3.org/2000/svg" class="inline w-3.5 h-3.5 -mt-0.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H4a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V4a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
        </svg>
        Le crédit sera suivi dans votre tableau de bord financier
    </p>

</div>



<script>
    function selectType(type) {
        document.getElementById('choice-client').classList.toggle('selected', type === 'client');
        document.getElementById('choice-fournisseur').classList.toggle('selected', type === 'fournisseur');
        document.getElementById('field-client').style.display = type === 'client' ? 'block' : 'none';
        document.getElementById('field-fournisseur').style.display = type === 'fournisseur' ? 'block' : 'none';

        document.querySelector('#field-client select').required = (type === 'client');
        document.querySelector('#field-fournisseur select').required = (type === 'fournisseur');
    }
</script>

</body>
</html>