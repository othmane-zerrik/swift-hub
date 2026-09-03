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
            --bg: #FFFFFF;
            --surface: #FFFFFF;
            --border: #E6E6E3;
            --hover: #FBF1F1;
            --text: #171717;
            --muted: #8B8B86;
            --accent: #D62828;
            --accent-soft: #FCE8E8;
            --font-body: 'Plus Jakarta Sans', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }
        body { font-family: var(--font-body); background: var(--bg); color: var(--text); }
        .font-mono { font-family: var(--font-mono); }
        h1, h2, h3, h4 { font-family: var(--font-body); letter-spacing: -0.02em; }
        .icon { width: 18px; height: 18px; stroke-width: 1.6; flex-shrink: 0; }

        .nav-link { border-left: 2px solid transparent; }
        .nav-link.active {
            border-left-color: var(--accent);
            background: var(--hover);
            color: var(--accent);
            font-weight: 500;
        }
        .nav-link:not(.active):hover { background: var(--hover); color: var(--ink); }

        .action-row + .action-row { border-top: 1px solid var(--border); }

        .stat-card { transition: border-color .2s ease, box-shadow .2s ease; }
        .stat-card:hover { border-color: #D9D9D5; box-shadow: 0 4px 16px rgba(0,0,0,0.06); }
        .stat-icon {
            width: 44px; height: 44px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 12px;
            transition: transform .45s cubic-bezier(.34,1.56,.64,1);
        }
        .stat-card:hover .stat-icon { transform: rotate(18deg) scale(1.08); }
        .stat-icon svg { width: 20px; height: 20px; stroke-width: 1.8; }

        summary::-webkit-details-marker { display: none; }
        summary { list-style: none; }
    </style>
</head>

<body class="text-[16px]">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 flex flex-col" style="background: var(--surface); border-right: 1px solid var(--border);">

        {{-- Logo --}}
        <div class="h-20 flex items-center px-7 border-b" style="border-color: var(--border);">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight" style="color: var(--accent);">SwiftHub</h1>
                <p class="text-[13px] font-medium mt-1" style="color: var(--muted);">Gestion commerciale</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-5 space-y-0.5">

            <a href="{{ route('dashboard') }}"
               class="nav-link active flex items-center gap-3 pl-4 pr-4 py-2.5 rounded-r-md text-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5 9.5V21h14V9.5" />
                </svg>
                <span>Dashboard</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5M4 19h16M8 19v-6M13 19v-9M18 19v-4" />
                </svg>
                <span>Analytique</span>
            </a>

            <a href="{{ route("clients.index") }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                </svg>
                <span>Clients</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" />
                </svg>
                <span>Produits</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V6a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v13M4 19h16M4 19l2-3M20 19l-2-3M8 14V9M12 14v-7M16 14v-4" />
                </svg>
                <span>Stock</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.5A1.5 1.5 0 0 1 10.5 2h3A1.5 1.5 0 0 1 15 3.5V5a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1V3.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h4" />
                </svg>
                <span>Devis</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5M9 13h6M9 16.5h6" />
                </svg>
                <span>Factures</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 5 18.5V20M10 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19 20v-1.2a3 3 0 0 0-2-2.83M15.5 4.2a3 3 0 0 1 0 5.6" />
                </svg>
                <span>Employés</span>
            </a>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a1 1 0 0 1 1 1v16l-6-3-6 3V4a1 1 0 0 1 1-1ZM9 8h6M9 11.5h6" />
                </svg>
                <span>Rapports</span>
            </a>

            {{-- Gestion financière (sous-menu) --}}
            <details class="group">
                <summary class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition cursor-pointer list-none" style="color: var(--muted);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18M3 6v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1V6M3 6l2-3h14l2 3M9 12h6" />
                    </svg>
                    <span class="flex-1">Gestion financière</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0 transition-transform group-open:rotate-90" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.6" d="m9 6 6 6-6 6" />
                    </svg>
                </summary>

                <div class="pl-11 pr-4 pb-1 space-y-0.5">
                    <a href="#" class="block py-2 text-sm hover:text-[var(--ink)] transition" style="color: var(--muted);">Chiffre d'affaires</a>
                    <a href="#" class="block py-2 text-sm hover:text-[var(--ink)] transition" style="color: var(--muted);">Crédits</a>
                    <a href="#" class="block py-2 text-sm hover:text-[var(--ink)] transition" style="color: var(--muted);">Chèques clients</a>
                    <a href="#" class="block py-2 text-sm hover:text-[var(--ink)] transition" style="color: var(--muted);">Chèques entreprise</a>
                </div>
            </details>

            <a href="#" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H4a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V4a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
                </svg>
                <span>Paramètres</span>
            </a>

        </nav>

        {{-- Logout --}}
        <div class="p-4 border-t" style="border-color: var(--border);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 pl-4 pr-4 py-2.5 text-sm transition rounded-md hover:bg-[var(--hover)]" style="color: var(--muted);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8V6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-2M14 12H3m0 0 3.5-3.5M3 12l3.5 3.5" />
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>

    </aside>


    {{-- CONTENU PRINCIPAL --}}
    <main class="flex-1">

        {{-- HEADER --}}
        <header class="border-b px-8 py-5 grid grid-cols-3 items-center" style="border-color: var(--border);">

            <div>
                <h2 class="text-2xl font-extrabold tracking-tight">Dashboard</h2>
                <p class="text-[15px] mt-1" style="color: var(--muted);">Vue générale de votre activité</p>
            </div>

            <div class="flex justify-center">
                <span class="px-4 py-2 rounded-full text-sm font-semibold" style="background: var(--accent-soft); color: var(--accent);">
                    {{ ucfirst(\Carbon\Carbon::now()->locale('fr')->translatedFormat('l j F')) }}
                </span>
            </div>

            <div class="flex items-center gap-3 justify-self-end">
                <div class="text-right">
                    <p class="font-semibold text-[15px]">{{ auth()->user()->name }}</p>
                    <p class="text-xs" style="color: var(--muted);">Compte utilisateur</p>
                </div>

                <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-white text-sm"
                     style="background: var(--accent);">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>

        </header>


        {{-- DASHBOARD --}}
        <div class="p-8">

            {{-- BIENVENUE --}}
            <div class="mb-8">
                <h3 class="text-4xl font-extrabold tracking-tight">Bonjour, {{ explode(' ', auth()->user()->name)[0] }}</h3>
                <p class="mt-2 text-[15px]" style="color: var(--muted);">Voici un aperçu de votre activité aujourd'hui.</p>
            </div>


            {{-- STATISTIQUES --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

                {{-- Clients --}}
                <div class="stat-card rounded-xl p-6" style="border: 1px solid var(--border);">
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
                <div class="stat-card rounded-xl p-6" style="border: 1px solid var(--border);">
                    <div class="flex items-center justify-between">
                        <p class="text-[15px] font-semibold" style="color: var(--muted);">Produits</p>
                        <div class="stat-icon" style="background: linear-gradient(135deg, #E85D5D, #C1272D); color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" />
                            </svg>
                        </div>
                    </div>
                    <p class="font-mono text-4xl font-bold mt-4" style="color: var(--ink);">0</p>
                    <p class="text-sm mt-3" style="color: var(--muted);">Aucun produit pour le moment</p>
                </div>

                {{-- Devis --}}
                <div class="stat-card rounded-xl p-6" style="border: 1px solid var(--border);">
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
                    <p class="font-mono text-4xl font-bold mt-4" style="color: var(--ink);">0</p>
                    <p class="text-sm mt-3" style="color: var(--muted);">Aucun devis créé</p>
                </div>

                {{-- Factures --}}
                <div class="stat-card rounded-xl p-6" style="border: 1px solid var(--border);">
                    <div class="flex items-center justify-between">
                        <p class="text-[15px] font-semibold" style="color: var(--muted);">Factures</p>
                        <div class="stat-icon" style="background: linear-gradient(135deg, #B91C1C, #7F1D1D); color: #fff;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5M9 13h6M9 16.5h6" />
                            </svg>
                        </div>
                    </div>
                    <p class="font-mono text-4xl font-bold mt-4" style="color: var(--ink);">0</p>
                    <p class="text-sm mt-3" style="color: var(--muted);">Aucune facture créée</p>
                </div>

            </div>


            {{-- PARTIE BASSE --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-6">

                {{-- Activité --}}
                <div class="lg:col-span-2 rounded-xl" style="border: 1px solid var(--border);">

                    <div class="p-6 border-b" style="border-color: var(--border);">
                        <h3 class="text-lg font-bold">Activité récente</h3>
                    </div>

                    <div class="p-6">
                        <div class="text-center py-10">
                            <div class="w-12 h-12 rounded-full mx-auto mb-4 flex items-center justify-center" style="border: 1px solid var(--border);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="color: var(--ink); width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 17v-1a4 4 0 0 1 4-4h1M8 12V8a2 2 0 0 1 2-2h1M14 6h1a2 2 0 0 1 2 2v1M20 12v1a4 4 0 0 1-4 4h-1M13 21l-3-3 3-3" />
                                </svg>
                            </div>
                            <h4 class="font-medium">Aucune activité pour l'instant</h4>
                            <p class="text-sm mt-1" style="color: var(--muted);">Vos dernières actions apparaîtront ici au fil de l'eau.</p>
                        </div>
                    </div>

                </div>


                {{-- Actions rapides --}}
                <div class="rounded-xl" style="border: 1px solid var(--border);">

                    <div class="p-6 border-b" style="border-color: var(--border);">
                        <h3 class="text-lg font-bold">Actions rapides</h3>
                    </div>

                    <div>

                        <a href="{{ route('clients.index') }}?new=1"class="action-row flex items-center gap-3 p-4 hover:bg-[var(--hover)] transition">
                            <div class="w-9 h-9 rounded-md flex items-center justify-center flex-shrink-0" style="border: 1px solid var(--border);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="color: var(--accent); width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-[15px]">Ajouter un client</div>
                                <p class="text-xs mt-0.5" style="color: var(--muted);">Créer une nouvelle fiche client</p>
                            </div>
                        </a>

                        <a href="#" class="action-row flex items-center gap-3 p-4 hover:bg-[var(--hover)] transition">
                            <div class="w-9 h-9 rounded-md flex items-center justify-center flex-shrink-0" style="border: 1px solid var(--border);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="color: var(--accent); width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-[15px]">Ajouter un produit</div>
                                <p class="text-xs mt-0.5" style="color: var(--muted);">Référencer un article en stock</p>
                            </div>
                        </a>

                        <a href="#" class="action-row flex items-center gap-3 p-4 hover:bg-[var(--hover)] transition">
                            <div class="w-9 h-9 rounded-md flex items-center justify-center flex-shrink-0" style="border: 1px solid var(--border);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="color: var(--accent); width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-[15px]">Nouveau devis</div>
                                <p class="text-xs mt-0.5" style="color: var(--muted);">Préparer une proposition commerciale</p>
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