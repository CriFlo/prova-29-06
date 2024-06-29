<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

Route::middleware(CheckApiKey::class)->group(function () {
    Route::group(['prefix' => 'authors'], function () {
        Route::get('/', AuthorController::class . '@index');
        Route::post('/', AuthorController::class . '@store');
        Route::get('/{id}', AuthorController::class . '@show');
        Route::put('/{id}', AuthorController::class . '@update');
        Route::delete('/{id}', AuthorController::class . '@destroy');
    });

    Route::group(['prefix' => 'books'], function () {
        Route::get('/', BookController::class . '@index');
        Route::post('/', BookController::class . '@store');
        Route::get('/{id}', BookController::class . '@show');
        Route::put('/{id}', BookController::class . '@update');
        Route::delete('/{id}', BookController::class . '@destroy');
    });
});

