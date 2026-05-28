<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ENADE Prep — Plataforma de Estudos</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans bg-slate-50">

    {{-- Navigation --}}
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-24">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto object-contain">
            </a>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">Dashboard</a>
                    <a href="{{ route('simulado.index') }}" class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Iniciar Simulado</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">Entrar</a>
                    <a href="{{ route('register') }}" class="bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded-lg hover:bg-indigo-700 transition">Criar Conta</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative min-h-screen flex items-center overflow-hidden pt-16">
        <div class="absolute inset-0">
            @if(file_exists(public_path('images/hero.png')))
                <img src="{{ asset('images/hero.png') }}" alt="" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-indigo-900 via-indigo-800 to-slate-900"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 via-slate-900/70 to-slate-900/30"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="max-w-2xl">
                <span class="inline-flex items-center gap-2 bg-indigo-500/20 border border-indigo-400/30 text-indigo-300 text-xs font-semibold px-3 py-1 rounded-full mb-6">
                    <span class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></span>
                    Plataforma de Estudos ENADE
                </span>

                <h1 class="text-5xl sm:text-6xl font-extrabold text-white leading-tight mb-6">
                    Prepare-se para o
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">ENADE</span>
                    com confiança
                </h1>

                <p class="text-lg text-slate-300 mb-10 leading-relaxed">
                    Questões comentadas, simulados cronometrados e feedback imediato para você arrasar na sua avaliação.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ route('simulado.index') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-8 py-4 rounded-xl text-base transition shadow-lg shadow-indigo-500/30">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Iniciar Simulado
                        </a>
                        <a href="{{ route('pratica.index') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold px-8 py-4 rounded-xl text-base transition">
                            Praticar Agora
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-bold px-8 py-4 rounded-xl text-base transition shadow-lg shadow-indigo-500/30">
                            Começar Gratuitamente
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold px-8 py-4 rounded-xl text-base transition">
                            Já tenho conta
                        </a>
                    @endauth
                </div>

                <div class="flex items-center gap-6 mt-12">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">5k+</div>
                        <div class="text-xs text-slate-400">Questões</div>
                    </div>
                    <div class="w-px h-10 bg-slate-700"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">50+</div>
                        <div class="text-xs text-slate-400">Cursos</div>
                    </div>
                    <div class="w-px h-10 bg-slate-700"></div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">100%</div>
                        <div class="text-xs text-slate-400">Gratuito</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Tudo que você precisa para se sair bem</h2>
                <p class="text-slate-500 text-lg max-w-xl mx-auto">Uma plataforma pensada especialmente para quem vai fazer o ENADE.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group p-8 rounded-2xl border border-slate-100 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition-colors">
                        <svg class="w-6 h-6 text-indigo-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Simulados Cronometrados</h3>
                    <p class="text-slate-500 leading-relaxed">Pratique sob pressão de tempo, exatamente como no dia da prova. Timer automático e navegação livre entre questões.</p>
                </div>

                <div class="group p-8 rounded-2xl border border-slate-100 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition-colors">
                        <svg class="w-6 h-6 text-indigo-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Feedback Imediato</h3>
                    <p class="text-slate-500 leading-relaxed">No modo prática, saiba na hora se acertou ou errou. Veja a alternativa correta e reforce seu aprendizado.</p>
                </div>

                <div class="group p-8 rounded-2xl border border-slate-100 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                    <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center mb-6 group-hover:bg-indigo-600 transition-colors">
                        <svg class="w-6 h-6 text-indigo-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Estatísticas de Desempenho</h3>
                    <p class="text-slate-500 leading-relaxed">Acompanhe sua evolução com dados claros. Veja sua média de acertos e identifique onde melhorar.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-br from-indigo-600 to-indigo-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">Pronto para começar?</h2>
            <p class="text-indigo-200 text-lg mb-10">Crie sua conta gratuita e comece a estudar hoje mesmo.</p>
            @guest
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 bg-white text-indigo-700 font-bold px-10 py-4 rounded-xl text-base hover:bg-indigo-50 transition shadow-xl">
                    Criar minha conta gratuita
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
            @endguest
        </div>
    </section>

    <footer class="bg-slate-900 text-slate-400 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-indigo-600 rounded flex items-center justify-center">
                    <span class="text-white font-bold text-xs">E</span>
                </div>
                <span class="font-semibold text-white">ENADEPrep</span>
            </div>
            <p class="text-sm">Desenvolvido para o projeto universitário &mdash; 2024</p>
        </div>
    </footer>
</body>
</html>
