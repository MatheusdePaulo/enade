<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 leading-tight">Página Inicial</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            @if(session('status'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm font-medium">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Welcome Banner --}}
            <div class="relative bg-gradient-to-r from-indigo-600 via-indigo-700 to-violet-700 rounded-2xl p-8 overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <circle cx="85" cy="15" r="45" fill="white"/>
                        <circle cx="15" cy="85" r="35" fill="white"/>
                    </svg>
                </div>
                <div class="relative flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-indigo-200 text-sm font-medium mb-1">Bem-vindo de volta,</p>
                        <h1 class="text-3xl font-extrabold text-white mb-2">{{ Auth::user()->name }}</h1>
                        <p class="text-indigo-200 text-sm">
                            @if($selectedCourse)
                                Curso: <span class="text-white font-semibold">{{ $selectedCourse->name }}</span>
                            @else
                                Selecione seu curso para uma experiência personalizada.
                            @endif
                        </p>
                    </div>
                    <a href="{{ route('simulado.index') }}"
                       class="shrink-0 inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 border border-white/30 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Iniciar Simulado
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                    <div class="w-9 h-9 bg-indigo-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-4.5 h-4.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-2xl font-extrabold text-slate-900">{{ number_format($totalQuestions) }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Questões disponíveis</div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                    <div class="w-9 h-9 bg-slate-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-4.5 h-4.5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <div class="text-2xl font-extrabold text-slate-900">{{ $simuladoStats['total_respondidas'] }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Respondidas hoje</div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                    <div class="w-9 h-9 bg-green-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-4.5 h-4.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    @php
                        $media = $simuladoStats['total_respondidas'] > 0
                            ? round(($simuladoStats['total_corretas'] / $simuladoStats['total_respondidas']) * 100)
                            : 0;
                    @endphp
                    <div class="text-2xl font-extrabold text-slate-900">{{ $media }}%</div>
                    <div class="text-xs text-slate-500 mt-0.5">Taxa de acertos</div>
                </div>

                <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm">
                    <div class="w-9 h-9 bg-violet-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-4.5 h-4.5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <div class="text-2xl font-extrabold text-slate-900">{{ $courses->count() }}</div>
                    <div class="text-xs text-slate-500 mt-0.5">Cursos cadastrados</div>
                </div>
            </div>

            {{-- ========== QUESTÃO DO DIA / PRÁTICA RÁPIDA ========== --}}
            @if($questaoDodia)
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                    {{-- Section Header --}}
                    <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800 text-base">Prática Rápida</h3>
                                <p class="text-xs text-slate-500">Questão do dia — responda e veja o gabarito comentado</p>
                            </div>
                        </div>
                        <a href="{{ route('pratica.index') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold flex items-center gap-1 transition">
                            Ver mais questões
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>

                    {{-- Alpine.js Question Component --}}
                    <div x-data="{
                        answered: false,
                        selected: null,
                        correctId: {{ $questaoDodia->alternatives->firstWhere('is_correct', true)?->id ?? 'null' }},
                        choose(altId) {
                            if (this.answered) return;
                            this.answered = true;
                            this.selected = altId;
                        },
                        getClass(altId, isCorrect) {
                            if (!this.answered) return 'border-slate-200 hover:border-indigo-400 hover:bg-indigo-50/60 cursor-pointer';
                            if (isCorrect) return 'border-green-500 bg-green-50 ring-1 ring-green-400/50';
                            if (altId === this.selected && !isCorrect) return 'border-red-400 bg-red-50';
                            return 'border-slate-200 opacity-50';
                        }
                    }" class="p-6 space-y-5">

                        {{-- Question Meta + Statement --}}
                        <div class="space-y-3">
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-100 text-indigo-700">
                                    {{ $questaoDodia->course->name ?? 'Geral' }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold
                                    {{ $questaoDodia->component === 'Específico' ? 'bg-violet-100 text-violet-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ $questaoDodia->component === 'Específico' ? 'Componente Específico' : 'Formação Geral' }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-slate-100 text-slate-600">
                                    ENADE {{ $questaoDodia->year }}
                                </span>
                            </div>
                            <p class="text-slate-800 font-medium text-sm leading-relaxed whitespace-pre-line">{{ $questaoDodia->statement }}</p>
                        </div>

                        {{-- Alternatives --}}
                        @php $letters = ['A', 'B', 'C', 'D', 'E']; @endphp
                        <div class="space-y-2">
                            @foreach($questaoDodia->alternatives as $i => $alt)
                                <div @click="choose({{ $alt->id }})"
                                     :class="getClass({{ $alt->id }}, {{ $alt->is_correct ? 'true' : 'false' }})"
                                     class="flex items-start gap-3 p-3.5 rounded-xl border-2 transition-all duration-200 select-none">
                                    <div class="shrink-0 w-7 h-7 rounded-lg flex items-center justify-center text-xs font-bold transition-colors"
                                         :class="{
                                             'bg-indigo-100 text-indigo-700': !answered,
                                             'bg-green-500 text-white': answered && {{ $alt->is_correct ? 'true' : 'false' }},
                                             'bg-red-400 text-white': answered && selected === {{ $alt->id }} && !{{ $alt->is_correct ? 'true' : 'false' }},
                                             'bg-slate-100 text-slate-400': answered && selected !== {{ $alt->id }} && !{{ $alt->is_correct ? 'true' : 'false' }}
                                         }">
                                        {{ $letters[$i] ?? ($i + 1) }}
                                    </div>
                                    <span class="text-slate-700 text-sm leading-relaxed pt-0.5 flex-1">{{ $alt->text }}</span>
                                    <div class="shrink-0 ml-auto pt-0.5" x-show="answered">
                                        <template x-if="{{ $alt->is_correct ? 'true' : 'false' }}">
                                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        </template>
                                        <template x-if="selected === {{ $alt->id }} && !{{ $alt->is_correct ? 'true' : 'false' }}">
                                            <svg class="w-5 h-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                        </template>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Feedback + Gabarito Comentado --}}
                        <div x-show="answered" x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             class="space-y-3">

                            {{-- Result Banner --}}
                            <div :class="selected === correctId ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'"
                                 class="flex items-center gap-3 p-4 rounded-xl border">
                                <template x-if="selected === correctId">
                                    <svg class="w-5 h-5 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </template>
                                <template x-if="selected !== correctId">
                                    <svg class="w-5 h-5 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </template>
                                <div>
                                    <p class="font-bold text-sm" x-text="selected === correctId ? 'Parabéns! Resposta correta!' : 'Resposta incorreta'"></p>
                                    <p class="text-xs mt-0.5 opacity-75" x-show="selected !== correctId">A alternativa correta está destacada em verde acima.</p>
                                </div>
                            </div>

                            {{-- Gabarito Comentado --}}
                            @if($questaoDodia->explanation)
                                <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-4">
                                    <div class="flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                        <span class="text-sm font-bold text-indigo-800">Gabarito Comentado</span>
                                    </div>
                                    <p class="text-sm text-indigo-900 leading-relaxed">{{ $questaoDodia->explanation }}</p>
                                </div>
                            @endif

                            {{-- Next Question Link --}}
                            <a href="{{ route('pratica.index') }}"
                               class="flex items-center justify-center gap-2 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                                Continuar praticando no Banco de Questões
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Quick Actions --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <a href="{{ route('simulado.index') }}" class="group relative bg-gradient-to-br from-indigo-600 to-indigo-700 rounded-2xl p-7 hover:shadow-xl hover:shadow-indigo-500/25 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-white/5 rounded-full -translate-y-8 translate-x-8 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-11 h-11 bg-white/20 rounded-xl flex items-center justify-center mb-5">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white mb-1.5">Simulado Cronometrado</h3>
                        <p class="text-indigo-200 text-sm">Resolva questões com timer e veja seu resultado detalhado.</p>
                        <div class="mt-5 flex items-center gap-2 text-white text-sm font-semibold">
                            Começar agora
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </div>
                    </div>
                </a>

                <a href="{{ route('desempenho.index') }}" class="group relative bg-white rounded-2xl p-7 border border-slate-100 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-50 rounded-full -translate-y-8 translate-x-8 group-hover:scale-110 transition-transform"></div>
                    <div class="relative">
                        <div class="w-11 h-11 bg-indigo-100 rounded-xl flex items-center justify-center mb-5">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 mb-1.5">Meu Desempenho</h3>
                        <p class="text-slate-500 text-sm">Acompanhe sua evolução e identifique pontos de melhoria.</p>
                        <div class="mt-5 flex items-center gap-2 text-indigo-600 text-sm font-semibold">
                            Ver relatório
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Course Selector --}}
            <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm">
                <h3 class="text-base font-bold text-slate-800 mb-0.5">Meu Curso</h3>
                <p class="text-slate-500 text-sm mb-5">Filtra questões automaticamente pelo seu curso.</p>

                @if($courses->count() > 0)
                    <form action="{{ route('dashboard.course') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                        @csrf
                        <select name="course_id" class="flex-1 rounded-xl border-slate-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm text-slate-700">
                            <option value="">Sem preferência de curso</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @selected(Auth::user()->course_id == $course->id)>
                                    {{ $course->name }} ({{ $course->questions_count }} questões)
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="shrink-0 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition">
                            Salvar
                        </button>
                    </form>
                @else
                    <div class="text-center py-8">
                        <div class="w-14 h-14 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        </div>
                        <h4 class="font-semibold text-slate-700 mb-1 text-sm">Nenhum curso cadastrado</h4>
                        <p class="text-xs text-slate-400">Execute os seeders para popular o banco de questões.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
