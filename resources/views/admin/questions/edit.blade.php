<x-admin-layout>
    <x-slot name="title">Editar Questão #{{ $question->id }}</x-slot>
    <x-slot name="subtitle">Alterar enunciado, alternativas e configurações</x-slot>

    <div class="max-w-3xl">
        <form method="POST" action="{{ route('admin.questions.update', $question) }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Errors --}}
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 text-sm text-red-400 space-y-1">
                    @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- Dados --}}
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-4">
                <h3 class="text-white font-semibold text-sm uppercase tracking-wider">Dados da Questão</h3>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1.5">Enunciado <span class="text-red-400">*</span></label>
                    <textarea name="statement" rows="5"
                              class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 resize-none">{{ old('statement', $question->statement) }}</textarea>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="col-span-2">
                        <label class="block text-xs font-semibold text-slate-400 mb-1.5">Curso <span class="text-red-400">*</span></label>
                        <select name="course_id" class="w-full bg-slate-900 border border-slate-600 rounded-xl px-3 py-2.5 text-sm text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" @selected(old('course_id', $question->course_id) == $course->id)>{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1.5">Componente <span class="text-red-400">*</span></label>
                        <select name="component" class="w-full bg-slate-900 border border-slate-600 rounded-xl px-3 py-2.5 text-sm text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                            <option value="Geral"      @selected(old('component', $question->component) === 'Geral')>Geral</option>
                            <option value="Específico" @selected(old('component', $question->component) === 'Específico')>Específico</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 mb-1.5">Ano <span class="text-red-400">*</span></label>
                        <input type="number" name="year" value="{{ old('year', $question->year) }}" min="2000" max="2035"
                               class="w-full bg-slate-900 border border-slate-600 rounded-xl px-3 py-2.5 text-sm text-slate-100 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-400 mb-1.5">Gabarito Comentado</label>
                    <textarea name="explanation" rows="3"
                              class="w-full bg-slate-900 border border-slate-600 rounded-xl px-4 py-3 text-sm text-slate-100 placeholder-slate-600 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 resize-none"
                              placeholder="Explique por que a alternativa correta está certa...">{{ old('explanation', $question->explanation) }}</textarea>
                </div>

                <div class="flex items-center gap-6 pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1"
                               @checked(old('is_featured', $question->is_featured))
                               class="w-4 h-4 rounded border-slate-600 bg-slate-900 text-amber-500 focus:ring-amber-500">
                        <span class="text-sm text-slate-300">Destacar na <span class="text-amber-400 font-semibold">Prática Rápida</span></span>
                    </label>
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-semibold text-slate-400">Ordem</label>
                        <input type="number" name="order" value="{{ old('order', $question->order) }}" min="0"
                               class="w-20 bg-slate-900 border border-slate-600 rounded-lg px-2 py-1.5 text-sm text-slate-100 text-center focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    </div>
                </div>
            </div>

            {{-- Alternativas --}}
            <div class="bg-slate-800 border border-slate-700 rounded-2xl p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-white font-semibold text-sm uppercase tracking-wider">Alternativas</h3>
                    <p class="text-xs text-slate-500">Selecione o botão à esquerda para marcar a correta</p>
                </div>

                @php
                    $letters = ['A','B','C','D','E'];
                    $alts    = $question->alternatives->values();
                    $correctIndex = $alts->search(fn($a) => $a->is_correct);
                @endphp
                <div class="space-y-3">
                    @for($i = 0; $i < 5; $i++)
                        @php $alt = $alts[$i] ?? null; @endphp
                        <div class="flex items-center gap-3 p-3 bg-slate-900/60 rounded-xl border border-slate-700 hover:border-slate-600 transition">
                            <input type="radio" name="correct_alternative" value="{{ $i }}"
                                   @checked(old('correct_alternative', $correctIndex) == $i)
                                   class="w-4 h-4 text-emerald-500 bg-slate-800 border-slate-600 focus:ring-emerald-500 shrink-0 cursor-pointer">
                            <div class="w-7 h-7 rounded-lg bg-slate-700 flex items-center justify-center text-xs font-bold text-slate-300 shrink-0">
                                {{ $letters[$i] }}
                            </div>
                            <input type="text" name="alternatives[{{ $i }}][text]"
                                   value="{{ old('alternatives.'.$i.'.text', $alt?->text) }}"
                                   placeholder="Texto da alternativa {{ $letters[$i] }}..."
                                   class="flex-1 bg-transparent border-0 text-sm text-slate-200 placeholder-slate-600 focus:ring-0 focus:outline-none">
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center gap-4">
                <button type="submit"
                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shadow-lg shadow-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Salvar Alterações
                </button>
                <a href="{{ route('admin.dashboard') }}" class="text-sm text-slate-400 hover:text-slate-200 transition">
                    Cancelar
                </a>
                <form method="POST" action="{{ route('admin.questions.destroy', $question) }}"
                      class="ml-auto" onsubmit="return confirm('Remover esta questão permanentemente?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 text-red-400 hover:text-red-300 text-sm font-medium transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Remover questão
                    </button>
                </form>
            </div>
        </form>
    </div>
</x-admin-layout>
