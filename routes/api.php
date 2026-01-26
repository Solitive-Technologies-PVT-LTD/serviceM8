<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceM8WebhookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ServiceM8 Webhook Routes (Public - ServiceM8 will call these)
Route::post('/servicem8/webhook', [ServiceM8WebhookController::class, 'handle'])->name('servicem8.webhook');
Route::get('/servicem8/webhook/test', [ServiceM8WebhookController::class, 'test'])->name('servicem8.webhook.test');
