<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">Fórum de Dúvidas</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="bg-gradient-to-r from-violet-600 to-indigo-600 px-8 py-10 text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-extrabold text-white mb-2">Fórum em breve!</h1>
                    <p class="text-violet-200 text-sm max-w-sm mx-auto">O espaço de discussão de dúvidas e troca de conhecimento entre os estudantes está em desenvolvimento.</p>
                </div>

                <div class="p-8">
                    <h3 class="font-bold text-slate-800 mb-4">O que estará disponível:</h3>
                    <div class="space-y-3">
                        @php
                            $features = [
                                ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'label' => 'Discussão de questões do ENADE', 'color' => 'text-indigo-500 bg-indigo-50'],
                                ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'Criação de tópicos por tema e área', 'color' => 'text-violet-500 bg-violet-50'],
                                ['icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'label' => 'Respostas votadas pela comunidade', 'color' => 'text-amber-500 bg-amber-50'],
                                ['icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'label' => 'Notificações de novas respostas', 'color' => 'text-green-500 bg-green-50'],
                            ];
                        @endphp
                        @foreach($features as $f)
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-slate-100">
                                <div class="w-9 h-9 {{ $f['color'] }} rounded-xl flex items-center justify-center shrink-0">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $f['icon'] }}"/>
                                    </svg>
                                </div>
                                <span class="text-sm text-slate-700 font-medium">{{ $f['label'] }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('dashboard') }}" class="flex-1 flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl text-sm transition">
                            Voltar à Página Inicial
                        </a>
                        <a href="{{ route('pratica.index') }}" class="flex-1 flex items-center justify-center gap-2 bg-white border border-slate-200 hover:border-indigo-300 text-slate-700 font-semibold py-3 rounded-xl text-sm transition">
                            Praticar Questões
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
