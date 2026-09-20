
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Factures - SwiftHub</title>

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

        .count-pill {
            display: inline-flex; align-items: center;
            padding: 3px 10px; border-radius: 999px;
            font-size: 12px; font-weight: 700;
            background: var(--accent-soft); color: var(--accent);
            letter-spacing: -0.005em; box-shadow: 0 2px 8px -2px var(--accent-glow);
        }

        /* ══════════════ BUTTONS & INPUTS ══════════════ */
        .btn-primary {
            position: relative;
            background: linear-gradient(180deg, #E13333 0%, var(--accent) 50%, var(--accent-dark) 100%);
            box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset, 0 4px 14px rgba(214,40,40,0.28), 0 1px 2px rgba(214,40,40,0.2);
            transition: all .2s cubic-bezier(0.4, 0, 0.2, 1); letter-spacing: -0.01em;
        }
        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset, 0 8px 22px rgba(214,40,40,0.35), 0 2px 4px rgba(214,40,40,0.25);
            filter: brightness(1.05);
        }
        .btn-primary:active { transform: translateY(0); box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset, 0 2px 8px rgba(214,40,40,0.3); }

        .field-input {
            width: 100%; border: 1px solid var(--border); border-radius: 12px;
            padding: 11px 14px; font-size: 14.5px; font-family: var(--font-body);
            background: var(--surface); color: var(--text);
            transition: all .18s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: var(--shadow-sm);
        }
        .field-input::placeholder { color: var(--muted-soft); }
        .field-input:hover { border-color: var(--border-strong); }
        .field-input:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 4px var(--accent-glow), var(--shadow-sm); }
        .search-input { padding-left: 42px !important; }

        /* ══════════════ TABLE FACTURES ══════════════ */
        .panel {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        
        .facture-table th {
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.05em; color: var(--muted);
            background: var(--surface-soft); border-bottom: 1px solid var(--border);
            padding: 14px 24px;
        }
        
        .facture-row { transition: all .2s ease; border-bottom: 1px solid var(--border); }
        .facture-row:last-child { border-bottom: none; }
        .facture-row:hover { background: var(--hover-soft); }
        
        .facture-client-avatar {
            width: 32px; height: 32px; border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 13px; color: var(--accent);
            background: var(--accent-soft); flex-shrink: 0;
        }

        .btn-view {
            display: inline-flex; items-center; justify-content: center;
            padding: 6px 14px; border-radius: 8px;
            font-size: 13px; font-weight: 600; color: var(--text);
            background: var(--surface); border: 1px solid var(--border-strong);
            box-shadow: var(--shadow-sm); transition: all .2s ease;
        }
        .btn-view:hover {
            border-color: var(--accent); color: var(--accent);
            box-shadow: 0 2px 8px rgba(214,40,40,0.1); transform: translateY(-1px);
        }

        /* Badges de Statut (Premium) */
        .status-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 8px;
            font-size: 12px; font-weight: 700; font-family: var(--font-body);
            letter-spacing: -0.01em; text-transform: capitalize;
        }
        .status-badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }

        .status-en_attente {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            color: #B45309; border: 1px solid #FDE68A;
        }
        .status-en_attente::before { background: #F59E0B; box-shadow: 0 0 0 2px rgba(245,158,11,0.2); }

        .status-payee {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #065F46; border: 1px solid #A7F3D0;
        }
        .status-payee::before { background: #10B981; box-shadow: 0 0 0 2px rgba(16,185,129,0.2); }

        .status-en_retard {
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            color: #B91C1C; border: 1px solid #FECACA;
        }
        .status-en_retard::before { background: #EF4444; box-shadow: 0 0 0 2px rgba(239,68,68,0.2); animation: pulse-dot 2s infinite; }

        /* ══════════════ FLASH & EMPTY STATE ══════════════ */
        .flash {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 13px 16px; border-radius: var(--radius);
            font-size: 14px; font-weight: 550;
            animation: modalIn .3s ease;
        }
        .flash-success { background: var(--green-soft); color: var(--green); border: 1px solid #CFEBDD; }
        .flash-error   { background: var(--accent-soft); color: var(--accent); border: 1px solid #F5D5D5; }
        
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(12px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .empty-state {
            border: 1px dashed var(--border-strong);
            background: radial-gradient(circle at 50% 0%, var(--accent-soft) 0%, transparent 60%), var(--surface-soft);
        }
        .empty-icon {
            width: 56px; height: 56px; border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%);
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.25), inset 0 1px 0 rgba(255,255,255,0.7);
            margin: 0 auto 16px;
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
                <a href="{{ route('dashboard') }}" class="nav-link flex items-center gap-3 px-4 py-2.5 text-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5 9.5V21h14V9.5" /></svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route("analytics.index")}}"  class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5M4 19h16M8 19v-6M13 19v-9M18 19v-4" /></svg>
                    <span>Analytique</span>
                </a>
                <a href="{{ route('clients.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" /></svg>
                    <span>Clients</span>
                </a>
                <a href="{{ route('fournisseurs.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M4 10v9a1 1 0 0 0 1 1h4v-6h6v6h4a1 1 0 0 0 1-1v-9" /></svg>
                    <span>Fournisseurs</span>
                </a>
            </div>

            <p class="side-label">Gestion</p>
            <div class="space-y-1">
                <a href="{{ route('products.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" /></svg>
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
                <a href="{{ route('factures.index') }}" class="nav-link active flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5M9 13h6M9 16.5h6" /></svg>
                    <span>Factures</span>
                </a>
                <a href="{{ route('employees.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 5 18.5V20M10 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19 20v-1.2a3 3 0 0 0-2-2.83M15.5 4.2a3 3 0 0 1 0 5.6" /></svg>
                    <span>Employés</span>
                </a>

                {{-- Gestion financière (sous-menu) --}}
                <details class="group">
                    <summary class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition cursor-pointer list-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 6v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6M3 6l2-3h14l2 3M9 12h6" /></svg>
                        <span class="flex-1">Gestion financière</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="chevron w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="m9 6 6 6-6 6" /></svg>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a1 1 0 0 1 1 1v16l-6-3-6 3V4a1 1 0 0 1 1-1ZM9 8h6M9 11.5h6" /></svg>
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


    {{-- CONTENU PRINCIPAL --}}
    <main class="flex-1 lg:ml-64">

        <header class="topbar px-8 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight leading-tight">Factures</h2>
                <p class="text-[14.5px] mt-1 flex items-center gap-2" style="color: var(--muted);">
                    <span class="count-pill">{{ $factures->count() }}</span>
                    facture(s) au total
                </p>
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

            <div class="flex items-center justify-between gap-4 mb-8">
                <form method="GET" action="{{ route('factures.index') }}" class="relative flex-1 max-w-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none" style="color: var(--muted-soft);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M18 11a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher une facture ou un client..."
                           class="field-input search-input w-full" id="searchInput">
                    @if(!empty($search))
                        <a href="{{ route('factures.index') }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[12px] font-semibold px-2 py-1 rounded-md transition hover:bg-[var(--accent-soft)]" style="color: var(--accent);">
                            Effacer
                        </a>
                    @endif
                </form>

                <a href="{{ route('factures.create') }}" class="btn-primary flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 5v14M5 12h14" />
                    </svg>
                    Nouvelle facture
                </a>
            </div>

            {{-- Liste / Tableau --}}
            @if($factures->count() > 0)
                <div class="panel">
                    <table class="w-full text-left facture-table">
                        <thead>
                            <tr>
                                <th>Numéro</th>
                                <th>Client</th>
                                <th>Échéance</th>
                                <th class="text-right">Montant TTC</th>
                                <th>Statut</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factures as $f)
                            <tr class="facture-row">
                                <td class="px-6 py-4">
                                    <span class="font-mono font-semibold" style="color: var(--ink);">{{ $f->numero }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="facture-client-avatar">
                                            {{ strtoupper(substr($f->client->name, 0, 1)) }}
                                        </div>
                                        <span class="font-semibold text-[14.5px]">{{ $f->client->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span style="color: var(--muted); font-size: 14px;">{{ $f->date_echeance?->format('d/m/Y') ?? '—' }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-mono font-bold text-[16px]" style="color: var(--ink);">
                                        {{ number_format($f->total_ttc, 2, ',', ' ') }} <span style="font-family: var(--font-body); font-size: 12px; color: var(--muted);">DH</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="status-badge status-{{ $f->statut }}">
                                        @if($f->statut == 'en_attente') En attente
                                        @elseif($f->statut == 'payee') Payée
                                        @elseif($f->statut == 'en_retard') En retard
                                        @else {{ $f->statut }} @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('factures.show', $f) }}" class="btn-view">
                                        Voir la facture
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                {{-- Etat vide --}}
                <div class="empty-state rounded-3xl py-20 text-center px-6">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5" />
                        </svg>
                    </div>
                    <h4 class="text-[17px] font-bold tracking-tight">Aucune facture pour le moment</h4>
                    <p class="text-[13.5px] mt-2 max-w-sm mx-auto" style="color: var(--muted);">Créez une facture, ou transformez un devis accepté.</p>
                    <a href="{{ route('factures.create') }}" class="btn-primary mt-6 px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 5v14M5 12h14" />
                        </svg>
                        Nouvelle facture
                    </a>
                </div>
            @endif

        </div>

    </main>

</div>

<script>
    // Auto-recherche via le champ (Debounce)
    (function () {
        const input = document.getElementById('searchInput');
        if (!input) return;
        let timer;
        input.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(() => input.form.submit(), 500);
        });
    })();
    
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
