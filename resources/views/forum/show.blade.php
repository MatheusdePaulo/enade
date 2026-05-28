<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('forum.index') }}" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div class="min-w-0">
                <h2 class="font-bold text-xl text-slate-800 leading-tight truncate">{{ $topic->title }}</h2>
                <p class="text-slate-500 text-xs mt-0.5">
                    {{ $topic->replies->count() }} {{ $topic->replies->count() == 1 ? 'resposta' : 'respostas' }}
                    · {{ number_format($topic->views) }} views
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- Flash --}}
            @if(session('success'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tópico original --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                {{-- Header do tópico --}}
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-6 py-5">
                    <div class="flex flex-wrap gap-2 mb-2">
                        @if($topic->is_pinned)
                            <span class="text-xs font-bold text-amber-300 bg-amber-400/20 px-2.5 py-0.5 rounded-full">Fixado</span>
                        @endif
                        @if($topic->course)
                            <span class="text-xs font-semibold text-indigo-200 bg-white/15 px-2.5 py-0.5 rounded-full">{{ $topic->course->name }}</span>
                        @endif
                    </div>
                    <h1 class="text-white font-bold text-lg leading-snug">{{ $topic->title }}</h1>
                </div>

                {{-- Corpo --}}
                <div class="p-6">
                    @if($topic->question)
                        <div class="mb-4 p-3 bg-violet-50 border border-violet-200 rounded-xl">
                            <p class="text-xs font-semibold text-violet-600 mb-1">Questão vinculada</p>
                            <p class="text-sm text-violet-800 line-clamp-2">{{ Str::limit($topic->question->statement, 120) }}</p>
                            <a href="{{ route('pratica.show', $topic->question) }}"
                               class="text-xs text-violet-600 font-semibold hover:underline mt-1 inline-block">
                                Ver questão →
                            </a>
                        </div>
                    @endif

                    <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">{{ $topic->body }}</p>

                    <div class="flex items-center justify-between mt-5 pt-4 border-t border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-white font-bold text-xs">
                                {{ strtoupper(substr($topic->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700 leading-none">{{ $topic->user->name }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $topic->created_at->format('d/m/Y \à\s H:i') }}</p>
                            </div>
                        </div>

                        @if(auth()->id() === $topic->user_id || auth()->user()->is_admin)
                            <form method="POST" action="{{ route('forum.destroy', $topic) }}"
                                  onsubmit="return confirm('Remover este tópico e todas as respostas?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center gap-1.5 text-xs text-red-400 hover:text-red-600 transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    Remover tópico
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Respostas --}}
            @if($topic->replies->isNotEmpty())
                <div class="space-y-3">
                    <h3 class="text-sm font-bold text-slate-700 px-1">
                        {{ $topic->replies->count() }} {{ $topic->replies->count() == 1 ? 'Resposta' : 'Respostas' }}
                    </h3>

                    @foreach($topic->replies as $reply)
                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
                            <div class="flex items-start gap-3">
                                <div class="shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-slate-400 to-slate-600 flex items-center justify-center text-white font-bold text-xs">
                                    {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2 mb-2">
                                        <div>
                                            <span class="text-sm font-semibold text-slate-800">{{ $reply->user->name }}</span>
                                            <span class="text-xs text-slate-400 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if(auth()->id() === $reply->user_id || auth()->user()->is_admin)
                                            <form method="POST" action="{{ route('forum.replies.destroy', $reply) }}">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                        class="text-slate-300 hover:text-red-400 transition"
                                                        title="Remover resposta">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">{{ $reply->body }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Formulário de resposta --}}
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100">
                    <h3 class="font-bold text-slate-800 text-base">Sua resposta</h3>
                </div>
                <form method="POST" action="{{ route('forum.replies.store', $topic) }}" class="p-6">
                    @csrf

                    @error('body')
                        <p class="mb-3 text-sm text-red-500 bg-red-50 border border-red-200 rounded-lg px-3 py-2">{{ $message }}</p>
                    @enderror

                    <div class="flex items-start gap-3">
                        <div class="shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-white font-bold text-xs mt-1">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <textarea name="body" rows="4" required
                                      placeholder="Compartilhe seu conhecimento ou tire sua dúvida..."
                                      class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm text-slate-800 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none transition">{{ old('body') }}</textarea>
                            <div class="flex justify-end mt-3">
                                <button type="submit"
                                        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition shadow-lg shadow-indigo-500/20">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Publicar resposta
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
