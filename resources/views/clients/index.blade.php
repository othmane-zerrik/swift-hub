<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Clients - SwiftHub</title>

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

        .client-card { transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease; }
        .client-card:hover { border-color: #D9D9D5; box-shadow: 0 8px 20px rgba(0,0,0,0.07); transform: translateY(-2px); }

        .client-actions { opacity: 0; transition: opacity .15s ease; }
        .client-card:hover .client-actions { opacity: 1; }

        .avatar-badge {
            width: 46px; height: 46px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; flex-shrink: 0;
            background: linear-gradient(135deg, #F26B6B, #D62828);
        }

        summary::-webkit-details-marker { display: none; }
        summary { list-style: none; }

        /* Modal */
        .app-modal.hidden { display: none; }
        .app-modal { position: fixed; inset: 0; z-index: 50; }
        .app-modal .overlay { position: absolute; inset: 0; background: rgba(10,10,10,0.45); }
        .app-modal .panel {
            position: relative; z-index: 1;
            max-width: 480px; width: 92%;
            margin: 6vh auto 0;
            background: #fff; border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        .field-label { font-size: 13px; font-weight: 600; color: var(--text); margin-bottom: 6px; display: block; }
        .field-input {
            width: 100%; border: 1px solid var(--border); border-radius: 10px;
            padding: 10px 14px; font-size: 15px; font-family: var(--font-body);
            transition: border-color .15s ease;
        }
        .field-input:focus { outline: none; border-color: var(--accent); }
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
               class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
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

            <a href="#" class="nav-link active flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition">
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
        <header class="border-b px-8 py-5 flex items-center justify-between" style="border-color: var(--border);">

            <div>
                <h2 class="text-2xl font-extrabold tracking-tight">Clients</h2>
                <p class="text-[15px] mt-1" style="color: var(--muted);">
                    {{ isset($clients) ? $clients->count() : 0 }} client(s) enregistré(s)
                </p>
            </div>

            <div class="flex items-center gap-3">
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


        {{-- CONTENU --}}
        <div class="p-8">

            {{-- Barre d'action : recherche + ajout --}}
            <div class="flex items-center justify-between gap-4 mb-8">

               <form method="GET" action="{{ route('clients.index') }}" class="relative flex-1 max-w-sm">
    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M18 11a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
    </svg>
<input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Rechercher un client..."
       class="field-input" style="background: var(--surface); padding-left: 44px;">
    @if(!empty($search))
        <a href="{{ route('clients.index') }}" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-semibold" style="color: var(--accent);">
            Effacer
        </a>
    @endif
</form>

                <button onclick="openClientModal()"
                        class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90"
                        style="background: var(--accent);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14M5 12h14" />
                    </svg>
                    Ajouter un client
                </button>

            </div>

            {{-- Grille de clients --}}
            @if(isset($clients) && count($clients) > 0)

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5" id="clients-grid">
                    @foreach($clients as $client)
                        <div class="client-card rounded-2xl p-6" style="border: 1px solid var(--border);" data-name="{{ strtolower($client->name) }} {{ strtolower($client->email) }}">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="avatar-badge">{{ strtoupper(substr($client->name, 0, 1)) }}</div>
                                    <div>
                                        <p class="font-semibold text-[15px]">{{ $client->name }}</p>
                                        <p class="text-xs mt-0.5" style="color: var(--muted);">Client depuis {{ $client->created_at->format('M Y') }}</p>
                                    </div>
                                </div>

                                <div class="client-actions flex items-center gap-1">
                                    <button type="button" onclick="openEditModal(this)"
                                            data-id="{{ $client->id }}"
                                            data-name="{{ $client->name }}"
                                            data-email="{{ $client->email }}"
                                            data-phone="{{ $client->phone }}"
                                            data-city="{{ $client->city }}"
                                            data-notes="{{ $client->notes }}"
                                            data-action="{{ route('clients.update', $client) }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[var(--hover)]" title="Modifier">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5M18.5 2.5a2.12 2.12 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5Z" />
                                        </svg>
                                    </button>
                                    <button type="button" onclick="openDeleteModal(this)"
                                            data-name="{{ $client->name }}"
                                            data-action="{{ route('clients.destroy', $client) }}"
                                            class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[var(--hover)]" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M9 7V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v2m2 0-.7 12.1a2 2 0 0 1-2 1.9H8.7a2 2 0 0 1-2-1.9L6 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 space-y-2 text-sm" style="border-top: 1px solid var(--border); color: var(--text);">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Zm0 0 9 6 9-6" />
                                    </svg>
                                    <span>{{ $client->email }}</span>
                                </div>
                                @if($client->phone)
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 0 1 2-2h2.28a1 1 0 0 1 .97.76l1.1 4.4a1 1 0 0 1-.5 1.13l-1.7.85a12 12 0 0 0 6.71 6.71l.85-1.7a1 1 0 0 1 1.13-.5l4.4 1.1a1 1 0 0 1 .76.97V19a2 2 0 0 1-2 2h-1C8.82 21 3 15.18 3 8V5Z" />
                                    </svg>
                                    <span>{{ $client->phone }}</span>
                                </div>
                                @endif
                                @if($client->city)
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s-7-6.1-7-11a7 7 0 1 1 14 0c0 4.9-7 11-7 11Z M12 13a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                    </svg>
                                    <span>{{ $client->city }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

            @else

                {{-- Etat vide --}}
                <div class="rounded-2xl py-16 text-center" style="border: 1px dashed var(--border);">
                    <div class="w-14 h-14 rounded-full mx-auto mb-4 flex items-center justify-center" style="background: var(--accent-soft);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" />
                        </svg>
                    </div>
                    <h4 class="text-lg font-bold">Aucun client pour le moment</h4>
                    <p class="text-sm mt-1" style="color: var(--muted);">Ajoutez votre premier client pour commencer à suivre votre activité.</p>
                    <button onclick="openClientModal()" class="mt-5 px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                        + Ajouter un client
                    </button>
                </div>

            @endif

        </div>

    </main>

</div>


{{-- MODAL : Ajouter un client --}}
<div id="client-modal" class="app-modal hidden">
    <div class="overlay" onclick="closeClientModal()"></div>

    <div class="panel">
        <form method="POST" action="{{ route('clients.store') }}">
            @csrf

            <div class="flex items-center justify-between p-6 border-b" style="border-color: var(--border);">
                <h3 class="text-lg font-bold">Nouveau client</h3>
                <button type="button" onclick="closeClientModal()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[var(--hover)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="field-label">Nom complet</label>
                    <input type="text" name="name" required class="field-input" placeholder="Ex: Karim El Amrani">
                </div>
                <div>
                    <label class="field-label">Email</label>
                    <input type="email" name="email" required class="field-input" placeholder="karim@exemple.com">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label">Téléphone</label>
                        <input type="text" name="phone" class="field-input" placeholder="06 12 34 56 78">
                    </div>
                    <div>
                        <label class="field-label">Ville</label>
                        <input type="text" name="city" class="field-input" placeholder="Fès">
                    </div>
                </div>
                <div>
                    <label class="field-label">Notes (optionnel)</label>
                    <textarea name="notes" rows="3" class="field-input" placeholder="Informations complémentaires..."></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 p-6 pt-0">
                <button type="button" onclick="closeClientModal()" class="px-5 py-2.5 rounded-xl font-semibold text-sm transition hover:bg-[var(--hover)]" style="color: var(--muted);">
                    Annuler
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                    Enregistrer le client
                </button>
            </div>
        </form>
    </div>
</div>


{{-- MODAL : Modifier un client --}}
<div id="edit-client-modal" class="app-modal hidden">
    <div class="overlay" onclick="closeEditModal()"></div>

    <div class="panel">
        <form id="edit-client-form" method="POST" action="">
            @csrf
            @method('PUT')

            <div class="flex items-center justify-between p-6 border-b" style="border-color: var(--border);">
                <h3 class="text-lg font-bold">Modifier le client</h3>
                <button type="button" onclick="closeEditModal()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[var(--hover)]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color: var(--muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <div>
                    <label class="field-label">Nom complet</label>
                    <input type="text" name="name" id="edit-name" required class="field-input">
                </div>
                <div>
                    <label class="field-label">Email</label>
                    <input type="email" name="email" id="edit-email" required class="field-input">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="field-label">Téléphone</label>
                        <input type="text" name="phone" id="edit-phone" class="field-input">
                    </div>
                    <div>
                        <label class="field-label">Ville</label>
                        <input type="text" name="city" id="edit-city" class="field-input">
                    </div>
                </div>
                <div>
                    <label class="field-label">Notes (optionnel)</label>
                    <textarea name="notes" id="edit-notes" rows="3" class="field-input"></textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 p-6 pt-0">
                <button type="button" onclick="closeEditModal()" class="px-5 py-2.5 rounded-xl font-semibold text-sm transition hover:bg-[var(--hover)]" style="color: var(--muted);">
                    Annuler
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>


{{-- MODAL : Confirmer la suppression --}}
<div id="delete-client-modal" class="app-modal hidden">
    <div class="overlay" onclick="closeDeleteModal()"></div>

    <div class="panel" style="max-width: 400px;">
        <form id="delete-client-form" method="POST" action="">
            @csrf
            @method('DELETE')

            <div class="p-6">
                <div class="w-12 h-12 rounded-full flex items-center justify-center mb-4" style="background: var(--accent-soft);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" style="color: var(--accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v4m0 4h.01M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold">Supprimer ce client ?</h3>
                <p class="text-sm mt-2" style="color: var(--muted);">
                    Tu es sur le point de supprimer <span id="delete-client-name" class="font-semibold" style="color: var(--text);"></span>.
                    Cette action est définitive et ne peut pas être annulée.
                </p>
            </div>

            <div class="flex items-center justify-end gap-3 p-6 pt-0">
                <button type="button" onclick="closeDeleteModal()" class="px-5 py-2.5 rounded-xl font-semibold text-sm transition hover:bg-[var(--hover)]" style="color: var(--muted);">
                    Annuler
                </button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
                    Oui, supprimer
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    function openClientModal() {
        document.getElementById('client-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeClientModal() {
        document.getElementById('client-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeClientModal();
    });

    function filterClients() {
        const query = document.getElementById('client-search').value.toLowerCase();
        const cards = document.querySelectorAll('#clients-grid > div');
        cards.forEach(function (card) {
            const name = card.getAttribute('data-name') || '';
            card.style.display = name.includes(query) ? '' : 'none';
        });
    }

    // --- Modal Modifier ---
    function openEditModal(btn) {
        document.getElementById('edit-client-form').action = btn.dataset.action;
        document.getElementById('edit-name').value = btn.dataset.name || '';
        document.getElementById('edit-email').value = btn.dataset.email || '';
        document.getElementById('edit-phone').value = btn.dataset.phone === 'null' ? '' : (btn.dataset.phone || '');
        document.getElementById('edit-city').value = btn.dataset.city === 'null' ? '' : (btn.dataset.city || '');
        document.getElementById('edit-notes').value = btn.dataset.notes === 'null' ? '' : (btn.dataset.notes || '');

        document.getElementById('edit-client-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeEditModal() {
        document.getElementById('edit-client-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    // --- Modal Supprimer ---
    function openDeleteModal(btn) {
        document.getElementById('delete-client-form').action = btn.dataset.action;
        document.getElementById('delete-client-name').textContent = btn.dataset.name || 'ce client';

        document.getElementById('delete-client-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeDeleteModal() {
        document.getElementById('delete-client-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    
   
        document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            closeEditModal();
            closeDeleteModal();
        }
    });

    // Ouvre automatiquement le formulaire d'ajout si on arrive depuis
    // le raccourci "Ajouter un client" du dashboard (?new=1)
    if (new URLSearchParams(window.location.search).get('new') === '1') {
        openClientModal();
    }
    // Recherche automatique après une courte pause de frappe (debounce)
(function () {
    const input = document.querySelector('form[action="{{ route('clients.index') }}"] input[name="search"]');
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