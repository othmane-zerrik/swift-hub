<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'SwiftHub') }} - Facturation & Devis pour Professionnels</title>

        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Plus Jakarta Sans', 'Outfit', sans-serif;
            }
            .bg-grid-pattern {
                background-size: 50px 50px;
                background-image: 
                    linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
                    linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
            }
            .dashboard-mockup {
                transform: perspective(1000px) rotateX(8deg) rotateY(-8deg) rotateZ(1deg);
                transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s ease-out;
            }
            .dashboard-mockup:hover {
                transform: perspective(1000px) rotateX(0deg) rotateY(0deg) rotateZ(0deg);
                box-shadow: 0 30px 60px -15px rgba(220, 38, 38, 0.25);
            }
            .animate-float {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
        </style>
        

    </head>
    <body class="bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 min-h-screen relative overflow-x-hidden bg-grid-pattern selection:bg-red-600 selection:text-white">
        
    
        <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-gradient-to-br from-red-600/10 to-rose-600/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute top-1/3 right-1/4 w-[600px] h-[600px] bg-gradient-to-br from-slate-600/10 to-slate-900/10 rounded-full blur-3xl -z-10 pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-[400px] h-[400px] bg-gradient-to-tr from-red-600/5 to-slate-800/5 rounded-full blur-3xl -z-10 pointer-events-none"></div>


        <header class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">
            
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 text-red-600 dark:text-red-500 group-hover:scale-105 transition-transform duration-300">
                    <x-application-logo />
                </div>
                <div class="flex flex-col leading-none">
                    <span class="text-2xl font-black tracking-wider text-slate-900 dark:text-white font-outfit uppercase">
                        <span class="text-red-600">Swift</span>Hub
                    </span>
                </div>
            </a>

            
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-2xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white font-semibold text-sm shadow-lg shadow-red-500/10 hover:shadow-red-500/20 hover:-translate-y-0.5 transition-all duration-200">
                            Tableau de bord
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-2xl font-semibold text-sm text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-all duration-200">
                            Connexion
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-2xl bg-slate-900 hover:bg-slate-800 dark:bg-white dark:hover:bg-slate-100 text-white dark:text-slate-900 font-semibold text-sm hover:-translate-y-0.5 transition-all duration-200 shadow-md">
                                Inscription
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        
        <section class="max-w-7xl mx-auto px-6 pt-12 pb-24 grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            
            <div class="lg:col-span-6 space-y-8 text-center lg:text-left">
               
                <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-red-600/10 text-red-700 dark:text-red-400 font-semibold text-xs uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-600 animate-pulse"></span>
                    Gestion commerciale intelligente
                </span>

               
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.1] font-outfit">
                    La facturation <br>
                    <span class="bg-gradient-to-r from-red-600 via-rose-600 to-slate-800 dark:from-red-500 dark:via-rose-500 dark:to-slate-400 bg-clip-text text-transparent">
                        professionnelle
                    </span>, <br>
                    adaptée à votre commerce.
                </h1>

               
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed font-light">
                    Pilotez votre activité  en toute simplicité. Créez des factures élégantes, suivez vos devis et analysez vos performances financières sur une plateforme intuitive.
                </p>

               
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white font-bold text-base shadow-xl shadow-red-500/15 hover:shadow-red-500/35 hover:-translate-y-1 transition-all duration-300 text-center">
                            Aller au Tableau de Bord
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-500 hover:to-rose-500 text-white font-bold text-base shadow-xl shadow-red-500/15 hover:shadow-red-500/35 hover:-translate-y-1 transition-all duration-300 text-center">
                            Créer un compte gratuit
                        </a>
                        <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white font-semibold text-base hover:-translate-y-1 hover:shadow-lg transition-all duration-300 text-center">
                            Se connecter
                        </a>
                    @endauth
                </div>

                
                <div class="pt-4 flex items-center justify-center lg:justify-start gap-6 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                        Aucune carte requise
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                        100% sécurisé
                    </span>
                </div>
            </div>

            
            <div class="lg:col-span-6 flex justify-center lg:justify-end animate-float">
                <div class="w-full max-w-[500px] rounded-3xl p-1.5 bg-gradient-to-br from-red-500/20 via-slate-500/10 to-slate-800/20 border border-white/20 shadow-2xl backdrop-blur-md">
                 
                    <div class="dashboard-mockup w-full rounded-2xl bg-white dark:bg-slate-900 border border-slate-200/80 dark:border-slate-800/80 p-6 space-y-6 shadow-xl">
                        
                      
                        <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-800/80 pb-4">
                            <div class="flex items-center gap-2">
                                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                                <span class="w-3 h-3 rounded-full bg-slate-400"></span>
                                <span class="w-3 h-3 rounded-full bg-slate-200"></span>
                                <span class="text-xs font-semibold text-slate-400 dark:text-slate-500 ml-2">dashboard_overview.json</span>
                            </div>
                            <span class="px-2.5 py-0.5 rounded-lg bg-red-500/10 text-red-600 dark:text-red-400 font-bold text-xs uppercase">
                                En Direct
                            </span>
                        </div>

                       
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800/60">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Chiffre d'Affaires</span>
                                <span class="text-xl font-extrabold text-slate-900 dark:text-white mt-1 block">14 250,00 DH</span>
                                <span class="text-[10px] text-red-500 font-bold flex items-center gap-0.5 mt-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                    </svg>
                                    +12.4% ce mois
                                </span>
                            </div>
                            <div class="p-4 rounded-2xl bg-slate-50 dark:bg-slate-800/40 border border-slate-100 dark:border-slate-800/60">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Factures Payées</span>
                                <span class="text-xl font-extrabold text-slate-900 dark:text-white mt-1 block">92.4%</span>
                                <span class="text-[10px] text-red-500 font-bold block mt-1">Taux d'encaissement</span>
                            </div>
                        </div>

                      
                        <div class="space-y-3">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Flux récent</span>
                           
                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50/50 dark:bg-slate-800/20 border border-slate-100 dark:border-slate-800/40 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-red-500/10 text-red-600 flex items-center justify-center font-bold text-xs">
                                        RC
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 dark:text-white">Restaurant le Gourmet</p>
                                        <p class="text-[9px] text-slate-400">Facture FA-2026-003</p>
                                    </div>
                                </div>
                                <span class="text-xs font-bold text-red-600 dark:text-red-400">+ 3 400,00 DH</span>
                            </div>

                           
                            <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50/50 dark:bg-slate-800/20 border border-slate-100 dark:border-slate-800/40 hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-500/10 text-slate-600 dark:text-slate-400 flex items-center justify-center font-bold text-xs">
                                        CH
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-800 dark:text-white">Cafétéria de l'Hôtel</p>
                                        <p class="text-[9px] text-slate-400">Devis DE-2026-008</p>
                                    </div>
                                </div>
                                <span class="px-2 py-0.5 rounded bg-red-500/15 text-red-600 dark:text-red-500 font-extrabold text-[9px] uppercase">
                                    Accepté
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

       
        <section class="max-w-7xl mx-auto px-6 py-24 border-t border-slate-200/50 dark:border-slate-800/50">
           
            <div class="max-w-3xl mx-auto text-center space-y-4 mb-20">
                <h2 class="text-xs font-bold text-red-600 dark:text-red-500 uppercase tracking-widest">
                    Fonctionnalités Clés
                </h2>
                <p class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 dark:text-white font-outfit">
                    Tout ce dont vous avez besoin pour piloter vos ventes .
                </p>
                <p class="text-base text-slate-500 dark:text-slate-400 font-light leading-relaxed">
                    Une gamme complète d'outils performants conçus spécifiquement pour la facturation et le suivi de vos clients CHR.
                </p>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
              
                <div class="group p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800/60 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-red-500/10 text-red-600 dark:text-red-400 flex items-center justify-center text-2xl mb-6 group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Facturation Intuitive</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                        Rédigez et organisez vos factures rapidement. Attribuez des statuts de paiement clairs et suivez l'avancement de vos encaissements.
                    </p>
                </div>

                
                <div class="group p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800/60 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-slate-500/10 text-slate-600 dark:text-slate-400 flex items-center justify-center text-2xl mb-6 group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Pipeline de Devis</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                        Créez des devis précis et ajustables. Suivez les devis acceptés, expirés ou rejetés pour maximiser l'efficacité de vos relances commerciales.
                    </p>
                </div>

                
                <div class="group p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800/60 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-red-600/10 text-red-600 dark:text-red-500 flex items-center justify-center text-2xl mb-6 group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Suivi Clientèle CRM</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                        Centralisez les informations et coordonnées de vos clients. Visualisez instantanément l'historique de factures rattachées à chaque fiche.
                    </p>
                </div>

                
                <div class="group p-8 rounded-3xl bg-white dark:bg-slate-900 border border-slate-200/60 dark:border-slate-800/60 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300">
                    <div class="w-12 h-12 rounded-2xl bg-slate-700/10 text-slate-700 dark:text-slate-300 flex items-center justify-center text-2xl mb-6 group-hover:scale-105 transition-transform duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2-2v6a2 2 0 002 2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 012 2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Analyses & Graphiques</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed font-light">
                        Visualisez vos revenus mensuels sur les 12 derniers mois et analysez vos performances grâce à des rapports analytiques complets.
                    </p>
                </div>

            </div>
        </section>

       
        <section class="max-w-7xl mx-auto px-6 py-12">
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 border border-slate-800 p-12 lg:p-20 text-center space-y-8 shadow-2xl">
                
                <div class="absolute inset-0 bg-grid-pattern opacity-10"></div>
                <div class="absolute -top-32 -left-32 w-64 h-64 bg-red-600/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-32 -right-32 w-64 h-64 bg-slate-600/10 rounded-full blur-3xl"></div>

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white leading-tight font-outfit relative z-10 max-w-2xl mx-auto">
                    Prêt à illuminer votre gestion financière ?
                </h2>
                <p class="text-red-200/70 font-light text-base max-w-xl mx-auto relative z-10">
                    Rejoignez dès aujourd'hui SwiftHub et profitez d'une interface de gestion fluide et élégante pour propulser votre entreprise.
                </p>
                <div class="relative z-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-400 hover:to-rose-400 text-white font-extrabold text-base shadow-xl shadow-red-500/10 hover:shadow-red-500/25 transition-all duration-300">
                            Retourner au Tableau de Bord
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-400 hover:to-rose-400 text-white font-extrabold text-base shadow-xl shadow-red-500/10 hover:shadow-red-500/25 transition-all duration-300">
                            Créer mon compte gratuitement
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        
        <footer class="max-w-7xl mx-auto px-6 py-12 border-t border-slate-200/50 dark:border-slate-800/50 flex flex-col sm:flex-row items-center justify-between gap-6 text-sm text-slate-400 dark:text-slate-500">
            <div class="flex items-center gap-3">
                <span class="font-extrabold text-slate-700 dark:text-slate-300 uppercase tracking-wider"><span class="text-red-600">Swift</span>Hub</span>
                <span>&copy; {{ date('Y') }}. Tous droits réservés.</span>
            </div>
            <div class="flex items-center gap-4">
                <span> othmane zerrik</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 animate-pulse" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
                <span>&amp; Laravel</span>
            </div>
        </footer>

    </body>
</html>