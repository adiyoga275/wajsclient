<?php

use App\Http\Controllers\Api\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('message', [MessageController::class, 'store']);
Route::get('message-by-contact/{phone}', [MessageController::class, 'messageByPhone']);
Route::get('recent-message', [MessageController::class, 'recentMessage']);
Route::post('send-message', [MessageController::class, 'sendMessage']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
