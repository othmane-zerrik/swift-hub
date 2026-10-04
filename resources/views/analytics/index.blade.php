<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytique - SwiftHub</title>
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
            --hover-soft: #FAF8F7;
            --text: #171717;
            --text-soft: #3F3F3D;
            --muted: #8B8B86;
            --muted-soft: #A8A8A3;
            --accent: #D62828;
            --accent-dark: #B01F1F;
            --accent-soft: #FCE8E8;
            --accent-glow: rgba(214, 40, 40, 0.12);
            --accent-glow-lg: rgba(214, 40, 40, 0.35);
            --green: #16794C;
            --green-soft: #E7F6EE;
            --amber: #C9862F;
            --amber-soft: #FBF0E1;
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

        body { font-family: var(--font-body); background: var(--bg); color: var(--text); font-feature-settings: "ss01", "cv11"; }
        .font-mono { font-family: var(--font-mono); }
        h1, h2, h3, h4 { font-family: var(--font-body); letter-spacing: -0.025em; }
        .icon { width: 18px; height: 18px; stroke-width: 1.6; flex-shrink: 0; }

        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #DDDDD8; border-radius: 10px; border: 3px solid var(--bg); }
        ::-webkit-scrollbar-thumb:hover { background: #C7C7C1; }

        ::selection { background: var(--accent); color: #fff; }

        /* ══════════════ SIDEBAR ══════════════ */
        .side-label {
            font-size: 10.5px; font-weight: 700; letter-spacing: .12em;
            text-transform: uppercase; color: #C4C4BE; padding: 0 20px; margin: 18px 0 6px;
        }

        .nav-link { position: relative; border-radius: 12px; color: var(--muted); }
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
            background: rgba(255,255,255,0.9); transform: translateY(-50%);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.25);
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { box-shadow: 0 0 0 3px rgba(255,255,255,0.25); }
            50% { box-shadow: 0 0 0 5px rgba(255,255,255,0.12); }
        }

        /* Sous-menu */
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
            content: ''; position: absolute; inset: -3px; border-radius: 50%;
            border: 2px solid var(--accent); opacity: .5; animation: ring 2.2s ease-out infinite;
        }
        @keyframes ring { 0% { transform: scale(.6); opacity: .6; } 100% { transform: scale(1.6); opacity: 0; } }

        .logout-btn { transition: all .2s ease; color: var(--muted); border: 1px solid transparent; }
        .logout-btn:hover { background: var(--accent-soft); color: var(--accent); border-color: #F5D5D5; }
        .logout-btn:hover svg { transform: translateX(2px); }

        /* ══════════════ TOPBAR ══════════════ */
        .topbar {
            position: sticky; top: 0; z-index: 5;
            backdrop-filter: saturate(180%) blur(16px); -webkit-backdrop-filter: saturate(180%) blur(16px);
            border-bottom: 1px solid var(--border); background: rgba(247,247,245,0.85);
        }

        .user-avatar {
            width: 40px; height: 40px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; color: #fff;
            background: linear-gradient(135deg, #F26B6B, var(--accent));
            box-shadow: 0 4px 12px -4px var(--accent-glow), var(--shadow-accent);
            letter-spacing: -0.02em;
        }

        /* ══════════════ STAT CARDS ══════════════ */
        .stat-card {
            position: relative;
            overflow: hidden;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: transform .25s cubic-bezier(.34,1.4,.64,1), box-shadow .25s ease, border-color .25s ease;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            opacity: 0;
            transition: opacity .25s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--border-strong);
            box-shadow: var(--shadow-md);
        }
        .stat-card:hover::before { opacity: 1; }

        .stat-card.stat-green::before { background: linear-gradient(90deg, #34D399, #16794C 60%, #065F46); }
        .stat-card.stat-green:hover { box-shadow: var(--shadow-md), 0 8px 24px -8px rgba(22,121,76,0.28); border-color: #B8DCC9; }

        .stat-card.stat-accent::before { background: linear-gradient(90deg, #F26B6B, var(--accent) 60%, #B91C1C); }
        .stat-card.stat-accent:hover { box-shadow: var(--shadow-md), var(--shadow-accent); border-color: #E2C7C7; }

        .stat-icon {
            width: 42px; height: 42px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 12px;
            flex-shrink: 0;
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .stat-card:hover .stat-icon { transform: rotate(-8deg) scale(1.08); }

        .stat-icon-green {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: var(--green);
            box-shadow: 0 4px 12px -4px rgba(22,121,76,0.2), inset 0 1px 0 rgba(255,255,255,0.7);
        }
        .stat-icon-accent {
            background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%);
            color: var(--accent);
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.25), inset 0 1px 0 rgba(255,255,255,0.7);
        }

        /* ══════════════ EVOLUTION INDICATORS ══════════════ */
        .evolution-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 10px; border-radius: 8px;
            font-size: 11.5px; font-weight: 700;
            letter-spacing: -0.01em;
        }
        .evolution-up {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #065F46; border: 1px solid #A7F3D0;
            box-shadow: 0 2px 8px -2px rgba(16,185,129,0.15);
        }
        .evolution-down {
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            color: #B91C1C; border: 1px solid #FECACA;
            box-shadow: 0 2px 8px -2px rgba(220,38,38,0.15);
        }

        /* ══════════════ PROGRESS / METRICS ══════════════ */
        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow .25s ease;
            overflow: hidden;
        }
        .panel:hover { box-shadow: var(--shadow-md); }

        .panel-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-soft);
            display: flex; align-items: center; justify-content: space-between;
            gap: 12px;
        }

        .panel-icon {
            width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 10px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%);
            color: var(--accent);
            box-shadow: 0 3px 10px -3px rgba(214,40,40,0.25), inset 0 1px 0 rgba(255,255,255,0.7);
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .panel:hover .panel-icon { transform: rotate(-8deg) scale(1.06); }

        .panel-body { padding: 24px; }

        .progress-track {
            height: 12px; border-radius: 999px; background: #EDEDE9; overflow: hidden; display: flex;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.06);
        }
        .progress-accepte { background: linear-gradient(90deg, #34D399, #10B981); height: 100%; transition: width 0.6s ease; }
        .progress-refuse { background: linear-gradient(90deg, #F26B6B, var(--accent)); height: 100%; transition: width 0.6s ease; }
        .progress-attente { background: linear-gradient(90deg, #FCD34D, var(--amber)); height: 100%; transition: width 0.6s ease; }

        .metric-badge {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 13px; font-weight: 600; color: var(--text-soft);
        }
        .metric-dot { width: 8px; height: 8px; border-radius: 50%; }

        /* ══════════════ RANKING / TOP LISTS ══════════════ */
        .rank-badge {
            width: 26px; height: 26px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 11.5px; font-weight: 800; font-family: var(--font-mono);
            flex-shrink: 0;
        }
        .rank-1 { background: linear-gradient(135deg, #FEF3C7 0%, #F59E0B 100%); color: #92400E; border: 1px solid #FCD34D; }
        .rank-2 { background: linear-gradient(135deg, #F3F4F6 0%, #9CA3AF 100%); color: #374151; border: 1px solid #D1D5DB; }
        .rank-3 { background: linear-gradient(135deg, #FFEDD5 0%, #D97706 100%); color: #78350F; border: 1px solid #FED7AA; }
        .rank-other { background: var(--hover-soft); color: var(--muted); border: 1px solid var(--border); }

        .ranking-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 0;
        }
        .ranking-row + .ranking-row { border-top: 1px solid var(--border); }

        /* ══════════════ STOCK ALERTS ══════════════ */
        .alert-stock {
            position: relative;
            display: flex; align-items: center; justify-content: space-between;
            padding: 12px 0;
        }
        .alert-stock + .alert-stock { border-top: 1px solid var(--border); }

        .stock-tag {
            font-family: var(--font-mono);
            font-size: 11.5px; font-weight: 700;
            padding: 4px 10px; border-radius: 8px;
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            color: var(--accent); border: 1px solid #FECACA;
            box-shadow: 0 2px 8px -2px rgba(220,38,38,0.15);
            display: inline-flex; align-items: center; gap: 4px;
        }
        .stock-tag::before {
            content: ''; width: 5px; height: 5px; border-radius: 50%;
            background: #EF4444; box-shadow: 0 0 0 2px rgba(239,68,68,0.2);
            animation: pulse-dot 2s infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { box-shadow: 0 0 0 2px rgba(239,68,68,0.2); }
            50% { box-shadow: 0 0 0 4px rgba(239,68,68,0.08); }
        }

        summary::-webkit-details-marker { display: none; }
        summary { list-style: none; }
        details[open] summary .chevron { transform: rotate(90deg); }
        .chevron { transition: transform .25s ease; }
    </style>
</head>
<body class="text-[16px]">
<div class="flex min-h-screen">

    {{-- Bouton menu (mobile uniquement) --}}
    <button onclick="openSidebar()" class="lg:hidden fixed top-4 left-4 z-30 w-10 h-10 rounded-lg flex items-center justify-center" style="background: var(--surface); border: 1px solid var(--border); box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    {{-- Fond sombre quand le menu est ouvert (mobile) --}}
    <div id="sidebar-overlay" onclick="closeSidebar()" class="fixed inset-0 bg-black/40 z-40 hidden"></div>

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="w-64 flex flex-col fixed inset-y-0 left-0 overflow-y-auto -translate-x-full lg:translate-x-0 transition-transform duration-300" style="background: var(--surface); border-right: 1px solid var(--border); z-index: 50;">

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

                <a href="{{ route('dashboard') }}" class="nav-link  flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5 9.5V21h14V9.5" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route("analytics.index")}}"  class="nav-link active flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5M4 19h16M8 19v-6M13 19v-9M18 19v-4" />
                    </svg>
                    <span>Analytique</span>
                </a>

                <a href="{{ route('clients.index') }}" class="nav-link  flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition" >
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

                <a href="{{ route('products.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H4a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V4a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
                    </svg>
                    <span>Paramètres</span>
                </a>

            </div>

        </nav>
        <div class="p-4 border-t" style="border-color: var(--border);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn w-full flex items-center gap-3 px-4 py-2.5 text-sm rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8V6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-2M14 12H3m0 0 3.5-3.5M3 12l3.5 3.5" /></svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- CONTENU PRINCIPAL --}}
    <main class="flex-1 lg:ml-64">

        <header class="topbar px-8 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight leading-tight">Analytique</h2>
                <p class="text-[14.5px] mt-1" style="color: var(--muted);">Comprendre la performance de votre activité</p>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="font-semibold text-[15px]">{{ auth()->user()->name }}</p>
                    <p class="text-xs" style="color: var(--muted);">Compte utilisateur</p>
                </div>
                <div class="user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        <div class="p-8 space-y-6">

            {{-- Comparaison mois actuel vs précédent --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="stat-card stat-green p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-[13.5px] font-semibold" style="color: var(--muted);">Chiffre d'affaires</p>
                        <div class="stat-icon stat-icon-green">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-3 mt-4">
                        <p class="font-mono text-[26px] font-bold tracking-tight" style="color: var(--green);">
                            {{ number_format($caMoisActuel, 0, ',', ' ') }} <span style="font-family: var(--font-body); font-size: 13px; font-weight: 600; color: var(--muted);">DH</span>
                        </p>
                        <span class="evolution-badge {{ $evolutionCa >= 0 ? 'evolution-up' : 'evolution-down' }}">
                            {{ $evolutionCa >= 0 ? '↑' : '↓' }} {{ abs($evolutionCa) }}%
                        </span>
                    </div>
                    <p class="text-[11.5px] mt-2.5 font-medium" style="color: var(--muted-soft);">
                        {{ ucfirst($moisActuel->translatedFormat('F')) }} vs {{ number_format($caMoisPrecedent, 0, ',', ' ') }} DH en {{ $moisPrecedent->translatedFormat('F') }}
                    </p>
                </div>

                <div class="stat-card stat-accent p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-[13.5px] font-semibold" style="color: var(--muted);">Nombre de ventes</p>
                        <div class="stat-icon stat-icon-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 0 0-8 0v4M5 11h14a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-end gap-3 mt-4">
                        <p class="font-mono text-[26px] font-bold tracking-tight">
                            {{ $ventesMoisActuel }} <span style="font-family: var(--font-body); font-size: 13px; font-weight: 600; color: var(--muted);">ventes</span>
                        </p>
                        <span class="evolution-badge {{ $evolutionVentes >= 0 ? 'evolution-up' : 'evolution-down' }}">
                            {{ $evolutionVentes >= 0 ? '↑' : '↓' }} {{ abs($evolutionVentes) }}%
                        </span>
                    </div>
                    <p class="text-[11.5px] mt-2.5 font-medium" style="color: var(--muted-soft);">
                        {{ ucfirst($moisActuel->translatedFormat('F')) }} vs {{ $ventesMoisPrecedent }} en {{ $moisPrecedent->translatedFormat('F') }}
                    </p>
                </div>

            </div>

            {{-- Taux de conversion des devis --}}
            <div class="panel">
                <div class="panel-header">
                    <div class="flex items-center gap-3">
                        <div class="panel-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Taux de conversion des devis</h3>
                            <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Ratio des propositions commerciales acceptées</p>
                        </div>
                    </div>
                    <p class="font-mono text-2xl font-bold" style="color: var(--green);">{{ $tauxConversion }}%</p>
                </div>

                <div class="panel-body">
                    @if($totalDevis > 0)
                        <div class="progress-track mb-5">
                            <div class="progress-accepte" style="width: {{ ($devisAcceptes / $totalDevis) * 100 }}%;"></div>
                            <div class="progress-refuse" style="width: {{ ($devisRefuses / $totalDevis) * 100 }}%;"></div>
                            <div class="progress-attente" style="width: {{ ($devisEnAttente / $totalDevis) * 100 }}%;"></div>
                        </div>
                        <div class="flex flex-wrap items-center gap-6">
                            <span class="metric-badge">
                                <span class="metric-dot" style="background: var(--green); box-shadow: 0 0 0 2px rgba(16,185,129,0.2);"></span>
                                {{ $devisAcceptes }} acceptés
                            </span>
                            <span class="metric-badge">
                                <span class="metric-dot" style="background: var(--accent); box-shadow: 0 0 0 2px rgba(214,40,40,0.2);"></span>
                                {{ $devisRefuses }} refusés
                            </span>
                            <span class="metric-badge">
                                <span class="metric-dot" style="background: var(--amber); box-shadow: 0 0 0 2px rgba(245,158,11,0.2);"></span>
                                {{ $devisEnAttente }} en attente
                            </span>
                        </div>
                    @else
                        <p class="text-sm" style="color: var(--muted);">Aucun devis créé pour le moment.</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">

                {{-- Top 5 clients --}}
                <div class="panel">
                    <div class="panel-header">
                        <div class="flex items-center gap-3">
                            <div class="panel-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Top 5 clients</h3>
                                <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Clients générant le plus de revenus</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if($topClients->count() > 0)
                            <div class="space-y-1">
                                @foreach($topClients as $i => $ligne)
                                    <div class="ranking-row">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <span class="rank-badge {{ $i == 0 ? 'rank-1' : ($i == 1 ? 'rank-2' : ($i == 2 ? 'rank-3' : 'rank-other')) }}">
                                                {{ $i + 1 }}
                                            </span>
                                            <p class="text-[14px] font-semibold truncate" style="color: var(--text);">{{ $ligne->client->name }}</p>
                                        </div>
                                        <p class="font-mono text-[14.5px] font-bold" style="color: var(--ink);">
                                            {{ number_format($ligne->total, 0, ',', ' ') }} <span style="font-family: var(--font-body); font-size: 11.5px; color: var(--muted); font-weight: 500;">DH</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm" style="color: var(--muted);">Pas encore assez de factures pour établir un classement.</p>
                        @endif
                    </div>
                </div>

                {{-- Top 5 produits --}}
                <div class="panel">
                    <div class="panel-header">
                        <div class="flex items-center gap-3">
                            <div class="panel-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Top 5 produits vendus</h3>
                                <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Articles les plus populaires en volume</p>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        @if($topProduits->count() > 0)
                            <div class="space-y-1">
                                @foreach($topProduits as $i => $p)
                                    <div class="ranking-row">
                                        <div class="flex items-center gap-3 min-w-0">
                                            <span class="rank-badge {{ $i == 0 ? 'rank-1' : ($i == 1 ? 'rank-2' : ($i == 2 ? 'rank-3' : 'rank-other')) }}">
                                                {{ $i + 1 }}
                                            </span>
                                            <p class="text-[14px] font-semibold truncate" style="color: var(--text);">{{ $p->product_name }}</p>
                                        </div>
                                        <span class="font-mono text-[12px] font-bold px-2.5 py-1 rounded-lg" style="background: var(--hover-soft); color: var(--text-soft); border: 1px solid var(--border);">
                                            {{ $p->total_quantite }} vendus
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm" style="color: var(--muted);">Pas encore assez de factures pour établir un classement.</p>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Alertes stock bas --}}
            <div class="panel">
                <div class="panel-header">
                    <div class="flex items-center gap-3">
                        <div class="panel-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[17px] h-[17px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Alertes stock bas</h3>
                            <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Articles nécessitant un réapprovisionnement</p>
                        </div>
                    </div>
                    <span class="text-[12px] font-bold px-3 py-1 rounded-full" style="background: var(--accent-soft); color: var(--accent); box-shadow: 0 2px 8px -2px var(--accent-glow);">
                        {{ $produitsStockBas->count() }} produit(s)
                    </span>
                </div>

                <div class="panel-body">
                    @if($produitsStockBas->count() > 0)
                        <div class="space-y-1">
                            @foreach($produitsStockBas as $produit)
                                <div class="alert-stock">
                                    <p class="text-[14px] font-semibold" style="color: var(--text);">{{ $produit->name }}</p>
                                    <span class="stock-tag">{{ $produit->stock }} restants</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-4 text-center">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center mb-3" style="background: var(--green-soft); color: var(--green);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </div>
                            <p class="text-[13.5px] font-semibold" style="color: var(--text-soft);">Tout est sous contrôle</p>
                            <p class="text-[12.5px] mt-1" style="color: var(--muted);">Tous vos produits ont un stock suffisant.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </main>
</div>
<script>
    function openSidebar() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.remove('hidden');
    }
    function closeSidebar() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
        document.getElementById('sidebar-overlay').classList.add('hidden');
    }
</script>
</body>
</html>
