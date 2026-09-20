<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapports - SwiftHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #0A0A0A; --bg: #FFFFFF; --surface: #FFFFFF; --border: #E6E6E3;
            --hover: #FBF1F1; --text: #171717; --muted: #8B8B86; --accent: #D62828;
            --accent-soft: #FCE8E8; --green: #16A34A; --green-soft: #E8F7EE;
            --amber: #C9862F; --amber-soft: #FBF0E1; --gray-soft: #F1F1EF;
            --font-body: 'Plus Jakarta Sans', sans-serif; --font-mono: 'JetBrains Mono', monospace;
        }
        body { font-family: var(--font-body); background: var(--bg); color: var(--text); }
        .font-mono { font-family: var(--font-mono); }
        h1, h2, h3 { font-family: var(--font-body); letter-spacing: -0.02em; }
        .icon { width: 18px; height: 18px; stroke-width: 1.6; flex-shrink: 0; }
        .nav-link { border-left: 2px solid transparent; }
        .nav-link.active { border-left-color: var(--accent); background: var(--hover); color: var(--accent); font-weight: 500; }
        .nav-link:not(.active):hover { background: var(--hover); color: var(--ink); }
        summary::-webkit-details-marker { display: none; }
        summary { list-style: none; }
        .field-input { border: 1px solid var(--border); border-radius: 10px; padding: 9px 14px; font-size: 14px; font-family: var(--font-body); }
        .field-input:focus { outline: none; border-color: var(--accent); }
        .tab { padding: 8px 16px; border-radius: 10px; font-size: 14px; font-weight: 600; transition: all .15s ease; }
        .tab.active { background: var(--accent); color: #fff; }
        .tab:not(.active) { color: var(--muted); }
        .tab:not(.active):hover { background: var(--gray-soft); }
        .badge { font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 999px; display: inline-block; }
        .badge-en_attente { background: var(--amber-soft); color: var(--amber); }
        .badge-payee { background: var(--green-soft); color: var(--green); }
        .badge-en_retard { background: var(--accent-soft); color: var(--accent); }
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
        <div class="h-20 flex items-center px-7 border-b" style="border-color: var(--border);">
            <div>
                <h1 class="text-2xl font-extrabold tracking-tight" style="color: var(--accent);">SwiftHub</h1>
                <p class="text-[13px] font-medium mt-1" style="color: var(--muted);">Gestion commerciale</p>
            </div>
        </div>
        <nav class="flex-1 px-4 py-5 space-y-0.5">
            <a href="{{ route('dashboard') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10.5 12 3l9 7.5M5 9.5V21h14V9.5" /></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('analytics.index') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 19V5M4 19h16M8 19v-6M13 19v-9M18 19v-4" />
                </svg>
                <span>Analytique</span>
            </a>
            <a href="{{ route('clients.index') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 19v-1a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v1M11 5.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0ZM22 19v-1a4 4 0 0 0-3-3.87M16 5.63a3.5 3.5 0 0 1 0 6.75" /></svg>
                <span>Clients</span>
            </a>
            <a href="{{ route('fournisseurs.index') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 12 3l9 4.5M4 10v9a1 1 0 0 0 1 1h4v-6h6v6h4a1 1 0 0 0 1-1v-9" />
                </svg>
                <span>Fournisseurs</span>
            </a>
            <a href="{{ route('products.index') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8v8a1 1 0 0 1-.5.87l-8 4.5a1 1 0 0 1-1 0l-8-4.5A1 1 0 0 1 3 16V8a1 1 0 0 1 .5-.87l8-4.5a1 1 0 0 1 1 0l8 4.5A1 1 0 0 1 21 8ZM3.3 7.3 12 12l8.7-4.7M12 12v9" /></svg>
                <span>Produits</span>
            </a>
            <a href="{{ route('devis.index') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.5A1.5 1.5 0 0 1 10.5 2h3A1.5 1.5 0 0 1 15 3.5V5a1 1 0 0 1-1 1H10a1 1 0 0 1-1-1V3.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6M9 16h4" />
                </svg>
                <span>Devis</span>
            </a>
            <a href="{{ route('factures.index') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h7l5 5v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1ZM14 3v5h5M9 13h6M9 16.5h6" />
                </svg>
                <span>Factures</span>
            </a>
            <a href="{{ route('employees.index') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20v-1.5a3.5 3.5 0 0 0-3.5-3.5h-5A3.5 3.5 0 0 0 5 18.5V20M10 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM19 20v-1.2a3 3 0 0 0-2-2.83M15.5 4.2a3 3 0 0 1 0 5.6" /></svg>
                <span>Employés</span>
            </a>
            <a href="{{ route('reports.index') }}" class="nav-link active flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 3h10a1 1 0 0 1 1 1v16l-6-3-6 3V4a1 1 0 0 1 1-1ZM9 8h6M9 11.5h6" />
                </svg>
                <span>Rapports</span>
            </a>
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
                    <a href="{{ route('finances.index') }}" class="block py-2 text-sm hover:text-[var(--ink)] transition" style="color: var(--muted);">Chiffre d'affaires</a>
                    <a href="{{ route('credits.index') }}" class="block py-2 text-sm hover:text-[var(--ink)] transition" style="color: var(--muted);">Crédits</a>
             
                </div>
            </details>
            <a href="{{ route('settings.edit') }}" class="nav-link flex items-center gap-3 pl-4 pr-4 py-3 rounded-r-md text-[15px] font-medium transition" style="color: var(--muted);">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09a1.65 1.65 0 0 0-1.08-1.51 1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H4a2 2 0 1 1 0-4h.09a1.65 1.65 0 0 0 1.51-1.08 1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H10a1.65 1.65 0 0 0 1-1.51V4a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V10a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1Z" />
                </svg>
                <span>Paramètres</span>
            </a>
        </nav>
        <div class="p-4 border-t" style="border-color: var(--border);">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 pl-4 pr-4 py-2.5 text-sm transition rounded-md hover:bg-[var(--hover)]" style="color: var(--muted);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 8V6a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-7a2 2 0 0 1-2-2v-2M14 12H3m0 0 3.5-3.5M3 12l3.5 3.5" /></svg>
                    <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>

  <main class="flex-1 lg:ml-64">

        <header class="border-b px-8 py-5" style="border-color: var(--border);">
            <h2 class="text-2xl font-extrabold tracking-tight">Rapports</h2>
            <p class="text-[15px] mt-1" style="color: var(--muted);">Rapport de ventes par période, exportable</p>
        </header>

        <div class="p-8">

            {{-- Filtres de période --}}
            <form method="GET" action="{{ route('reports.index') }}" id="periode-form">
                <div class="flex items-center justify-between gap-4 mb-6 flex-wrap">
                    <div class="flex items-center gap-1 p-1 rounded-xl" style="background: var(--gray-soft);">
                        <button type="submit" name="periode" value="ce_mois" class="tab {{ $periode === 'ce_mois' ? 'active' : '' }}">Ce mois</button>
                        <button type="submit" name="periode" value="mois_dernier" class="tab {{ $periode === 'mois_dernier' ? 'active' : '' }}">Mois dernier</button>
                        <button type="submit" name="periode" value="cette_annee" class="tab {{ $periode === 'cette_annee' ? 'active' : '' }}">Cette année</button>
                        <button type="submit" name="periode" value="personnalise" class="tab {{ $periode === 'personnalise' ? 'active' : '' }}">Personnalisé</button>
                    </div>

                    <a href="{{ route('reports.export', request()->query()) }}"
                       class="flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold text-sm text-white transition hover:opacity-90"
                       style="background: var(--accent);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v13m0 0-4-4m4 4 4-4M5 21h14" />
                        </svg>
                        Exporter en CSV
                    </a>
                </div>

              @if($periode === 'personnalise')
    <div class="flex items-center gap-3 mb-6">
        <input type="date" name="date_debut" value="{{ request('date_debut', $debut->format('Y-m-d')) }}" class="field-input">
        <span style="color: var(--muted);">à</span>
        <input type="date" name="date_fin" value="{{ request('date_fin', $fin->format('Y-m-d')) }}" class="field-input">
        <button type="submit" name="periode" value="personnalise" class="px-4 py-2 rounded-lg font-semibold text-sm text-white transition hover:opacity-90" style="background: var(--accent);">
            Appliquer
        </button>
    </div>
@endif
            </form>

            <p class="text-sm mb-6" style="color: var(--muted);">
                Période : <span class="font-semibold" style="color: var(--text);">{{ $debut->format('d/m/Y') }} → {{ $fin->format('d/m/Y') }}</span>
            </p>

            {{-- Résumé --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-6">
                <div class="rounded-xl p-6" style="border: 1px solid var(--border);">
                    <p class="text-sm" style="color: var(--muted);">Nombre de factures</p>
                    <p class="font-mono text-2xl font-bold mt-2">{{ $nombreFactures }}</p>
                </div>
                <div class="rounded-xl p-6" style="border: 1px solid var(--border);">
                    <p class="text-sm" style="color: var(--muted);">Total HT</p>
                    <p class="font-mono text-2xl font-bold mt-2">{{ number_format($totalHt, 2) }} DH</p>
                </div>
                <div class="rounded-xl p-6" style="border: 1px solid var(--border);">
                    <p class="text-sm" style="color: var(--muted);">Total TTC</p>
                    <p class="font-mono text-2xl font-bold mt-2" style="color: var(--accent);">{{ number_format($totalTtc, 2) }} DH</p>
                </div>
            </div>

            {{-- Tableau --}}
            @if($factures->count() > 0)
                <div class="rounded-2xl overflow-hidden" style="border: 1px solid var(--border);">
                    <table class="w-full text-sm">
                        <thead>
                            <tr style="background: var(--gray-soft);">
                                <th class="text-left px-6 py-3 font-semibold" style="color: var(--muted);">Numéro</th>
                                <th class="text-left px-6 py-3 font-semibold" style="color: var(--muted);">Client</th>
                                <th class="text-left px-6 py-3 font-semibold" style="color: var(--muted);">Date</th>
                                <th class="text-center px-6 py-3 font-semibold" style="color: var(--muted);">Statut</th>
                                <th class="text-right px-6 py-3 font-semibold" style="color: var(--muted);">Total TTC</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($factures as $facture)
                            <tr style="border-top: 1px solid var(--border);">
                                <td class="px-6 py-4 font-mono font-semibold">{{ $facture->numero }}</td>
                                <td class="px-6 py-4">{{ $facture->client->name ?? 'Client supprimé' }}</td>
                                <td class="px-6 py-4" style="color: var(--muted);">{{ $facture->date_facture->format('d/m/Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <span class="badge badge-{{ $facture->statut }}">
                                        @switch($facture->statut)
                                            @case('payee') Payée @break
                                            @case('en_retard') En retard @break
                                            @default En attente
                                        @endswitch
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right font-mono font-semibold">{{ number_format($facture->total_ttc, 2) }} DH</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="rounded-2xl py-16 text-center" style="border: 1px dashed var(--border);">
                    <h4 class="text-lg font-bold">Aucune facture sur cette période</h4>
                    <p class="text-sm mt-1" style="color: var(--muted);">Essaie une autre période ou crée de nouvelles factures.</p>
                </div>
            @endif

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