<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CertificateApiController;
use App\Http\Controllers\Api\V1\EventApiController;
use App\Http\Controllers\Api\V1\MemberApiController;
use App\Http\Controllers\Api\V1\PostApiController;
use App\Http\Controllers\Api\V1\PrerogativeApiController;
use App\Models\OfficialDocument;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes — Instituto MAR (Mobile App Integration V1)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {

    // Autenticação Mobile
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout']);
        Route::get('/auth/me', [AuthController::class, 'me']);
    });

    // Simpósios & Cursos
    Route::get('/events', [EventApiController::class, 'index']);
    Route::get('/events/{id}', [EventApiController::class, 'show']);
    Route::post('/events/{id}/register', [EventApiController::class, 'register']);

    // Notícias & Imprensa
    Route::get('/posts', [PostApiController::class, 'index']);
    Route::get('/posts/{id}', [PostApiController::class, 'show']);

    // Atos e Documentos Oficiais
    Route::get('/documents', function () {
        return response()->json([
            'success' => true,
            'data' => OfficialDocument::orderBy('data_publicacao', 'desc')->get(),
        ]);
    });

    // Plantão Emergencial de Prerrogativas 24h
    Route::post('/prerogatives/claim', [PrerogativeApiController::class, 'claim']);
    Route::get('/prerogatives/my-claims', [PrerogativeApiController::class, 'myClaims']);

    // Carteirinha Digital do Associado
    Route::get('/member/card', [MemberApiController::class, 'card']);

    // Validador de Certificados (Scanner QR Code)
    Route::get('/certificates/verify/{code}', [CertificateApiController::class, 'verify']);

    Route::get('/representantes/home', [MemberApiController::class, 'home']);

});
