
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employés - SwiftHub</title>

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

        /* ══════════════ EMPLOYEE CARDS ══════════════ */
        .employee-card {
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: transform .25s cubic-bezier(.34,1.4,.64,1), box-shadow .25s ease, border-color .25s ease;
            position: relative;
            overflow: hidden;
        }
        .employee-card::before {
            content: '';
            position: absolute;
            inset: 0 0 auto 0;
            height: 3px;
            background: linear-gradient(90deg, #F26B6B, var(--accent) 60%, #B91C1C);
            opacity: 0;
            transition: opacity .25s ease;
        }
        .employee-card:hover {
            transform: translateY(-4px);
            border-color: #E2C7C7;
            box-shadow: var(--shadow-md), var(--shadow-accent);
        }
        .employee-card:hover::before { opacity: 1; }

        .employee-actions {
            opacity: 0;
            transform: translateY(-2px);
            transition: opacity .2s ease, transform .2s ease;
        }
        .employee-card:hover .employee-actions,
        .employee-card:focus-within .employee-actions {
            opacity: 1;
            transform: translateY(0);
        }

        .action-btn {
            transition: all .18s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 10px;
        }
        .action-btn:hover { background: var(--hover); transform: scale(1.05); }
        .action-btn:hover svg { color: var(--accent) !important; }
        .action-btn:active { transform: scale(0.95); }

        .avatar-badge {
            width: 46px; height: 46px; border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 17px; color: #fff; flex-shrink: 0;
            background: linear-gradient(135deg, #F26B6B 0%, var(--accent) 60%, #A81F1F 100%);
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.35), inset 0 1px 0 rgba(255,255,255,0.2);
            letter-spacing: -0.02em;
            position: relative;
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .employee-card:hover .avatar-badge { transform: rotate(-8deg) scale(1.08); }
        .avatar-badge::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: linear-gradient(180deg, rgba(255,255,255,0.15) 0%, transparent 50%);
            pointer-events: none;
        }

        .detail-row { color: var(--text-soft); font-size: 13.5px; }
        .detail-row svg { color: var(--muted-soft); flex-shrink: 0; }

        .position-badge {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: 11.5px; font-weight: 700;
            padding: 4px 10px; border-radius: 8px;
            background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%);
            color: var(--accent);
            border: 1px solid #F5D5D5;
            letter-spacing: -0.005em;
            box-shadow: 0 1px 3px -1px rgba(214,40,40,0.15);
        }
        .position-badge::before {
            content: ''; width: 5px; height: 5px; border-radius: 50%;
            background: var(--accent);
            box-shadow: 0 0 0 2px rgba(214,40,40,0.2);
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

        .btn-ghost { transition: all .18s ease; letter-spacing: -0.01em; }
        .btn-ghost:hover { background: var(--hover); color: var(--text); }

        .field-label { font-size: 12.5px; font-weight: 600; color: var(--text-soft); margin-bottom: 7px; display: block; letter-spacing: -0.005em; }
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

        /* ══════════════ MODAL ══════════════ */
        .app-modal.hidden { display: none; }
        .app-modal { position: fixed; inset: 0; z-index: 60; }

        .app-modal:not(.hidden) .overlay { animation: fadeIn .2s ease; }
        .app-modal:not(.hidden) .panel { animation: modalIn .28s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(12px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .app-modal .overlay {
            position: absolute; inset: 0;
            background: rgba(15, 10, 10, 0.42);
            backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);
        }
        .app-modal .panel {
            position: relative; z-index: 1;
            max-width: 500px; width: 92%;
            margin: 6vh auto 0;
            background: var(--surface);
            border-radius: 22px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255,255,255,0.6);
            overflow: hidden;
        }

        /* ══════════════ EMPTY STATE ══════════════ */
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

    {{-- SIDEBAR --}}
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

                <a href="{{ route('employees.index') }}" class="nav-link active flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition" aria-current="page">
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


    {{-- CONTENU PRINCIPAL --}}
    <main class="flex-1 ml-64">

        {{-- HEADER --}}
        <header class="topbar px-8 py-4 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-extrabold tracking-tight leading-tight">Employés</h2>
                <p class="text-[14.5px] mt-1 flex items-center gap-2" style="color: var(--muted);">
                    <span class="count-pill">{{ isset($employees) ? $employees->count() : 0 }}</span>
                    employé(s) enregistré(s)
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


        {{-- CONTENU --}}
        <div class="p-8">

            {{-- Barre d'action --}}
            <div class="flex items-center justify-between gap-4 mb-8">

                <form method="GET" action="{{ route('employees.index') }}" class="relative flex-1 max-w-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none" style="color: var(--muted-soft);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35M18 11a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                    </svg>
                    <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher un employé..."
                           class="field-input search-input w-full" id="searchInput">
                    @if(!empty($search))
                        <a href="{{ route('employees.index') }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[12px] font-semibold px-2 py-1 rounded-md transition hover:bg-[var(--accent-soft)]" style="color: var(--accent);">
                            Effacer
                        </a>
                    @endif
                </form>

                <button onclick="openEmployeeModal()"
                        class="btn-primary flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 5v14M5 12h14" />
                    </svg>
                    Ajouter un employé
                </button>

            </div>

            {{-- Grille d'employés --}}
            @if(isset($employees) && count($employees) > 0)

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5" id="employees-grid">
                    @foreach($employees as $employee)
                        <div class="employee-card rounded-2xl p-5">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="avatar-badge">{{ strtoupper(substr($employee->name, 0, 1)) }}</div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-[14.5px] truncate leading-tight" style="color: var(--text);">{{ $employee->name }}</p>
                                        @if($employee->position)
                                            <span class="position-badge mt-1.5 inline-flex">{{ $employee->position }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="employee-actions flex items-center gap-0.5">
                                    <button type="button" onclick="openEditModal(this)"
                                            data-id="{{ $employee->id }}"
                                            data-name="{{ $employee->name }}"
                                            data-email="{{ $employee->email }}"
                                            data-phone="{{ $employee->phone }}"
                                            data-position="{{ $employee->position }}"
                                            data-salary="{{ $employee->salary }}"
                                            data-hire_date="{{ optional($employee->hire_date)->format('Y-m-d') }}"
                                            data-action="{{ route('employees.update', $employee) }}"
                                            class="action-btn w-8 h-8 flex items-center justify-center" title="Modifier">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" />
                                        </svg>
                                    </button>
                                    <button type="button" onclick="openDeleteModal(this)"
                                            data-name="{{ $employee->name }}"
                                            data-action="{{ route('employees.destroy', $employee) }}"
                                            class="action-btn w-8 h-8 flex items-center justify-center" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m2 0-.7 12.1a2 2 0 0 1-2 1.9H8.7a2 2 0 0 1-2-1.9L6 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 space-y-2.5" style="border-top: 1px solid var(--border);">
                                <div class="detail-row flex items-center gap-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Zm0 0 9 6 9-6" />
                                    </svg>
                                    <span class="truncate">{{ $employee->email }}</span>
                                </div>
                                @if($employee->phone)
                                <div class="detail-row flex items-center gap-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 5a2 2 0 0 1 2-2h2.28a1 1 0 0 1 .97.76l1.1 4.4a1 1 0 0 1-.5 1.13l-1.7.85a12 12 0 0 0 6.71 6.71l.85-1.7a1 1 0 0 1 1.13-.5l4.4 1.1a1 1 0 0 1 .76.97V19a2 2 0 0 1-2 2h-1C8.82 21 3 15.18 3 8V5Z" />
                                    </svg>
                                    <span class="truncate">{{ $employee->phone }}</span>
                                </div>
                                @endif
                                @if($employee->hire_date)
                                <div class="detail-row flex items-center gap-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 2v4M16 2v4M3.5 9h17M5 4h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z" />
                                    </svg>
                                    <span class="truncate">Depuis le {{ $employee->hire_date->format('d/m/Y') }}</span>
                                </div>
                                @endif
                            </div>

                            @if($employee->salary)
                            <div class="mt-4 pt-4 flex items-end justify-between" style="border-top: 1px solid var(--border);">
                                <p class="text-[11px] font-semibold uppercase tracking-wider" style="color: var(--muted);">Salaire mensuel</p>
                                <p class="font-mono text-[18px] font-bold" style="color: var(--ink);">
                                    {{ number_format($employee->salary, 2, ',', ' ') }} <span style="font-family: var(--font-body); font-size: 12px; color: var(--muted);">DH</span>
                                </p>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            @else

                <div class="empty-state rounded-3xl py-20 text-center px-6">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="M17 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 5 18.5V20M10 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19 20v-1.2a3 3 0 0 0-2-2.83M15.5 4.2a3 3 0 0 1 0 5.6" />
                        </svg>
                    </div>
                    <h4 class="text-[17px] font-bold tracking-tight">Aucun employé pour le moment</h4>
                    <p class="text-[13.5px] mt-2 max-w-sm mx-auto" style="color: var(--muted);">Ajoutez votre premier employé pour commencer à gérer votre équipe.</p>
                    <button onclick="openEmployeeModal()" class="btn-primary mt-6 px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 5v14M5 12h14" />
                        </svg>
                        Ajouter un employé
                    </button>
                </div>

            @endif

        </div>

    </main>

</div>


{{-- MODAL : Ajouter un employé --}}
<div id="employee-modal" class="app-modal hidden">
    <div class="overlay" onclick="closeEmployeeModal()"></div>

    <div class="panel">
        <form method="POST" action="{{ route('employees.store') }}">
            @csrf

            <div class="flex items-center justify-between p-6 pb-5" style="border-bottom: 1px solid var(--border);">
                <div>
                    <h3 class="text-[17px] font-bold tracking-tight leading-tight">Nouvel employé</h3>
                    <p class="text-[12.5px] mt-1" style="color: var(--muted);">Ajoutez un membre à votre équipe</p>
                </div>
                <button type="button" onclick="closeEmployeeModal()" class="w-8 h-8 rounded-lg flex items-center justify-center transition hover:bg-[var(--hover)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="field-label">Nom complet <span style="color: var(--accent);">*</span></label>
                    <input type="text" name="name" required class="field-input" placeholder="Ex : Sara Bennani">
                </div>
                <div>
                    <label class="field-label">Email <span style="color: var(--accent);">*</span></label>
                    <input type="email" name="email" required class="field-input" placeholder="sara@exemple.com">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label">Téléphone</label>
                        <input type="text" name="phone" class="field-input" placeholder="06 12 34 56 78">
                    </div>
                    <div>
                        <label class="field-label">Poste</label>
                        <input type="text" name="position" class="field-input" placeholder="Commercial">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label">Salaire mensuel (DH)</label>
                        <input type="number" step="0.01" min="0" name="salary" class="field-input" placeholder="0.00">
                    </div>
                    <div>
                        <label class="field-label">Date d'embauche</label>
                        <input type="date" name="hire_date" class="field-input">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2.5 px-6 py-5" style="background: var(--surface-soft); border-top: 1px solid var(--border);">
                <button type="button" onclick="closeEmployeeModal()" class="btn-ghost px-4 py-2.5 rounded-xl font-semibold text-[13.5px]" style="color: var(--muted);">
                    Annuler
                </button>
                <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">
                    Enregistrer l'employé
                </button>
            </div>
        </form>
    </div>
</div>


{{-- MODAL : Modifier un employé --}}
<div id="edit-employee-modal" class="app-modal hidden">
    <div class="overlay" onclick="closeEditModal()"></div>

    <div class="panel">
        <form id="edit-employee-form" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="flex items-center justify-between p-6 pb-5" style="border-bottom: 1px solid var(--border);">
                <div>
                    <h3 class="text-[17px] font-bold tracking-tight leading-tight">Modifier l'employé</h3>
                    <p class="text-[12.5px] mt-1" style="color: var(--muted);">Mettez à jour la fiche employé</p>
                </div>
                <button type="button" onclick="closeEditModal()" class="w-8 h-8 rounded-lg flex items-center justify-center transition hover:bg-[var(--hover)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="field-label">Nom complet <span style="color: var(--accent);">*</span></label>
                    <input type="text" name="name" id="edit-name" required class="field-input">
                </div>
                <div>
                    <label class="field-label">Email <span style="color: var(--accent);">*</span></label>
                    <input type="email" name="email" id="edit-email" required class="field-input">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label">Téléphone</label>
                        <input type="text" name="phone" id="edit-phone" class="field-input">
                    </div>
                    <div>
                        <label class="field-label">Poste</label>
                        <input type="text" name="position" id="edit-position" class="field-input">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label">Salaire mensuel (DH)</label>
                        <input type="number" step="0.01" min="0" name="salary" id="edit-salary" class="field-input">
                    </div>
                    <div>
                        <label class="field-label">Date d'embauche</label>
                        <input type="date" name="hire_date" id="edit-hire_date" class="field-input">
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2.5 px-6 py-5" style="background: var(--surface-soft); border-top: 1px solid var(--border);">
                <button type="button" onclick="closeEditModal()" class="btn-ghost px-4 py-2.5 rounded-xl font-semibold text-[13.5px]" style="color: var(--muted);">
                    Annuler
                </button>
                <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>


{{-- MODAL : Confirmer la suppression --}}
<div id="delete-employee-modal" class="app-modal hidden">
    <div class="overlay" onclick="closeDeleteModal()"></div>

    <div class="panel" style="max-width: 420px;">
        <form id="delete-employee-form" method="POST" action="">
            @csrf
            @method('DELETE')

            <div class="p-6 pt-7">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%); box-shadow: 0 4px 12px -4px rgba(214,40,40,0.25), inset 0 1px 0 rgba(255,255,255,0.7);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                    </svg>
                </div>
                <h3 class="text-[17px] font-bold tracking-tight">Supprimer cet employé ?</h3>
                <p class="text-[13.5px] mt-2 leading-relaxed" style="color: var(--muted);">
                    Tu es sur le point de supprimer <span id="delete-employee-name" class="font-semibold" style="color: var(--text);"></span>.
                    Cette action est définitive et ne peut pas être annulée.
                </p>
            </div>

            <div class="flex items-center justify-end gap-2.5 px-6 py-5" style="background: var(--surface-soft); border-top: 1px solid var(--border);">
                <button type="button" onclick="closeDeleteModal()" class="btn-ghost px-4 py-2.5 rounded-xl font-semibold text-[13.5px]" style="color: var(--muted);">
                    Annuler
                </button>
                <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">
                    Oui, supprimer
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    function openEmployeeModal() {
        document.getElementById('employee-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeEmployeeModal() {
        document.getElementById('employee-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function openEditModal(btn) {
        document.getElementById('edit-employee-form').action = btn.dataset.action;
        document.getElementById('edit-name').value = btn.dataset.name || '';
        document.getElementById('edit-email').value = btn.dataset.email || '';
        document.getElementById('edit-phone').value = btn.dataset.phone === 'null' ? '' : (btn.dataset.phone || '');
        document.getElementById('edit-position').value = btn.dataset.position === 'null' ? '' : (btn.dataset.position || '');
        document.getElementById('edit-salary').value = btn.dataset.salary === 'null' ? '' : (btn.dataset.salary || '');
        document.getElementById('edit-hire_date').value = btn.dataset.hire_date || '';

        document.getElementById('edit-employee-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeEditModal() {
        document.getElementById('edit-employee-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function openDeleteModal(btn) {
        document.getElementById('delete-employee-form').action = btn.dataset.action;
        document.getElementById('delete-employee-name').textContent = btn.dataset.name || 'cet employé';

        document.getElementById('delete-employee-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('delete-employee-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeEmployeeModal();
            closeEditModal();
            closeDeleteModal();
        }
    });

    if (new URLSearchParams(window.location.search).get('new') === '1') {
        openEmployeeModal();
    }

    (function () {
        const input = document.querySelector('form[action="{{ route('employees.index') }}"] input[name="search"]');
        if (!input) return;
        let timer;
        input.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(() => input.form.submit(), 500);
        });
    })();
</script>

</body>
</html>