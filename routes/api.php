<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    //
});

Route::get('/books/search', [BookController::class, 'search'])->name('books.search');
Route::apiResource('/books', BookController::class);
