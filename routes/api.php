<?php

use App\Http\Controllers\Api\Admin\NoteController as AdminNoteController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\User\NoteController as UserNoteController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::middleware(['auth:api', 'admin'])->prefix('admin')->group(function () {
    Route::apiResource('notes', AdminNoteController::class);
});

Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('notes', UserNoteController::class);
});
