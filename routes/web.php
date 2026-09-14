<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\XController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClanController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\PartnerController;

Route::get('/api/csrf', [AuthController::class,'csrf']);
Route::get('/api/home', [PublicController::class,'home']);
Route::get('/api/posts', [PublicController::class,'posts']);
Route::get('/api/posts/{slug}', [PublicController::class,'post']);
Route::get('/api/payments', [PublicController::class,'payments']);
Route::get('/api/clans', [PublicController::class,'clans']);
Route::get('/api/practice', [PublicController::class,'practice']);
Route::get('/api/partners', [PublicController::class,'partners']);
Route::post('/api/contact', [ContactController::class,'store']);
Route::get('/api/x-posts', [XController::class,'index']);
Route::post('/api/admin/login', [AuthController::class,'login']);
Route::get('/api/admin/me', [AuthController::class,'me']);
Route::post('/api/admin/logout', [AuthController::class,'logout']);

Route::middleware('admin')->prefix('api/admin')->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::apiResource('/posts', AdminPostController::class)->except(['show']);
    Route::get('/messages', [ContactController::class,'index']);
    Route::post('/messages/{contactMessage}/read', [ContactController::class,'read']);
    Route::get('/payments', [PaymentController::class,'index']);
    Route::put('/payments/{paymentSetting}', [PaymentController::class,'update']);
    Route::get('/settings', [SettingsController::class,'show']);
    Route::put('/settings', [SettingsController::class,'update']);
    Route::post('/x/sync', [XController::class,'sync']);
    Route::get('/clans', [ClanController::class,'adminIndex']);
    Route::post('/clans', [ClanController::class,'store']);
    Route::post('/clans/{clan}', [ClanController::class,'update']);
    Route::delete('/clans/{clan}', [ClanController::class,'destroy']);
    Route::get('/practice', [PracticeController::class,'adminIndex']);
    Route::post('/practice', [PracticeController::class,'store']);
    Route::put('/practice/{practiceResource}', [PracticeController::class,'update']);
    Route::delete('/practice/{practiceResource}', [PracticeController::class,'destroy']);
    Route::get('/partners', [PartnerController::class,'adminIndex']);
    Route::post('/partners', [PartnerController::class,'store']);
    Route::post('/partners/{partner}', [PartnerController::class,'update']);
    Route::delete('/partners/{partner}', [PartnerController::class,'destroy']);
});

Route::view('/{any?}', 'app')->where('any','.*');
