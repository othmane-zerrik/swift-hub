
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mon compte - SwiftHub</title>

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

        /* ══════════════ BOUTONS & CHAMPS ══════════════ */
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

        /* ══════════════ SECTIONS (PANELS) ══════════════ */
        .settings-panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow .25s ease;
            overflow: hidden;
        }
        .settings-panel:hover { box-shadow: var(--shadow-md); }

        .settings-panel-header {
            padding: 20px 24px 16px;
            border-bottom: 1px solid var(--border);
            background: var(--surface-soft);
        }

        .settings-panel-icon {
            width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 12px;
            flex-shrink: 0;
            background: linear-gradient(135deg, #FCE8E8 0%, #F8D3D3 100%);
            color: var(--accent); flex-shrink: 0;
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.25), inset 0 1px 0 rgba(255,255,255,0.7);
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .settings-panel:hover .settings-panel-icon { transform: rotate(-8deg) scale(1.06); }

        .settings-panel-body { padding: 24px; }

        /* ══════════════ PROFIL (BANDEAU) ══════════════ */
        .profile-banner {
            position: relative;
            border-radius: var(--radius);
            padding: 28px;
            overflow: hidden;
            background:
                radial-gradient(120% 200% at 100% 0%, rgba(214,40,40,0.10) 0%, transparent 55%),
                radial-gradient(80% 200% at 0% 100%, rgba(214,40,40,0.06) 0%, transparent 55%),
                linear-gradient(135deg, #FFFFFF 0%, #FDFAF9 100%);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            margin-bottom: 24px;
        }
        .profile-banner::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; height: 3px;
            background: linear-gradient(90deg, #F26B6B, var(--accent) 60%, #B91C1C);
        }

        .profile-avatar {
            width: 76px; height: 76px; border-radius: 22px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 30px; color: #fff;
            flex-shrink: 0;
            background: linear-gradient(135deg, #F26B6B 0%, var(--accent) 60%, #A81F1F 100%);
            box-shadow: 0 12px 28px -8px rgba(214,40,40,0.5), inset 0 1px 0 rgba(255,255,255,0.25);
            letter-spacing: -0.03em;
            position: relative;
        }
        .profile-avatar::after {
            content: '';
            position: absolute; inset: 0; border-radius: inherit;
            background: linear-gradient(180deg, rgba(255,255,255,0.18) 0%, transparent 50%);
            pointer-events: none;
        }
        .profile-avatar-badge {
            position: absolute;
            right: -4px; bottom: -4px;
            width: 22px; height: 22px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            background: var(--green);
            border: 3px solid var(--surface);
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .profile-avatar-badge svg { width: 11px; height: 11px; color: #fff; }

        .verified-pill {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 9px; border-radius: 999px;
            font-size: 11px; font-weight: 700;
            background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
            color: #065F46; border: 1px solid #A7F3D0;
            letter-spacing: -0.005em;
        }
        .verified-pill::before {
            content: ''; width: 5px; height: 5px; border-radius: 50%;
            background: #10B981;
            box-shadow: 0 0 0 2px rgba(16,185,129,0.2);
        }

        /* ══════════════ FLASH ══════════════ */
        .flash {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 13px 16px; border-radius: var(--radius);
            font-size: 14px; font-weight: 550;
            animation: flashIn .3s ease;
        }
        .flash-success { background: var(--green-soft); color: var(--green); border: 1px solid #CFEBDD; }
        .flash-error   { background: var(--accent-soft); color: var(--accent); border: 1px solid #F5D5D5; }
        @keyframes flashIn {
            from { opacity: 0; transform: translateY(-6px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .field-error {
            display: flex; align-items: center; gap: 5px;
            font-size: 12px; font-weight: 600;
            color: var(--accent);
            margin-top: 6px;
        }
        .field-error svg { flex-shrink: 0; }

        .field-input.is-invalid {
            border-color: #F5B5B5;
            box-shadow: 0 0 0 3px rgba(214,40,40,0.08);
        }

        /* ══════════════ PASSWORD METER ══════════════ */
        .password-toggle {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            width: 30px; height: 30px; border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            color: var(--muted); transition: all .18s ease;
        }
        .password-toggle:hover { background: var(--hover); color: var(--accent); }

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

                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
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
                <a href="#" class="nav-link flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a1 1 0 0 1 1 1v16l-6-3-6 3V4a1 1 0 0 1 1-1ZM9 8h6M9 11.5h6" />
                    </svg>
                    <span>Rapports</span>
                </a>

                <a href="{{ route('settings.edit') }}" class="nav-link active flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H4a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V4a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
                    </svg>
                    <span>Paramètres</span>
                </a>
            </div>

        </nav>

        {{-- Logout --}}
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
                <h2 class="text-2xl font-extrabold tracking-tight leading-tight">Mon compte</h2>
                <p class="text-[14.5px] mt-1" style="color: var(--muted);">Gère les informations de ton compte et ta sécurité.</p>
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
        <div class="p-8 max-w-3xl mx-auto">

            {{-- Bandeau profil --}}
            <div class="profile-banner">
                <div class="flex items-center gap-5">
                    <div class="profile-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        <div class="profile-avatar-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-[22px] font-extrabold tracking-tight truncate leading-tight">{{ auth()->user()->name }}</h3>
                        <p class="text-[13.5px] mt-1 truncate" style="color: var(--muted);">{{ auth()->user()->email }}</p>
                        <div class="mt-2.5">
                            <span class="verified-pill">Compte vérifié</span>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="flash flash-success mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 6 9 17l-5-5" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Informations du compte --}}
            <div class="settings-panel mb-6">
                <div class="settings-panel-header">
                    <div class="flex items-center gap-3">
                        <div class="settings-panel-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Informations du compte</h3>
                            <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Ton nom et ton email de connexion.</p>
                        </div>
                    </div>
                </div>

                <div class="settings-panel-body">
                    <form method="POST" action="{{ route('settings.update') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="field-label" for="name">Nom complet</label>
                            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" required
                                   class="field-input @error('name') is-invalid @enderror">
                            @error('name')
                                <p class="field-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="field-label" for="email">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" required
                                   class="field-input @error('email') is-invalid @enderror">
                            @error('email')
                                <p class="field-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Changer le mot de passe --}}
            <div class="settings-panel">
                <div class="settings-panel-header">
                    <div class="flex items-center gap-3">
                        <div class="settings-panel-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-[18px] h-[18px]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 0 0-8 0v4M5 11h14a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2Z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-[15.5px] font-bold tracking-tight leading-tight">Changer le mot de passe</h3>
                            <p class="text-[12.5px] mt-0.5" style="color: var(--muted);">Choisis un mot de passe d'au moins 8 caractères.</p>
                        </div>
                    </div>
                </div>

                <div class="settings-panel-body">
                    <form method="POST" action="{{ route('settings.password') }}" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="field-label" for="current_password">Mot de passe actuel</label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current_password" required
                                       class="field-input @error('current_password') is-invalid @enderror" style="padding-right: 44px;">
                                <button type="button" class="password-toggle" onclick="togglePassword('current_password', this)" aria-label="Afficher le mot de passe">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="field-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="field-label" for="password">Nouveau mot de passe</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required
                                       class="field-input @error('password') is-invalid @enderror" style="padding-right: 44px;">
                                <button type="button" class="password-toggle" onclick="togglePassword('password', this)" aria-label="Afficher le mot de passe">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="field-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="field-label" for="password_confirmation">Confirmer le nouveau mot de passe</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation" required
                                       class="field-input" style="padding-right: 44px;">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', this)" aria-label="Afficher le mot de passe">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex justify-end pt-2">
                            <button type="submit" class="btn-primary px-5 py-2.5 rounded-xl font-semibold text-[13.5px] text-white">
                                Changer le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </main>

</div>


<script>
    // Afficher / masquer un mot de passe
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        if (!input) return;
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';

        // Change l'icône (œil ouvert / œil barré)
        btn.innerHTML = isHidden
            ? `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
              </svg>`
            : `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
              </svg>`;
    }
</script>

</body>
</html>
