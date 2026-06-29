<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlueprintController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(BlueprintController::class)->prefix('/blueprints')->group(function () {
        Route::get('/', 'index')->name('blueprints.index');
        Route::post('/store', 'store')->name('blueprints.store');
        Route::get('/archived', 'archived')->name('blueprints.archived');
        Route::get('/{blueprint}', 'show')->name('blueprints.show');
        Route::put('/{blueprint}/update', 'update')->name('blueprints.update');
        Route::delete('/{blueprint}/archive', 'archive')->name('blueprints.archive');
        Route::post('/{blueprint}/restore', 'restore')->name('blueprints.restore')->withTrashed();
        Route::delete('/{blueprint}/forceDelete', 'forceDelete')->name('blueprints.forceDelete')->withTrashed();
    });

});
