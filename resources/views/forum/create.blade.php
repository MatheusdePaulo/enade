<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('forum.index') }}" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-bold text-xl text-slate-800 leading-tight">Novo Tópico</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('forum.store') }}" class="space-y-5">
                @csrf

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-5">

                    {{-- Título --}}
                    <div>
                        <label for="title" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            Título do tópico <span class="text-red-400">*</span>
                        </label>
                        <input id="title" type="text" name="title" value="{{ old('title') }}"
                               required placeholder="Ex: Dúvida sobre Deadlock no ENADE 2021..."
                               class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('title') border-red-400 @enderror">
                    </div>

                    {{-- Curso + Questão --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="course_id" class="block text-sm font-semibold text-slate-700 mb-1.5">Área / Curso</label>
                            <select id="course_id" name="course_id"
                                    class="w-full rounded-xl border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Geral (sem curso específico)</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" @selected(old('course_id') == $course->id)>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="question_id" class="block text-sm font-semibold text-slate-700 mb-1.5">
                                Vincular a uma questão
                                <span class="text-slate-400 font-normal">(opcional)</span>
                            </label>
                            <select id="question_id" name="question_id"
                                    class="w-full rounded-xl border-slate-200 text-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Nenhuma</option>
                                @foreach($questions as $q)
                                    <option value="{{ $q->id }}" @selected(old('question_id') == $q->id)>
                                        #{{ $q->id }} — {{ Str::limit($q->statement, 50) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Corpo --}}
                    <div>
                        <label for="body" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            Descreva sua dúvida ou assunto <span class="text-red-400">*</span>
                        </label>
                        <textarea id="body" name="body" rows="8" required
                                  placeholder="Explique detalhadamente sua dúvida, o que você já tentou entender, ou inicie um debate sobre o tema..."
                                  class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none transition @error('body') border-red-400 @enderror">{{ old('body') }}</textarea>
                        <p class="text-xs text-slate-400 mt-1">Mínimo de 10 caracteres.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl text-sm transition shadow-lg shadow-indigo-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Publicar Tópico
                    </button>
                    <a href="{{ route('forum.index') }}" class="text-sm text-slate-400 hover:text-slate-600 transition">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
