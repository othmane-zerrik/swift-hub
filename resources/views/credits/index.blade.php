

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crédits - SwiftHub</title>

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

        details .nav-link { border-radius: 12px; }
        details[open] > summary.nav-link { color: var(--accent); background: var(--accent-soft); }
        details[open] > summary.nav-link::after { display: none; }
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
        .submenu a.sub-active { color: var(--accent) !important; font-weight: 600; }
        .submenu a.sub-active::before { background: var(--accent); transform: translateY(-50%) scale(1.3); }

        .logo-badge { position: relative; width: 8px; height: 8px; border-radius: 50%; background: var(--accent); }
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

        /* ══════════════ BOUTONS ══════════════ */
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
        .btn-primary:active { transform: translateY(0); }

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

        /* ══════════════ ALERT RETARD ══════════════ */
        .alert-retard {
            position: relative;
            display: flex; align-items: center; gap: 14px;
            padding: 16px 20px;
            border-radius: var(--radius);
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            border: 1px solid #FECACA;
            box-shadow: 0 6px 20px -8px rgba(214,40,40,0.2);
            overflow: hidden;
        }
        .alert-retard::before {
            content: '';
            position: absolute;
            top: 0; left: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #F26B6B, var(--accent) 60%, #B91C1C);
        }
        .alert-retard-icon {
            width: 40px; height: 40px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            background: linear-gradient(135deg, #F26B6B 0%, var(--accent) 100%);
            color: #fff;
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.5), inset 0 1px 0 rgba(255,255,255,0.25);
            flex-shrink: 0;
            animation: pulse-alert 2.4s ease-in-out infinite;
        }
        @keyframes pulse-alert {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.06); }
        }

        /* ══════════════ TABS ══════════════ */
        .tabs {
            display: inline-flex;
            padding: 4px;
            border-radius: 14px;
            background: var(--surface);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            gap: 2px;
        }
        .tab {
            padding: 8px 18px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            transition: all .22s cubic-bezier(.34,1.4,.64,1);
            letter-spacing: -0.005em;
            position: relative;
        }
        .tab.active {
            background: linear-gradient(120deg, #E63946 0%, var(--accent) 55%, #B91C1C 100%);
            color: #fff;
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.5), inset 0 1px 0 rgba(255,255,255,0.2);
        }
        .tab:not(.active) { color: var(--muted); }
        .tab:not(.active):hover { background: var(--hover); color: var(--accent); }

        /* ══════════════ TABLE ══════════════ */
        .panel {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        .credit-table th {
            font-size: 12px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.05em; color: var(--muted);
            background: var(--surface-soft); border-bottom: 1px solid var(--border);
            padding: 14px 24px;
        }
        .credit-row { transition: all .2s ease; border-bottom: 1px solid var(--border); }
        .credit-row:last-child { border-bottom: none; }
        .credit-row:hover { background: var(--hover-soft); }

        .type-badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 10px; border-radius: 8px;
            font-size: 11.5px; font-weight: 700;
            letter-spacing: -0.005em;
        }
        .type-badge::before {
            content: ''; width: 5px; height: 5px; border-radius: 50%;
        }
        .type-client {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            color: #1D4ED8; border: 1px solid #BFDBFE;
        }
        .type-client::before { background: #3B82F6; box-shadow: 0 0 0 2px rgba(59,130,246,0.2); }
        .type-fournisseur {
            background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
            color: #4B5563; border: 1px solid #D1D5DB;
        }
        .type-fournisseur::before { background: #6B7280; box-shadow: 0 0 0 2px rgba(107,114,128,0.2); }

        .badge {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 12px; border-radius: 8px;
            font-size: 12px; font-weight: 700;
            letter-spacing: -0.01em;
        }
        .badge::before { content: ''; width: 6px; height: 6px; border-radius: 50%; }

        .badge-en_cours {
            background: linear-gradient(135deg, #F3F4F6 0%, #E5E7EB 100%);
            color: #4B5563; border: 1px solid #D1D5DB;
        }
        .badge-en_cours::before { background: #6B7280; box-shadow: 0 0 0 2px rgba(107,114,128,0.2); }

        .badge-paye {
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #065F46; border: 1px solid #A7F3D0;
        }
        .badge-paye::before { background: #10B981; box-shadow: 0 0 0 2px rgba(16,185,129,0.2); }

        .badge-en_retard {
            background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
            color: #B91C1C; border: 1px solid #FECACA;
        }
        .badge-en_retard::before { background: #EF4444; box-shadow: 0 0 0 2px rgba(239,68,68,0.2); animation: pulse-dot-badge 2s infinite; }
        @keyframes pulse-dot-badge {
            0%, 100% { box-shadow: 0 0 0 2px rgba(239,68,68,0.2); }
            50% { box-shadow: 0 0 0 4px rgba(239,68,68,0.1); }
        }

        .badge-proche {
            background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%);
            color: #B45309; border: 1px solid #FDE68A;
        }
        .badge-proche::before { background: #F59E0B; box-shadow: 0 0 0 2px rgba(245,158,11,0.2); }

        .btn-pay {
            display: inline-flex; align-items: center; justify-content: center; gap: 5px;
            padding: 6px 12px; border-radius: 8px;
            font-size: 12.5px; font-weight: 700;
            color: var(--green);
            background: var(--surface);
            border: 1px solid #B7E4C7;
            transition: all .18s ease;
        }
        .btn-pay:hover {
            background: var(--green-soft);
            border-color: var(--green);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px -4px rgba(22,121,76,0.3);
        }
        .btn-del {
            display: inline-flex; align-items: center; justify-content: center; gap: 5px;
            padding: 6px 12px; border-radius: 8px;
            font-size: 12.5px; font-weight: 700;
            color: var(--accent);
            background: var(--surface);
            border: 1px solid #F5D5D5;
            transition: all .18s ease;
        }
        .btn-del:hover {
            background: var(--accent-soft);
            border-color: var(--accent);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px -4px rgba(214,40,40,0.3);
        }

        /* ══════════════ MODAL ══════════════ */
        .app-modal.hidden { display: none; }
        .app-modal { position: fixed; inset: 0; z-index: 60; }
        .app-modal:not(.hidden) .overlay { animation: fadeIn .2s ease; }
        .app-modal:not(.hidden) .panel-modal { animation: modalIn .28s cubic-bezier(0.16, 1, 0.3, 1); }
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
        .app-modal .panel-modal {
            position: relative; z-index: 1;
            max-width: 460px; width: 92%;
            margin: 8vh auto 0;
            background: var(--surface);
            border-radius: 22px;
            box-shadow: var(--shadow-xl);
            border: 1px solid rgba(255,255,255,0.6);
            overflow: hidden;
        }

        /* ══════════════ FLASH & EMPTY ══════════════ */
        .flash {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 13px 16px; border-radius: var(--radius);
            font-size: 14px; font-weight: 550;
        }
        .flash-success { background: var(--green-soft); color: var(--green); border: 1px solid #CFEBDD; }

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

        .icon-btn {
            width: 32px; height: 32px; border-radius: 10px;
            display: inline-flex; align-items: center; justify-content: center;
            color: var(--muted); border: 1px solid transparent;
            transition: all .25s cubic-bezier(.34,1.56,.64,1);
        }
        .icon-btn:hover { background: var(--accent-soft); border-color: #F5D5D5; color: var(--accent); }
    </style>
</head>

<body class="text-[16px]">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 flex flex-col fixed inset-y-0 left-0 overflow-y-auto" style="background: var(--surface); border-right: 1px solid var(--border); z-index: 10;">

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
                <a href="{{ route('factures.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5M9 13h6M9 16.5h6" /></svg>
                    <span>Factures</span>
                </a>
                <a href="{{ route('employees.index') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 5 18.5V20M10 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19 20v-1.2a3 3 0 0 0-2-2.83M15.5 4.2a3 3 0 0 1 0 5.6" /></svg>
                    <span>Employés</span>
                </a>

                {{-- Gestion financière (sous-menu ouvert) --}}
                <details class="group" open>
                    <summary class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition cursor-pointer list-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 6v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6M3 6l2-3h14l2 3M9 12h6" /></svg>
                        <span class="flex-1 " >Gestion financière</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="chevron w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="m9 6 6 6-6 6" /></svg>
                    </summary>
                    <div class="submenu">
                        <div class="pl-11 pr-4 pb-1 pt-1 space-y-1">
                            <a href="{{ route('finances.index') }}" class="block py-2 text-sm" style="color: var(--muted);">Chiffre d'affaires</a>
                            <a href="{{ route('credits.index') }}" class="block py-2 text-sm sub-active">Crédits</a>
                      
                        </div>
                    </div>
                </details>
            </div>

            <p class="side-label">Système</p>
            <div class="space-y-1">
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a1 1 0 0 1 1 1v16l-6-3-6 3V4a1 1 0 0 1 1-1ZM9 8h6M9 11.5h6" /></svg>
                    <span>Rapports</span>
                </a>
                <a href="{{ route('settings.edit') }}" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H4a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V4a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
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
                <h2 class="text-2xl font-extrabold tracking-tight leading-tight">Crédits</h2>
                <p class="text-[14.5px] mt-1 flex items-center gap-2" style="color: var(--muted);">
                    <span class="count-pill">{{ $credits->count() }}</span>
                    crédit(s) — Suivi des dettes clients et fournisseurs
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

            @if(session('success'))
                <div class="flash flash-success mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 6 9 17l-5-5" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Alerte échéances proches / en retard --}}
            @php
                $enRetard = $credits->filter(fn($c) => $c->statut === 'en_retard');
                $proches = $credits->filter(fn($c) => $c->echeance_proche);
            @endphp

            @if($enRetard->count() > 0 || $proches->count() > 0)
                <div class="alert-retard mb-6">
                    <div class="alert-retard-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-[13.5px] font-extrabold tracking-tight" style="color: var(--accent);">
                            Attention requise
                        </p>
                        <p class="text-[13px] mt-0.5 font-medium" style="color: #9A2020;">
                            @if($enRetard->count() > 0)
                                <strong>{{ $enRetard->count() }}</strong> crédit(s) en retard
                            @endif
                            @if($enRetard->count() > 0 && $proches->count() > 0) · @endif
                            @if($proches->count() > 0)
                                <strong>{{ $proches->count() }}</strong> échéance(s) dans moins de 7 jours
                            @endif
                        </p>
                    </div>
                </div>
            @endif

            {{-- Filtres + bouton --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div class="tabs">
                    <a href="{{ route('credits.index') }}" class="tab {{ !$type ? 'active' : '' }}">Tous</a>
                    <a href="{{ route('credits.index', ['type' => 'client']) }}" class="tab {{ $type === 'client' ? 'active' : '' }}">Clients</a>
                    <a href="{{ route('credits.index', ['type' => 'fournisseur']) }}" class="tab {{ $type === 'fournisseur' ? 'active' : '' }}">Fournisseurs</a>
                </div>

                <a href="{{ route('credits.create') }}" class="btn-primary flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white self-start sm:self-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                    </svg>
                    Nouveau crédit
                </a>
            </div>

            {{-- Tableau --}}
            @if($credits->count() > 0)
                <div class="panel">
                    <table class="w-full text-left credit-table">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Nom</th>
                                <th class="text-right">Montant</th>
                                <th class="text-right">Restant</th>
                                <th>Échéance</th>
                                <th>Statut</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($credits as $credit)
                            <tr class="credit-row">
                                <td class="px-6 py-4">
                                    <span class="type-badge {{ $credit->type === 'client' ? 'type-client' : 'type-fournisseur' }}">
                                        {{ $credit->type === 'client' ? 'Client' : 'Fournisseur' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-semibold text-[14.5px]">{{ $credit->tiers_nom }}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-mono font-semibold text-[14px]" style="color: var(--text-soft);">
                                        {{ number_format($credit->montant, 2, ',', ' ') }} <span style="font-family: var(--font-body); font-size: 11.5px; color: var(--muted);">DH</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="font-mono font-bold text-[15px]" style="color: {{ $credit->montant_restant > 0 ? 'var(--accent)' : 'var(--green)' }};">
                                        {{ number_format($credit->montant_restant, 2, ',', ' ') }} <span style="font-family: var(--font-body); font-size: 11.5px; color: var(--muted);">DH</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span style="color: var(--muted); font-size: 13.5px;">{{ $credit->date_echeance->format('d/m/Y') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($credit->statut === 'paye')
                                        <span class="badge badge-paye">Payé</span>
                                    @elseif($credit->statut === 'en_retard')
                                        <span class="badge badge-en_retard">En retard</span>
                                    @elseif($credit->echeance_proche)
                                        <span class="badge badge-proche">Échéance proche</span>
                                    @else
                                        <span class="badge badge-en_cours">En cours</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <div class="inline-flex items-center gap-2">
                                        @if($credit->statut !== 'paye')
                                            <button type="button"
                                                    onclick="openPaiementModal({{ $credit->id }}, {{ $credit->montant_restant }})"
                                                    class="btn-pay">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Encaisser
                                            </button>
                                        @endif
                                        <button type="button"
                                                onclick="openDeleteModal('{{ $credit->tiers_nom }}', '{{ route('credits.destroy', $credit) }}')"
                                                class="btn-del">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m2 0-.7 12.1a2 2 0 0 1-2 1.9H8.7a2 2 0 0 1-2-1.9L6 7" />
                                            </svg>
                                            Supprimer
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state rounded-3xl py-20 text-center px-6">
                    <div class="empty-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 6v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6M3 6l2-3h14l2 3M9 12h6" />
                        </svg>
                    </div>
                    <h4 class="text-[17px] font-bold tracking-tight">Aucun crédit enregistré</h4>
                    <p class="text-[13.5px] mt-2 max-w-sm mx-auto" style="color: var(--muted);">Ajoutez un crédit client ou fournisseur pour commencer le suivi.</p>
                    <a href="{{ route('credits.create') }}" class="btn-primary mt-6 px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                        </svg>
                        Nouveau crédit
                    </a>
                </div>
            @endif

        </div>
    </main>
</div>


{{-- ══════════════ MODAL : Enregistrer un paiement ══════════════ --}}
<div id="paiement-modal" class="app-modal hidden" role="dialog" aria-modal="true">
    <div class="overlay" onclick="closePaiementModal()"></div>
    <div class="panel-modal">
        <form id="paiement-form" method="POST" action="">
            @csrf

            <div class="flex items-start justify-between gap-4 px-6 pt-6 pb-5 border-b" style="border-color: var(--border);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                         style="background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%); box-shadow: 0 4px 12px -4px rgba(22,121,76,0.25), inset 0 1px 0 rgba(255,255,255,0.7);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" style="color: var(--green);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-[16.5px] font-bold tracking-tight leading-tight">Enregistrer un paiement</h3>
                        <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Saisissez le montant encaissé</p>
                    </div>
                </div>
                <button type="button" onclick="closePaiementModal()" class="icon-btn" aria-label="Fermer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-[16px] h-[16px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="px-6 py-6">
                <label class="field-label" for="paiement-montant">
                    Montant encaissé (DH) <span style="color: var(--accent);">*</span>
                </label>
                <input type="number" step="0.01" min="0.01" name="montant_paiement" id="paiement-montant" required class="field-input">

                <div class="mt-4 flex items-center justify-between px-4 py-3 rounded-xl"
                     style="background: var(--surface-soft); border: 1px solid var(--border);">
                    <span class="text-[12.5px] font-semibold" style="color: var(--muted);">Restant dû</span>
                    <span class="font-mono text-[15px] font-bold" style="color: var(--accent);">
                        <span id="paiement-restant"></span> DH
                    </span>
                </div>
            </div>

            <div class="flex items-center justify-end gap-2 px-6 py-4" style="background: #FCFCFB; border-top: 1px solid var(--border);">
                <button type="button" onclick="closePaiementModal()" class="btn-ghost px-4 py-2.5 rounded-xl font-semibold text-[13.5px]" style="color: var(--muted);">Annuler</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white transition hover:opacity-90" style="background: linear-gradient(180deg, #1FA463 0%, var(--green) 50%, #0F5D3A 100%); box-shadow: 0 1px 0 rgba(255,255,255,0.15) inset, 0 4px 14px rgba(22,121,76,0.28);">
                    Confirmer le paiement
                </button>
            </div>
        </form>
    </div>
</div>


{{-- ══════════════ MODAL : Supprimer ══════════════ --}}
<div id="delete-credit-modal" class="app-modal hidden" role="alertdialog" aria-modal="true">
    <div class="overlay" onclick="closeDeleteModal()"></div>
    <div class="panel-modal" style="max-width: 420px;">
        <form id="delete-credit-form" method="POST" action="">
            @csrf
            @method('DELETE')

            <div class="p-6 pt-7">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                     style="background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%); box-shadow: 0 4px 12px -4px rgba(214,40,40,0.25), inset 0 1px 0 rgba(255,255,255,0.7);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                    </svg>
                </div>
                <h3 class="text-[17px] font-bold tracking-tight">Supprimer ce crédit ?</h3>
                <p class="text-[13.5px] mt-2 leading-relaxed" style="color: var(--muted);">
                    Tu es sur le point de supprimer le crédit de
                    <span id="delete-credit-name" class="font-semibold" style="color: var(--text);"></span>.
                    Cette action est définitive et ne peut pas être annulée.
                </p>
            </div>

            <div class="flex items-center justify-end gap-2.5 px-6 py-5" style="background: var(--surface-soft); border-top: 1px solid var(--border);">
                <button type="button" onclick="closeDeleteModal()" class="btn-ghost px-4 py-2.5 rounded-xl font-semibold text-[13.5px]" style="color: var(--muted);">Annuler</button>
                <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">Oui, supprimer</button>
            </div>
        </form>
    </div>
</div>


<script>
    // ══════════════ Modal Paiement ══════════════
    function openPaiementModal(creditId, restant) {
        // ⚠️ Vérifie que la route "credits.paiement" existe chez toi.
        // Si elle a un autre nom (ex: credits.pay, credits.addPaiement),
        // modifie simplement la ligne ci-dessous.
        document.getElementById('paiement-form').action = `/credits/${creditId}/paiement`;

        const input = document.getElementById('paiement-montant');
        input.value = restant;
        input.max = restant;

        document.getElementById('paiement-restant').textContent =
            new Intl.NumberFormat('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(restant);

        document.getElementById('paiement-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        setTimeout(() => input.focus(), 100);
    }
    function closePaiementModal() {
        document.getElementById('paiement-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // ══════════════ Modal Supprimer ══════════════
    function openDeleteModal(name, action) {
        document.getElementById('delete-credit-form').action = action;
        document.getElementById('delete-credit-name').textContent = name || 'ce tiers';
        document.getElementById('delete-credit-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('delete-credit-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // Fermer avec Échap
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closePaiementModal();
            closeDeleteModal();
        }
    });
</script>

</body>
</html>
