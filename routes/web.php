<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DesempenhoController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SimuladoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ── Área do Estudante ──────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/curso', [DashboardController::class, 'selectCourse'])->name('dashboard.course');

    Route::get('/pratica',           [QuestionController::class, 'index'])->name('pratica.index');
    Route::get('/pratica/{question}',[QuestionController::class, 'show'])->name('pratica.show');

    Route::get('/simulado',                              [SimuladoController::class, 'index'])->name('simulado.index');
    Route::post('/simulado/iniciar',                     [SimuladoController::class, 'iniciar'])->name('simulado.iniciar');
    Route::get('/simulado/resultado',                    [SimuladoController::class, 'resultado'])->name('simulado.resultado');
    Route::get('/simulado/questao/{index}',              [SimuladoController::class, 'show'])->name('simulado.show')->where('index', '[0-9]+');
    Route::post('/simulado/questao/{index}/responder',   [SimuladoController::class, 'responder'])->name('simulado.responder')->where('index', '[0-9]+');

    Route::get('/desempenho', [DesempenhoController::class, 'index'])->name('desempenho.index');
    Route::get('/forum',      [ForumController::class,      'index'])->name('forum.index');
    Route::get('/historico',  [HistoricoController::class,  'index'])->name('historico.index');

    Route::get('/profile',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',  [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ── Área Administrativa ────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/questions/create',         [Admin\QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions',               [Admin\QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}/edit',[Admin\QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}',     [Admin\QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}',  [Admin\QuestionController::class, 'destroy'])->name('questions.destroy');
    Route::patch('/questions/{question}/toggle-featured', [Admin\QuestionController::class, 'toggleFeatured'])->name('questions.toggle-featured');
});

Route::get('/setup-admin', function () {
    $user = \App\Models\User::create([
        'name' => 'Admin',
        'email' => 'adminenade@admin.com',
        'password' => bcrypt('admin123'),
        'is_admin' => true,
    ]);
    return 'Admin criado com sucesso!';
});

require __DIR__.'/auth.php';
