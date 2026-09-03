<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inscription - SwiftHub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        .bg-grid-pattern {
            background-size: 50px 50px;
            background-image:
                linear-gradient(to right, rgba(148, 163, 184, 0.05) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(148, 163, 184, 0.05) 1px, transparent 1px);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center bg-slate-50 text-slate-800 bg-grid-pattern relative overflow-x-hidden">

    <div class="fixed -top-32 -left-32 w-72 h-72 sm:w-[450px] sm:h-[450px] bg-red-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="fixed -bottom-32 -right-32 w-72 h-72 sm:w-[450px] sm:h-[450px] bg-slate-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <main class="relative z-10 w-full max-w-sm mx-auto px-4 py-6 sm:py-8">

        <a
            href="{{ url('/') }}"
            class="flex justify-center items-center gap-2 sm:gap-3 mb-6 sm:mb-10"
        >
            <div class="w-10 h-10 sm:w-12 sm:h-12 text-red-600 shrink-0">
                <x-application-logo class="w-full h-full" />
            </div>

            <span class="text-2xl sm:text-3xl font-black tracking-wider text-slate-900 font-outfit uppercase whitespace-nowrap">
                <span class="text-red-600">Swift</span>Hub
            </span>
        </a>

        <section class="bg-white border border-slate-200 rounded-2xl sm:rounded-3xl p-5 sm:p-8 lg:p-10 shadow-xl">

            <div class="text-center mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 font-outfit">
                    Créer un compte 
                </h1>

                <p class="text-slate-500 mt-2 sm:mt-3 text-sm sm:text-base leading-relaxed">
                    Rejoignez SwiftHub en quelques secondes.
                </p>
            </div>
  @if ($errors->any()) 
  <div class="mb-4 p-3 rounded-xl bg-red-50 text-red-700 text-sm"> 
    <ul class="list-disc list-inside"> 
        @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
          @endforeach
         </ul> 
         </div> 
         @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4 sm:mb-5">
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                        Nom complet
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        autocomplete="name"
                        placeholder="othmane zerrik"
                        class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition"
                    >
                </div>

                <div class="mb-4 sm:mb-5">
                    <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                        Adresse email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        autocomplete="email"
                        placeholder="exemple@email.com"
                        class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition"
                    >
                </div>

                <div class="mb-4 sm:mb-5">
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                        Mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition"
                    >
                </div>

                <div class="mb-5 sm:mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                        Confirmer le mot de passe
                    </label>

                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 sm:py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 placeholder:text-slate-400 outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition"
                    >
                </div>

                <div class="flex items-start gap-2 mb-5 sm:mb-6">
                    <input
                        type="checkbox"
                        id="terms"
                        name="terms"
                        required
                        class="mt-0.5 w-4 h-4 shrink-0 rounded border-slate-300 text-red-600 focus:ring-red-500"
                    >

                    <label for="terms" class="text-sm text-slate-600 leading-relaxed">
                        J'accepte les
                        <a href="#" class="font-semibold text-red-600 hover:text-red-500">conditions d'utilisation</a>
                        et la
                        <a href="#" class="font-semibold text-red-600 hover:text-red-500">politique de confidentialité</a>.
                    </label>
                </div>

                <button
                    type="submit"
                    class="w-full py-3 sm:py-3.5 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 text-white font-bold hover:from-red-500 hover:to-rose-500 active:scale-[0.98] shadow-lg shadow-red-500/20 transition-all duration-300"
                >
                    Créer mon compte
                </button>
            </form>

            <div class="text-center mt-6 sm:mt-8 pt-5 sm:pt-6 border-t border-slate-100">
                <p class="text-sm sm:text-base text-slate-500 leading-relaxed">
                    Vous avez déjà un compte ?
                    <a
                        href="{{ url('/login') }}"
                        class="font-bold text-red-600 hover:text-red-500 whitespace-nowrap"
                    >
                        Se connecter
                    </a>
                </p>
            </div>

        </section>

        <div class="text-center mt-5 sm:mt-6 pb-4">
            <a href="{{ url('/') }}" class="inline-block text-sm text-slate-500 hover:text-slate-900 transition">
                ← Retour à l'accueil
            </a>
        </div>

    </main>

</body>
</html>