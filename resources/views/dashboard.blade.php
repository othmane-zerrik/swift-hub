<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - SwiftHub</title>

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

        /* ── Sidebar ── */
        .side-label {
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #C4C4BE;
            padding: 0 20px;
            margin: 18px 0 6px;
        }

        .nav-link {
            position: relative;
            border-radius: 12px;
            color: var(--muted);
        }
        .nav-link svg { transition: transform .3s cubic-bezier(.34,1.56,.64,1); }

        /* Hover : fond rosé + icône qui rebondit */
        .nav-link:not(.active):hover {
            background: var(--hover);
            color: var(--ink);
        }
        .nav-link:not(.active):hover svg { transform: translateX(3px) scale(1.12); color: var(--accent); }

        /* Actif : pilule dégradée avec glow */
        .nav-link.active {
            background: linear-gradient(120deg, #E63946 0%, var(--accent) 55%, #B91C1C 100%);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 6px 16px -6px rgba(214,40,40,0.55), inset 0 1px 0 rgba(255,255,255,0.25);
        }
        .nav-link.active::after {
            content: '';
            position: absolute;
            right: 12px;
            top: 50%;
            width: 6px; height: 6px;
            border-radius: 50%;
            background: rgba(255,255,255,0.9);
            transform: translateY(-50%);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.25);
            animation: pulse-dot 2s ease-in-out infinite;
        }
        @keyframes pulse-dot {
            0%, 100% { box-shadow: 0 0 0 3px rgba(255,255,255,0.25); }
            50% { box-shadow: 0 0 0 5px rgba(255,255,255,0.12); }
        }

        /* Sous-menu financier */
        details .nav-link { border-radius: 12px; }
        details[open] > summary.nav-link { color: var(--accent); background: var(--accent-soft); }
        .submenu { display: grid; grid-template-rows: 0fr; transition: grid-template-rows .3s ease; }
        details[open] .submenu { grid-template-rows: 1fr; }
        .submenu > div { overflow: hidden; }
        .submenu a {
            position: relative;
            transition: color .2s ease, transform .2s ease;
        }
        .submenu a::before {
            content: '';
            position: absolute;
            left: -14px;
            top: 50%;
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--border);
            transform: translateY(-50%);
            transition: background .2s ease, transform .2s ease;
        }
        .submenu a:hover { color: var(--accent) !important; transform: translateX(4px); }
        .submenu a:hover::before { background: var(--accent); transform: translateY(-50%) scale(1.4); }

        /* Pastille logo */
        .logo-badge {
            position: relative;
            width: 8px; height: 8px;
            border-radius: 50%;
            background: var(--accent);
        }
        .logo-badge::after {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            border: 2px solid var(--accent);
            opacity: .5;
            animation: ring 2.2s ease-out infinite;
        }
        @keyframes ring {
            0% { transform: scale(.6); opacity: .6; }
            100% { transform: scale(1.6); opacity: 0; }
        }

        /* Déconnexion */
        .logout-btn { transition: all .2s ease; color: var(--muted); border: 1px solid transparent; }
        .logout-btn:hover {
            background: var(--accent-soft);
            color: var(--accent);
            border-color: #F5D5D5;
        }
        .logout-btn:hover svg { transform: translateX(2px); }
        .logout-btn svg { transition: transform .2s ease; }

        /* ── Cards ── */
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
            background: linear-gradient(90deg, #F26B6B, var(--accent) 60%, #B91C1C);
            opacity: 0;
            transition: opacity .25s ease;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            border-color: #E2C7C7;
            box-shadow: var(--shadow-md), var(--shadow-accent);
        }
        .stat-card:hover::before { opacity: 1; }

        .stat-icon {
            width: 46px; height: 46px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 14px;
            box-shadow: 0 4px 12px -4px rgba(214,40,40,0.4);
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .stat-card:hover .stat-icon { transform: rotate(-8deg) scale(1.1); }
        .stat-icon svg { width: 21px; height: 21px; stroke-width: 1.8; }

        /* ── Panels ── */
        .panel {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow .25s ease;
        }
        .panel:hover { box-shadow: var(--shadow-md); }

        /* ── Actions rapides ── */
        .action-row {
            transition: background .2s ease, transform .2s ease;
            border: 1px solid transparent;
        }
        .action-row:hover {
            background: var(--accent-soft);
            border-color: #F5D5D5;
        }
        .action-row:hover .action-icon {
            background: var(--accent);
            color: #fff;
            border-color: var(--accent);
            transform: scale(1.08) rotate(90deg);
            box-shadow: 0 4px 12px -4px var(--accent-glow);
        }
        .action-row:hover .action-title { color: var(--accent); }
        .action-row:hover .action-desc { color: #C25A5A; }
        .action-icon {
            transition: all .3s cubic-bezier(.34,1.56,.64,1);
        }
        .action-title { transition: color .2s ease; }
        .action-desc { transition: color .2s ease; }

        /* ── Activity timeline ── */
        .activity-item { transition: transform .2s ease; }
        .activity-item:hover { transform: translateX(4px); }

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

                <a href="{{ route('dashboard') }}" class="nav-link active flex items-center gap-3 px-4 py-3 text-[15px] font-medium transition" aria-current="page">
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

        {{-- Logout --}}
        <div class="p-4 border-t" style="border-color: var(--border);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="logout-btn w-full flex items-center gap-3 px-4 py-2.5 text-sm rounded-xl">
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
        <header class="border-b px-8 py-5 grid grid-cols-3 items-center sticky top-0 backdrop-blur-md" style="border-color: var(--border); background: rgba(247,247,245,0.85); z-index: 5;">

            <div>
                <h2 class="text-2xl font-extrabold tracking-tight">Dashboard</h2>
                <p class="text-[15px] mt-1" style="color: var(--muted);">Vue générale de votre activité</p>
            </div>

            <div class="flex justify-center">
                <span class="px-4 py-2 rounded-full text-sm font-semibold" style="background: var(--accent-soft); color: var(--accent); box-shadow: 0 2px 8px -2px var(--accent-glow);">
                    {{ ucfirst(\Carbon\Carbon::now()->locale('fr')->translatedFormat('l j F')) }}
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


        {{-- DASHBOARD --}}
        <div class="p-8">

            


            {{-- STATISTIQUES --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                {{-- Clients --}}
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-[15px] font-semibold" style="color: var(--muted);">Clients</p>
                        <div class="stat-icon" style="background: linear-gradient(135deg, #F26B6B, #E63946); color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                            </svg>
                        </div>
                    </div>
                    <p class="font-mono text-4xl font-bold mt-4" style="color: var(--ink);">{{ $clientsCount ?? 0 }}</p>
                    <p class="text-sm mt-3" style="color: var(--muted);">
                        @if(($clientsCount ?? 0) > 0)
                            {{ $clientsCount }} client{{ $clientsCount > 1 ? 's' : '' }} enregistré{{ $clientsCount > 1 ? 's' : '' }}
                        @else
                            Aucun client pour le moment
                        @endif
                    </p>
                </div>

                {{-- Produits --}}
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-[15px] font-semibold" style="color: var(--muted);">Produits</p>
                        <div class="stat-icon" style="background: linear-gradient(135deg, #E85D5D, #C1272D); color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" />
                            </svg>
                        </div>
                    </div>
                    <p class="font-mono text-4xl font-bold mt-4" style="color: var(--ink);">
                        {{ $productsCount ?? 0 }}
                    </p>
                    <p class="text-sm mt-3" style="color: var(--muted);">
                        @if(($productsCount ?? 0) > 0)
                            {{ $productsCount }} produit{{ $productsCount > 1 ? 's' : '' }} enregistré{{ $productsCount > 1 ? 's' : '' }}
                        @else
                            Aucun produit pour le moment
                        @endif
                    </p>
                </div>

                {{-- Devis --}}
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-[15px] font-semibold" style="color: var(--muted);">Devis</p>
                        <div class="stat-icon" style="background: linear-gradient(135deg, #EF4444, #D62828); color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.5A1.5 1.5 0 0 1 10.5 2h3A1.5 1.5 0 0 1 15 3.5V5a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1V3.5Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h4" />
                            </svg>
                        </div>
                    </div>
                    <p class="font-mono text-4xl font-bold mt-4" style="color: var(--ink);">{{ $devisCount ?? 0 }}</p>
                    <p class="text-sm mt-3" style="color: var(--muted);">
                        @if(($devisCount ?? 0) > 0)
                            {{ $devisCount }} devis créé{{ $devisCount > 1 ? 's' : '' }}
                        @else
                            Aucun devis créé
                        @endif
                    </p>
                </div>

                {{-- Factures --}}
                <div class="stat-card p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-[15px] font-semibold" style="color: var(--muted);">Factures</p>
                        <div class="stat-icon" style="background: linear-gradient(135deg, #B91C1C, #7F1D1D); color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5M9 13h6M9 16.5h6" />
                            </svg>
                        </div>
                    </div>
                    <p class="font-mono text-4xl font-bold mt-4" style="color: var(--ink);">{{ $facturesCount ?? 0 }}</p>
                    <p class="text-sm mt-3" style="color: var(--muted);">
                        @if(($facturesCount ?? 0) > 0)
                            {{ $facturesCount }} facture{{ $facturesCount > 1 ? 's' : '' }} créée{{ $facturesCount > 1 ? 's' : '' }}
                        @else
                            Aucune facture créée
                        @endif
                    </p>
                </div>

            </div>

            {{-- PARTIE BASSE --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

                {{-- Activité récente --}}
                <div class="panel overflow-hidden">

                    <div class="p-6 border-b flex items-center justify-between" style="border-color: var(--border);">
                        <h3 class="text-lg font-bold">Activité récente</h3>
                        <span class="text-xs font-semibold px-3 py-1 rounded-full" style="background: var(--accent-soft); color: var(--accent);">
                            En direct
                        </span>
                    </div>

                    <div class="p-6">

                        @if($activities->count() > 0)

                            <div class="space-y-1 relative">
                                <div class="absolute left-[17px] top-4 bottom-4 w-px" style="background: linear-gradient(to bottom, var(--border), transparent);"></div>
                                @foreach($activities as $activity)
                                    <div class="activity-item relative flex items-start gap-3 p-2 rounded-xl hover:bg-[var(--hover)] transition-colors">
                                        <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0 relative z-10" style="background: var(--accent-soft); border: 1px solid #F5D5D5;">
                                            @switch($activity->type)
                                                @case('client')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Z" />
                                                    </svg>
                                                    @break
                                                @case('produit')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8" />
                                                    </svg>
                                                    @break
                                                @case('devis')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                                                    </svg>
                                                    @break
                                                @case('facture')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" />
                                                    </svg>
                                                    @break
                                                @default
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <circle cx="12" cy="12" r="3" />
                                                    </svg>
                                            @endswitch
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium">{{ $activity->description }}</p>
                                            <p class="text-xs mt-0.5" style="color: var(--muted);">{{ $activity->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        @else

                            <div class="text-center py-10">
                                <div class="w-12 h-12 rounded-full mx-auto mb-4 flex items-center justify-center" style="background: var(--accent-soft); box-shadow: 0 0 0 8px rgba(214,40,40,0.05);">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color: var(--accent); width: 22px; height: 22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 17v-1a4 4 0 0 1 4-4h1M8 12V8a2 2 0 0 1 2-2h1M14 6h1a2 2 0 0 1 2 2v1M20 12v1a4 4 0 0 1-4 4h-1M13 21l-3-3 3-3" />
                                    </svg>
                                </div>
                                <h4 class="font-medium">Aucune activité pour l'instant</h4>
                                <p class="text-sm mt-1" style="color: var(--muted);">Vos dernières actions apparaîtront ici au fil de l'eau.</p>
                            </div>

                        @endif

                    </div>

                </div>

                {{-- Actions rapides --}}
                <div class="panel overflow-hidden">

                    <div class="p-6 border-b" style="border-color: var(--border);">
                        <h3 class="text-lg font-bold">Actions rapides</h3>
                    </div>

                    <div class="p-2">

                        <a href="{{ route('clients.index') }}?new=1" class="action-row flex items-center gap-3 p-4 rounded-xl transition m-1">
                            <div class="action-icon w-9 h-9 rounded-md flex items-center justify-center flex-shrink-0" style="border: 1px solid var(--border); color: var(--accent);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <div class="action-title font-semibold text-[15px]">Ajouter un client</div>
                                <p class="action-desc text-xs mt-0.5" style="color: var(--muted);">Créer une nouvelle fiche client</p>
                            </div>
                        </a>

                        <a href="{{ route('products.index') }}?new=1" class="action-row flex items-center gap-3 p-4 rounded-xl transition m-1">
                            <div class="action-icon w-9 h-9 rounded-md flex items-center justify-center flex-shrink-0" style="border: 1px solid var(--border); color: var(--accent);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <div class="action-title font-semibold text-[15px]">Ajouter un produit</div>
                                <p class="action-desc text-xs mt-0.5" style="color: var(--muted);">Référencer un article en stock</p>
                            </div>
                        </a>

                        <a href="{{ route('devis.create') }}" class="action-row flex items-center gap-3 p-4 rounded-xl transition m-1">
                            <div class="action-icon w-9 h-9 rounded-md flex items-center justify-center flex-shrink-0" style="border: 1px solid var(--border); color: var(--accent);">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 16px; height: 16px;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <div class="action-title font-semibold text-[15px]">Nouveau devis</div>
                                <p class="action-desc text-xs mt-0.5" style="color: var(--muted);">Préparer une proposition commerciale</p>
                            </div>
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>