<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CopyController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('categories', CategoryController::class);

    Route::get('/search/books', [BookController::class, 'search']);
    Route::get('/books/recent/arrivals', [BookController::class, 'getNewArrivals']);
    Route::get('/categories/{category_slug}/books/{book_slug}', [BookController::class, 'showBySlug']);

    Route::apiResource('books', BookController::class);

    Route::post('/copies', [CopyController::class, 'store']);
    Route::patch('/copies/{id}/status', [CopyController::class, 'updateStatus']);
    Route::get('/books/{bookId}/degraded-copies', [CopyController::class, 'getDegradedByBook']);
});


Route::get('/test', function () {
        return 'working';
    });
