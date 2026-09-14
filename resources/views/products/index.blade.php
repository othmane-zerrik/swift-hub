<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits - SwiftHub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --ink: #0A0A0A;
            --bg: #F7F7F5;
            --surface: #FFFFFF;
            --border: #E9E9E5;
            --hover: #FBF1F1;
            --text: #171717;
            --muted: #8B8B86;
            --accent: #D62828;
            --accent-soft: #FCE8E8;
            --accent-glow: rgba(214, 40, 40, 0.12);
            --green: #16794C;
            --green-soft: #E7F6EE;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --radius: 16px;
            --shadow-sm: 0 1px 2px rgba(10,10,10,0.04);
            --shadow-md: 0 6px 24px -6px rgba(10,10,10,0.08);
            --shadow-accent: 0 8px 24px -8px rgba(214, 40, 40, 0.35);
        }

        * { -webkit-font-smoothing: antialiased; }

        body { font-family: var(--font-body); background: var(--bg); color: var(--text); }
        .font-mono { font-family: var(--font-mono); }
        h1, h2, h3, h4 { font-family: var(--font-body); letter-spacing: -0.02em; }
        .icon { width: 18px; height: 18px; stroke-width: 1.6; flex-shrink: 0; }

        /* ══════════════════════════════════════════
           SIDEBAR
        ══════════════════════════════════════════ */
        .side-label {
            font-size: 10.5px; font-weight: 700; letter-spacing: .12em;
            text-transform: uppercase; color: #C4C4BE;
            padding: 0 20px; margin: 18px 0 6px;
        }

        .nav-link {
            position: relative; border-radius: 12px; color: var(--muted);
        }
        .nav-link svg { transition: transform .3s cubic-bezier(.34,1.56,.64,1); }

        .nav-link:not(.active):hover { background: var(--hover); color: var(--ink); }
        .nav-link:not(.active):hover svg { transform: translateX(3px) scale(1.12); color: var(--accent); }

        .nav-link.active {
            background: linear-gradient(120deg, #E63946 0%, var(--accent) 55%, #B91C1C 100%);
            color: #fff; font-weight: 600;
            box-shadow: 0 6px 16px -6px rgba(214,40,40,0.55), inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .nav-link.active::after {
            content: ''; position: absolute; right: 12px; top: 50%;
            width: 6px; height: 6px; border-radius: 50%;
            background: rgba(255,255,255,0.9);
            transform: translateY(-50%);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.25);
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { box-shadow: 0 0 0 3px rgba(255,255,255,0.25); }
            50% { box-shadow: 0 0 0 5px rgba(255,255,255,0.12); }
        }

        details .nav-link { border-radius: 12px; }
        details[open] > summary.nav-link { color: var(--accent); background: var(--accent-soft); }
        .submenu { display: grid; grid-template-rows: 0fr; transition: grid-template-rows .3s ease; }
        details[open] .submenu { grid-template-rows: 1fr; }
        .submenu > div { overflow: hidden; }
        .submenu a { position: relative; transition: color .2s ease, transform .2s ease; }
        .submenu a::before {
            content: ''; position: absolute; left: -14px; top: 50%;
            width: 5px; height: 5px; border-radius: 50%;
            background: var(--border); transform: translateY(-50%);
            transition: background .2s ease, transform .2s ease;
        }
        .submenu a:hover { color: var(--accent) !important; transform: translateX(4px); }
        .submenu a:hover::before { background: var(--accent); transform: translateY(-50%) scale(1.4); }

        .logo-badge {
            position: relative; width: 8px; height: 8px; border-radius: 50%; background: var(--accent);
        }
        .logo-badge::after {
            content: ''; position: absolute; inset: -3px;
            border-radius: 50%; border: 2px solid var(--accent);
            opacity: .5; animation: ring 2.2s ease-out infinite;
        }
        @keyframes ring {
            0% { transform: scale(.6); opacity: .6; }
            100% { transform: scale(1.6); opacity: 0; }
        }

        .logout-btn { transition: all .2s ease; color: var(--muted); border: 1px solid transparent; }
        .logout-btn:hover { background: var(--accent-soft); color: var(--accent); border-color: #F5D5D5; }
        .logout-btn svg { transition: transform .2s ease; }
        .logout-btn:hover svg { transform: translateX(2px); }

        summary::-webkit-details-marker { display: none; }
        summary { list-style: none; }
        details[open] summary .chevron { transform: rotate(90deg); }
        .chevron { transition: transform .25s ease; }

        /* ══════════════════════════════════════════
           CARTES PRODUITS
        ══════════════════════════════════════════ */
        .product-card {
            position: relative; overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: transform .25s cubic-bezier(.34,1.4,.64,1), box-shadow .25s ease, border-color .25s ease;
        }
        .product-card::before {
            content: ''; position: absolute; inset: 0 0 auto 0; height: 3px;
            background: linear-gradient(90deg, #F26B6B, var(--accent) 60%, #B91C1C);
            opacity: 0; transition: opacity .25s ease;
        }
        .product-card:hover {
            transform: translateY(-4px);
            border-color: #E2C7C7;
            box-shadow: var(--shadow-md), var(--shadow-accent);
        }
        .product-card:hover::before { opacity: 1; }

        .product-actions {
            opacity: 0; transform: translateY(-3px);
            transition: opacity .2s ease, transform .2s ease;
        }
        .product-card:hover .product-actions,
        .product-card:focus-within .product-actions { opacity: 1; transform: translateY(0); }

        .avatar-badge {
            width: 46px; height: 46px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 16px; color: #fff; flex-shrink: 0;
            letter-spacing: -.02em;
            background: linear-gradient(135deg, #F26B6B, #D62828);
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.35), inset 0 1px 0 rgba(255,255,255,0.25);
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .product-card:hover .avatar-badge { transform: rotate(-8deg) scale(1.08); }

        .stock-badge {
            font-family: var(--font-mono); font-size: 12px; font-weight: 600;
            padding: 4px 10px; border-radius: 999px; display: inline-block;
        }
        .stock-ok { background: var(--green-soft); color: var(--green); }
        .stock-low { background: var(--accent-soft); color: var(--accent); }

        .icon-btn {
            width: 32px; height: 32px; border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--muted); border: 1px solid transparent;
            transition: all .25s cubic-bezier(.34,1.56,.64,1);
        }
        .icon-btn:hover {
            background: var(--accent-soft); border-color: #F5D5D5;
            color: var(--accent); transform: translateY(-2px);
        }

        /* ══════════════════════════════════════════
           BOUTONS & CHAMPS
        ══════════════════════════════════════════ */
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            font-size: 14px; font-weight: 650;
            padding: 10px 18px; border-radius: 12px;
            transition: all .22s cubic-bezier(.34,1.4,.64,1);
            white-space: nowrap;
        }
        .btn-primary {
            background: linear-gradient(120deg, #E63946 0%, var(--accent) 55%, #B91C1C 100%);
            color: #fff;
            box-shadow: 0 6px 16px -6px rgba(214,40,40,0.55), inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 22px -8px rgba(214,40,40,0.65); }
        .btn-primary:active { transform: translateY(0); }
        .btn-primary svg { transition: transform .3s cubic-bezier(.34,1.56,.64,1); }
        .btn-primary:hover svg { transform: rotate(90deg); }

        .btn-ghost { color: var(--muted); background: transparent; border: 1px solid transparent; }
        .btn-ghost:hover { background: var(--hover); color: var(--text); border-color: var(--border); }

        .field-label { display: block; margin-bottom: 6px; font-size: 12.5px; font-weight: 650; color: #4A4A46; }
        .field-input {
            width: 100%; border: 1px solid var(--border); border-radius: 12px;
            padding: 10.5px 14px; font-size: 14.5px; font-family: var(--font-body);
            background: var(--surface); color: var(--text);
            transition: border-color .18s ease, box-shadow .18s ease;
        }
        .field-input::placeholder { color: #B6B6B1; }
        .field-input:hover { border-color: #DCDCD6; }
        .field-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 4px var(--accent-glow); }
        textarea.field-input { resize: vertical; min-height: 88px; }
        select.field-input { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath d='M6 8L1 3h10z' fill='%238C8C87'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; }
        
        .search-wrap:focus-within .search-icon { color: var(--accent) !important; }

        /* ══════════════════════════════════════════
           MODALES & AUTRES
        ══════════════════════════════════════════ */
        .app-modal.hidden { display: none; }
        .app-modal { position: fixed; inset: 0; z-index: 60; }
        .app-modal .overlay {
            position: absolute; inset: 0;
            background: rgba(12,12,12,.42);
            backdrop-filter: blur(5px); -webkit-backdrop-filter: blur(5px);
            animation: fadeIn .18s ease;
        }
        .app-modal .panel {
            position: relative; z-index: 1;
            width: 92%; max-width: 500px;
            margin: 7vh auto 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 22px;
            box-shadow: 0 30px 60px -20px rgba(10,10,10,0.30);
            overflow: hidden;
            animation: modalIn .28s cubic-bezier(.34,1.4,.64,1);
        }
        @keyframes fadeIn { from { opacity: 0 } to { opacity: 1 } }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(16px) scale(.97) }
            to   { opacity: 1; transform: translateY(0) scale(1) }
        }

        .flash {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 13px 16px; border-radius: var(--radius);
            font-size: 14px; font-weight: 550;
            animation: modalIn .3s ease;
        }
        .flash-success { background: var(--green-soft); color: var(--green); border: 1px solid #CFEBDD; }
        .flash-error   { background: var(--accent-soft); color: var(--accent); border: 1px solid #F5D5D5; }

        .empty-state {
            border: 1px dashed #DEDEDA;
            border-radius: var(--radius);
            background: radial-gradient(120% 90% at 50% 0%, #FFF6F6 0%, transparent 62%), var(--surface);
        }
    </style>
</head>

<body class="text-[16px]">

<div class="flex min-h-screen">

    {{-- ══════════════════════ SIDEBAR ══════════════════════ --}}
    <aside class="w-64 flex flex-col fixed inset-y-0 left-0 overflow-y-auto" style="background: var(--surface); border-right: 1px solid var(--border); z-index: 10;">

        {{-- Logo --}}
        <div class="h-20 flex items-center px-7 border-b gap-3" style="border-color: var(--border);">
            <div class="logo-badge flex-shrink-0"></div>
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight" style="color: var(--accent);">SwiftHub</h1>
                <p class="text-[13px] font-medium mt-1" style="color: var(--muted);">Gestion commerciale</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-4">

            <p class="side-label">Principal</p>
            <div class="space-y-1">
                <a href="{{ route('dashboard') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5 9.5V21h14V9.5" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route("analytics.index")}}"  class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5M4 19h16M8 19v-6M13 19v-9M18 19v-4" />
                    </svg>
                    <span>Analytique</span>
                </a>

                <a href="{{ route('clients.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                    </svg>
                    <span>Clients</span>
                </a>

                <a href="{{ route('fournisseurs.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M4 10v9a1 1 0 0 0 1 1h4v-6h6v6h4a1 1 0 0 0 1-1v-9" />
                    </svg>
                    <span>Fournisseurs</span>
                </a>
            </div>

            <p class="side-label">Gestion</p>
            <div class="space-y-1">
                <a href="{{ route('products.index') }}" class="nav-link active flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" />
                    </svg>
                    <span>Produits</span>
                </a>

                <a href="{{ route('devis.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.5A1.5 1.5 0 0 1 10.5 2h3A1.5 1.5 0 0 1 15 3.5V5a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1V3.5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h4" />
                    </svg>
                    <span>Devis</span>
                </a>

                <a href="{{ route('factures.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5M9 13h6M9 16.5h6" />
                    </svg>
                    <span>Factures</span>
                </a>

                <a href="{{ route('employees.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 5 18.5V20M10 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19 20v-1.2a3 3 0 0 0-2-2.83M15.5 4.2a3 3 0 0 1 0 5.6" />
                    </svg>
                    <span>Employés</span>
                </a>

                {{-- Gestion financière (sous-menu) --}}
                <details class="group">
                    <summary class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition cursor-pointer list-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 6v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6M3 6l2-3h14l2 3M9 12h6" />
                        </svg>
                        <span class="flex-1">Gestion financière</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="chevron w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="m9 6 6 6-6 6" />
                        </svg>
                    </summary>

                    <div class="submenu">
                        <div class="pl-11 pr-4 pb-1 pt-1 space-y-1">
                            <a href="{{ route('finances.index') }}" class="block py-2 text-sm" style="color: var(--muted);">Chiffre d'affaires</a>
                            <a href="{{ route('credits.index') }}" class="block py-2 text-sm" style="color: var(--muted);">Crédits</a>
                            
                        </div>
                    </div>
                </details>
            </div>

            <p class="side-label">Système</p>
            <div class="space-y-1">
                <a href="{{ route("reports.index")}}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a1 1 0 0 1 1 1v16l-6-3-6 3V4a1 1 0 0 1 1-1ZM9 8h6M9 11.5h6" />
                    </svg>
                    <span>Rapports</span>
                </a>

                <a href="{{ route('settings.edit') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H4a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V4a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
                    </svg>
                    <span>Paramètres</span>
                </a>
            </div>
        </nav>

        <div class="p-4 border-t" style="border-color: var(--border);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn w-full flex items-center gap-3 px-4 py-2.5 text-sm rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8V6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-2M14 12H3m0 0 3.5-3.5M3 12l3.5 3.5" />
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>


    {{-- ══════════════════════ CONTENU PRINCIPAL ══════════════════════ --}}
    <main class="flex-1 ml-64">

        <header class="topbar px-8 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight leading-tight">Produits</h2>
                <p class="text-[14.5px] mt-1 flex items-center gap-2" style="color: var(--muted);">
                    Catalogue et gestion du stock
                </p>
            </div>

            <div class="flex justify-center">
                <span class="px-4 py-2 rounded-full text-sm font-semibold"
                      style="background: var(--accent-soft); color: var(--accent); box-shadow: 0 2px 8px -2px var(--accent-glow);">
                    {{ isset($products) ? $products->count() : 0 }} produit(s) référencé(s)
                </span>
            </div>

            <div class="flex items-center gap-3 justify-self-end">
                <div class="text-right">
                    <p class="font-semibold text-[15px]">{{ auth()->user()->name }}</p>
                    <p class="text-xs" style="color: var(--muted);">Compte utilisateur</p>
                </div>
                <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-white text-sm"
                     style="background: linear-gradient(135deg, #F26B6B, var(--accent)); box-shadow: 0 4px 12px -4px var(--accent-glow), var(--shadow-accent);">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>


        <div class="p-8">

            @if(session('success'))
                <div class="flash flash-success mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 6 9 17l-5-5" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="flash flash-error mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
{{-- Recherche + Bouton Ajouter --}}
<div class="mb-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

    {{-- Recherche --}}
    <form method="GET"
          action="{{ route('products.index') }}"
          class="search-wrap relative w-full sm:max-w-md">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="search-icon absolute left-4 top-1/2 -translate-y-1/2 w-[17px] h-[17px] transition-colors"
             style="color: var(--muted);"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="1.8">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="m21 21-4.35-4.35M18 11a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
        </svg>

        <input type="text"
               name="search"
               value="{{ $search ?? '' }}"
               placeholder="Rechercher un produit…"
               autocomplete="off"
               class="field-input"
               style="padding-left: 44px; padding-right: 90px;"
               id="searchInput">

        <span id="search-spinner"
              class="hidden absolute right-[74px] top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full border-2 animate-spin"
              style="border-color: var(--border); border-top-color: var(--accent);">
        </span>

        @if(!empty($search))
            <a href="{{ route('products.index') }}"
               class="absolute right-3 top-1/2 -translate-y-1/2 text-[11.5px] font-bold px-2.5 py-1 rounded-md transition hover:bg-[var(--accent-soft)]"
               style="color: var(--accent);">
                EFFACER
            </a>
        @endif

    </form>


    {{-- Bouton Ajouter --}}
    <button type="button"
            onclick="openProductModal()"
            class="btn btn-primary self-start sm:self-auto">

        <svg xmlns="http://www.w3.org/2000/svg"
             class="w-4 h-4"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor"
             stroke-width="2.2">

            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 5v14M5 12h14" />
        </svg>

        Ajouter un produit
    </button>

</div>

            @if(isset($products) && count($products) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5" id="products-grid">
                    @foreach($products as $product)
                        <article class="product-card p-6" data-name="{{ strtolower($product->name) }} {{ strtolower($product->sku ?? '') }}">

                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="avatar-badge">{{ strtoupper(substr($product->name, 0, 1)) }}</div>
                                    <div class="min-w-0">
                                        <p class="font-bold text-[15px] truncate" title="{{ $product->name }}">{{ $product->name }}</p>
                                        <p class="text-xs mt-0.5" style="color: var(--muted);">
                                            {{ $product->sku ? 'Réf. ' . $product->sku : 'Sans référence' }}
                                        </p>
                                        @if($product->category)
                                            <span class="inline-block mt-1.5 text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-md" style="background: #F3F3F0; color: var(--muted);">
                                                {{ $product->category }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="product-actions flex items-center gap-1 flex-shrink-0">
                                    <button type="button" onclick="openEditModal(this)"
                                            data-id="{{ $product->id }}"
                                            data-name="{{ $product->name }}"
                                            data-sku="{{ $product->sku }}"
                                            data-category="{{ $product->category }}"
                                            data-fournisseur-id="{{ $product->fournisseur_id }}"
                                            data-price="{{ $product->price }}"
                                            data-stock="{{ $product->stock }}"
                                            data-description="{{ $product->description }}"
                                            data-action="{{ route('products.update', $product) }}"
                                            class="icon-btn" title="Modifier">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" />
                                        </svg>
                                    </button>

                                    <button type="button" onclick="openDeleteModal(this)"
                                            data-name="{{ $product->name }}"
                                            data-action="{{ route('products.destroy', $product) }}"
                                            class="icon-btn" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[15px] h-[15px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m2 0-.7 12.1a2 2 0 0 1-2 1.9H8.7a2 2 0 0 1-2-1.9L6 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-5 pt-4 flex items-end justify-between" style="border-top: 1px solid var(--border);">
                                <div>
                                    <p class="text-[11px] font-semibold uppercase tracking-wider" style="color: var(--muted);">Prix unitaire</p>
                                    <p class="font-mono text-2xl font-bold" style="color: var(--ink);">{{ number_format($product->price, 2) }} DH</p>
                                </div>
                                <span class="stock-badge {{ $product->stock <= 10 ? 'stock-low' : 'stock-ok' }}">
                                    {{ $product->stock }} en stock
                                </span>
                            </div>

                            @if($product->description)
                                <p class="mt-3 text-[13px] leading-relaxed line-clamp-2" style="color: var(--text-soft);">
                                    {{ $product->description }}
                                </p>
                            @endif
                        </article>
                    @endforeach
                </div>
            @else
                <div class="empty-state py-16 text-center">
                    <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center"
                         style="background: var(--accent-soft); box-shadow: 0 0 0 8px rgba(214,40,40,0.05);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" />
                        </svg>
                    </div>

                    <h4 class="text-lg font-bold">
                        {{ !empty($search) ? 'Aucun résultat trouvé' : 'Aucun produit pour le moment' }}
                    </h4>
                    <p class="text-sm mt-1.5 max-w-sm mx-auto" style="color: var(--muted);">
                        {{ !empty($search) ? 'Essayez un autre terme de recherche ou réinitialisez le filtre.' : 'Ajoutez votre premier produit pour commencer à suivre votre stock.' }}
                    </p>

                    <div class="mt-6 flex items-center justify-center gap-3">
                        @if(!empty($search))
                            <a href="{{ route('products.index') }}" class="btn btn-ghost" style="border-color: var(--border);">Réinitialiser</a>
                        @endif
                        <button type="button" onclick="openProductModal()" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                            </svg>
                            Ajouter un produit
                        </button>
                    </div>
                </div>
            @endif

        </div>
    </main>
</div>


{{-- ══════════════ MODAL : Ajouter ══════════════ --}}
<div id="product-modal" class="app-modal hidden" role="dialog" aria-modal="true" aria-labelledby="add-modal-title">
    <div class="overlay" onclick="closeProductModal()"></div>
    <div class="panel">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <div class="flex items-start justify-between gap-4 px-6 pt-6 pb-5 border-b" style="border-color: var(--border);">
                <div>
                    <h3 id="add-modal-title" class="text-[18px] font-extrabold tracking-tight">Nouveau produit</h3>
                    <p class="text-[13px] mt-1" style="color: var(--muted);">Référencez un article dans votre catalogue.</p>
                </div>
                <button type="button" onclick="closeProductModal()" class="icon-btn" aria-label="Fermer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="field-label" for="add-name">Nom du produit <span style="color: var(--accent);">*</span></label>
                    <input id="add-name" type="text" name="name" value="{{ old('name') }}" required class="field-input" placeholder="Ex : Chaise de bureau">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label" for="add-sku">Référence (SKU)</label>
                        <input id="add-sku" type="text" name="sku" value="{{ old('sku') }}" class="field-input" placeholder="REF-001">
                    </div>
                    <div>
                        <label class="field-label" for="add-category">Catégorie</label>
                        <input id="add-category" type="text" name="category" value="{{ old('category') }}" class="field-input" placeholder="Mobilier">
                    </div>
                </div>

                <div>
                    <label class="field-label" for="add-fournisseur">Fournisseur <span style="color: var(--muted); font-weight:500;">(optionnel)</span></label>
                    <select id="add-fournisseur" name="fournisseur_id" class="field-input">
                        <option value="">Aucun</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}" {{ old('fournisseur_id') == $fournisseur->id ? 'selected' : '' }}>
                                {{ $fournisseur->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label" for="add-price">Prix (DH) <span style="color: var(--accent);">*</span></label>
                        <input id="add-price" type="number" step="0.01" min="0" name="price" value="{{ old('price') }}" required class="field-input" placeholder="0.00">
                    </div>
                    <div>
                        <label class="field-label" for="add-stock">Stock initial <span style="color: var(--accent);">*</span></label>
                        <input id="add-stock" type="number" min="0" name="stock" value="{{ old('stock', 0) }}" required class="field-input" placeholder="0">
                    </div>
                </div>

                <div>
                    <label class="field-label" for="add-desc">Description <span style="color: var(--muted); font-weight:500;">(optionnel)</span></label>
                    <textarea id="add-desc" name="description" rows="3" class="field-input" placeholder="Caractéristiques, dimensions, notes…">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4" style="background: #FCFCFB; border-top: 1px solid var(--border);">
                <button type="button" onclick="closeProductModal()" class="btn btn-ghost">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer le produit</button>
            </div>
        </form>
    </div>
</div>


{{-- ══════════════ MODAL : Modifier ══════════════ --}}
<div id="edit-product-modal" class="app-modal hidden" role="dialog" aria-modal="true" aria-labelledby="edit-modal-title">
    <div class="overlay" onclick="closeEditModal()"></div>
    <div class="panel">
        <form id="edit-product-form" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="flex items-start justify-between gap-4 px-6 pt-6 pb-5 border-b" style="border-color: var(--border);">
                <div>
                    <h3 id="edit-modal-title" class="text-[18px] font-extrabold tracking-tight">Modifier le produit</h3>
                    <p class="text-[13px] mt-1" style="color: var(--muted);">Mettez à jour la fiche produit.</p>
                </div>
                <button type="button" onclick="closeEditModal()" class="icon-btn" aria-label="Fermer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-6 py-5 space-y-4">
                <div>
                    <label class="field-label" for="edit-name">Nom du produit <span style="color: var(--accent);">*</span></label>
                    <input type="text" name="name" id="edit-name" required class="field-input">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label" for="edit-sku">Référence (SKU)</label>
                        <input type="text" name="sku" id="edit-sku" class="field-input">
                    </div>
                    <div>
                        <label class="field-label" for="edit-category">Catégorie</label>
                        <input type="text" name="category" id="edit-category" class="field-input">
                    </div>
                </div>

                <div>
                    <label class="field-label" for="edit-fournisseur">Fournisseur <span style="color: var(--muted); font-weight:500;">(optionnel)</span></label>
                    <select name="fournisseur_id" id="edit-fournisseur" class="field-input">
                        <option value="">Aucun</option>
                        @foreach($fournisseurs as $fournisseur)
                            <option value="{{ $fournisseur->id }}">{{ $fournisseur->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label" for="edit-price">Prix (DH) <span style="color: var(--accent);">*</span></label>
                        <input type="number" step="0.01" min="0" name="price" id="edit-price" required class="field-input">
                    </div>
                    <div>
                        <label class="field-label" for="edit-stock">Stock <span style="color: var(--accent);">*</span></label>
                        <input type="number" min="0" name="stock" id="edit-stock" required class="field-input">
                    </div>
                </div>

                <div>
                    <label class="field-label" for="edit-desc">Description <span style="color: var(--muted); font-weight:500;">(optionnel)</span></label>
                    <textarea name="description" id="edit-desc" rows="3" class="field-input"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4" style="background: #FCFCFB; border-top: 1px solid var(--border);">
                <button type="button" onclick="closeEditModal()" class="btn btn-ghost">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>


{{-- ══════════════ MODAL : Supprimer ══════════════ --}}
<div id="delete-product-modal" class="app-modal hidden" role="alertdialog" aria-modal="true" aria-labelledby="delete-modal-title">
    <div class="overlay" onclick="closeDeleteModal()"></div>
    <div class="panel" style="max-width: 420px;">
        <form id="delete-product-form" method="POST" action="">
            @csrf
            @method('DELETE')

            <div class="p-6">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                     style="background: var(--accent-soft); box-shadow: 0 0 0 8px rgba(214,40,40,0.05);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[21px] h-[21px]" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                    </svg>
                </div>

                <h3 id="delete-modal-title" class="text-[18px] font-extrabold tracking-tight">Supprimer ce produit ?</h3>
                <p class="text-[13.5px] mt-2 leading-relaxed" style="color: var(--muted);">
                    Tu es sur le point de supprimer
                    <span id="delete-product-name" class="font-bold" style="color: var(--text);"></span>.
                    Cette action est définitive et ne peut pas être annulée.
                </p>
            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4" style="background: #FCFCFB; border-top: 1px solid var(--border);">
                <button type="button" onclick="closeDeleteModal()" class="btn btn-ghost">Annuler</button>
                <button type="submit" class="btn btn-primary">Oui, supprimer</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openProductModal() {
        document.getElementById('product-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeProductModal() {
        document.getElementById('product-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function openEditModal(btn) {
        document.getElementById('edit-product-form').action = btn.dataset.action;
        document.getElementById('edit-name').value = btn.dataset.name || '';
        document.getElementById('edit-sku').value = btn.dataset.sku === 'null' ? '' : (btn.dataset.sku || '');
        document.getElementById('edit-category').value = btn.dataset.category === 'null' ? '' : (btn.dataset.category || '');
        document.getElementById('edit-price').value = btn.dataset.price || 0;
        document.getElementById('edit-stock').value = btn.dataset.stock || 0;
        
        // CORRECTION DE L'ID : edit-desc au lieu de edit-description
        document.getElementById('edit-desc').value = btn.dataset.description === 'null' ? '' : (btn.dataset.description || '');
        
        document.getElementById('edit-fournisseur').value = btn.dataset.fournisseurId || '';
        
        document.getElementById('edit-product-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeEditModal() {
        document.getElementById('edit-product-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function openDeleteModal(btn) {
        document.getElementById('delete-product-form').action = btn.dataset.action;
        document.getElementById('delete-product-name').textContent = btn.dataset.name || 'ce produit';

        document.getElementById('delete-product-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('delete-product-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeProductModal();
            closeEditModal();
            closeDeleteModal();
        }
    });

    // Auto-recherche via le champ (Debounce)
    (function () {
        const input = document.getElementById('searchInput');
        if (!input) return;
        const spinner = document.getElementById('search-spinner');
        let timer;
        input.addEventListener('input', function () {
            if(spinner) spinner.classList.remove('hidden');
            clearTimeout(timer);
            timer = setTimeout(() => input.form.submit(), 500);
        });
    })();

    // Ouvre le modal d'ajout automatiquement si ?new=1
    if (new URLSearchParams(window.location.search).get('new') === '1') {
        openProductModal();
    }
</script>

</body>
</html>