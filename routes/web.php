<?php

use App\Http\Controllers\AssociationController;
use App\Http\Controllers\BoardMemberController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OfficialDocumentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrerogativeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Instituto MAR (Laravel 11 Portal & Admin)
|--------------------------------------------------------------------------
*/

// Rotas Públicas do Portal
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/diretoria-e-comissoes', [BoardMemberController::class, 'diretoria'])->name('diretoria');
Route::get('/representantes', [BoardMemberController::class, 'representantes'])->name('representantes');
Route::get('/membros-honorarios', [BoardMemberController::class, 'membrosHonorarios'])->name('membros-honorarios');

// Notícias
Route::get('/noticias', [PostController::class, 'index'])->name('noticias');
Route::get('/noticias/{slug}', [PostController::class, 'show'])->name('noticia.show');

// Atos e Notas
Route::get('/notas-e-atos-oficiais', [OfficialDocumentController::class, 'index'])->name('notas-oficiais');

// Cursos e Eventos
Route::get('/cursos-e-palestras', [EventController::class, 'index'])->name('cursos');
Route::get('/cursos-e-palestras/{slug}', [EventController::class, 'show'])->name('curso.show');
Route::post('/cursos-e-palestras/inscrever', [EventController::class, 'register'])->name('cursos.inscrever');
Route::post('/api/inscrever', [EventController::class, 'register'])->name('api.inscrever');

// Associação e Atendimento
Route::get('/seja-um-associado', [AssociationController::class, 'index'])->name('associar');
Route::post('/seja-um-associado', [AssociationController::class, 'store'])->name('associar.store');

Route::get('/contato', function () {
    return view('contato');
})->name('contato');
Route::post('/contato', [ContactController::class, 'store'])->name('contato.store');

// Plantão de Prerrogativas 24h
Route::get('/prerrogativas', [PrerogativeController::class, 'index'])->name('prerrogativas');
Route::post('/prerrogativas', [PrerogativeController::class, 'store'])->name('prerrogativas.store');

// Conformidade Legal
Route::get('/politica-de-privacidade', function () {
    return view('politica-de-privacidade');
})->name('politica-privacidade');

Route::get('/termos-de-uso', function () {
    return view('termos-de-uso');
})->name('termos-uso');

// Área do Membro & Certificados
Route::get('/membro/carteirinha', [MemberController::class, 'card'])->name('membro.carteirinha');
Route::get('/certificados/validar', [CertificateController::class, 'validateCode'])->name('certificados.validar');

// Suporte a submissão POST direta em /admin/login
Route::post('/admin/login', function (Request $request) {
    $email = $request->input('email', $request->input('usuario', $request->input('user')));
    $password = $request->input('password', $request->input('senha'));

    if ($email === 'admin') {
        $email = 'admin@institutomar.org.br';
    }

    if (Auth::attempt(['email' => $email, 'password' => $password])) {
        $request->session()->regenerate();

        return redirect()->intended('/admin');
    }

    return back()->withErrors([
        'email' => 'Credenciais de acesso incorretas.',
    ]);
});

// Aliases de compatibilidade para chamadas legadas de rota
Route::get('/admin/login-alias', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('admin.login');

Route::get('/admin/dashboard-alias', function () {
    return redirect()->route('filament.admin.pages.dashboard');
})->name('admin.dashboard');
