<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-slate-800 leading-tight">Modo Prática</h2>
            <a href="{{ route('pratica.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Próxima questão
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Filters Bar --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
                <form action="{{ route('pratica.index') }}" method="GET" class="flex flex-wrap gap-3 items-end">
                    <div class="flex-1 min-w-[140px]">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Curso</label>
                        <select name="course_id" class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Todos</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @selected($activeCourseId == $course->id)>{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-[120px]">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Componente</label>
                        <select name="component" class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Todos</option>
                            <option value="Geral" @selected(request('component') == 'Geral')>Geral</option>
                            <option value="Específico" @selected(request('component') == 'Específico')>Específico</option>
                        </select>
                    </div>
                    <div class="flex-1 min-w-[100px]">
                        <label class="block text-xs font-semibold text-slate-500 mb-1">Ano</label>
                        <select name="year" class="w-full rounded-lg border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Todos</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" @selected(request('year') == $year)>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition">
                        Filtrar
                    </button>
                </form>
            </div>

            @if($question)
                {{-- Question Card with Alpine.js for immediate feedback --}}
                <div x-data="{
                    answered: false,
                    selected: null,
                    correct: null,
                    choose(altId, isCorrect) {
                        if (this.answered) return;
                        this.answered = true;
                        this.selected = altId;
                        this.correct = @json($question->alternatives->firstWhere('is_correct', true)?->id ?? null);
                    },
                    getClass(altId, isCorrect) {
                        if (!this.answered) return 'border-slate-200 hover:border-indigo-400 hover:bg-indigo-50 cursor-pointer';
                        if (isCorrect) return 'border-green-500 bg-green-50';
                        if (altId === this.selected && !isCorrect) return 'border-red-400 bg-red-50';
                        return 'border-slate-200 opacity-60';
                    }
                }" class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

                    {{-- Question Header --}}
                    <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-8 py-5">
                        <div class="flex items-center gap-3 text-indigo-200 text-sm mb-2">
                            <span class="bg-white/20 px-2 py-0.5 rounded text-xs font-semibold">{{ $question->course->name ?? 'Geral' }}</span>
                            <span>•</span>
                            <span>{{ $question->component }}</span>
                            <span>•</span>
                            <span>ENADE {{ $question->year }}</span>
                        </div>
                        <p class="text-white font-semibold text-base leading-relaxed">{{ $question->statement }}</p>
                    </div>

                    {{-- Alternatives --}}
                    <div class="p-8 space-y-3">
                        @php $letters = ['A', 'B', 'C', 'D', 'E']; @endphp
                        @foreach($question->alternatives as $i => $alt)
                            <div
                                @click="choose({{ $alt->id }}, {{ $alt->is_correct ? 'true' : 'false' }})"
                                :class="getClass({{ $alt->id }}, {{ $alt->is_correct ? 'true' : 'false' }})"
                                class="flex items-start gap-4 p-4 rounded-xl border-2 transition-all duration-200 select-none"
                            >
                                <div class="shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold"
                                     :class="{
                                         'bg-indigo-100 text-indigo-700': !answered,
                                         'bg-green-500 text-white': answered && {{ $alt->is_correct ? 'true' : 'false' }},
                                         'bg-red-400 text-white': answered && selected === {{ $alt->id }} && !{{ $alt->is_correct ? 'true' : 'false' }},
                                         'bg-slate-100 text-slate-400': answered && selected !== {{ $alt->id }} && !{{ $alt->is_correct ? 'true' : 'false' }}
                                     }">
                                    {{ $letters[$i] ?? $i + 1 }}
                                </div>
                                <span class="text-slate-700 text-sm leading-relaxed pt-0.5">{{ $alt->text }}</span>

                                {{-- Feedback icon --}}
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

                    {{-- Feedback Banner --}}
                    <div x-show="answered" x-transition class="px-8 pb-8 space-y-4">
                        <div :class="selected === correct ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800'"
                             class="flex items-center gap-3 p-4 rounded-xl border">
                            <template x-if="selected === correct">
                                <svg class="w-6 h-6 text-green-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </template>
                            <template x-if="selected !== correct">
                                <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </template>
                            <div>
                                <p class="font-bold text-sm" x-text="selected === correct ? 'Parabéns! Você acertou!' : 'Não foi dessa vez...'"></p>
                                <p class="text-xs mt-0.5 opacity-80" x-show="selected !== correct">A alternativa correta está destacada em verde acima.</p>
                            </div>
                        </div>

                        {{-- Gabarito Comentado --}}
                        @if($question->explanation)
                            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-4 h-4 text-indigo-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                    </svg>
                                    <span class="text-sm font-bold text-indigo-800">Gabarito Comentado</span>
                                </div>
                                <p class="text-sm text-indigo-900 leading-relaxed">{{ $question->explanation }}</p>
                            </div>
                        @endif

                        {{-- Next Question Button --}}
                        <a href="{{ route('pratica.index', array_filter(['course_id' => request('course_id'), 'component' => request('component'), 'year' => request('year')])) }}"
                           class="flex items-center justify-center gap-2 w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            Próxima Questão
                        </a>
                    </div>
                </div>

            @else
                {{-- Empty State --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-16 text-center">
                    <div class="w-20 h-20 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Nenhuma questão encontrada</h3>
                    <p class="text-slate-500 mb-8 max-w-md mx-auto">
                        Ainda não há questões cadastradas com os filtros selecionados. Tente ajustar os filtros ou aguarde o cadastro de novas questões.
                    </p>
                    <a href="{{ route('pratica.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition">
                        Limpar filtros
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
