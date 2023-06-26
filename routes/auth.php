<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/', [TaskController::class, 'index'])->name('index');
    Route::controller(TaskController::class)->prefix('task')->group(function () {
        Route::get('/', 'show')->name('show');
        Route::post('/store', 'store')->name('store');

        Route::name('task.')->group(function () {
            Route::delete('delete', 'delete')->name('delete');
            Route::prefix('{task}')->group(function () {
                Route::patch('updateStatus', 'updateStatus')->name('updateStatus');
            });
        });
    });
});
