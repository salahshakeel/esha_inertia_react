<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('book_categories', \App\Http\Controllers\BookCategoryController::class);
    Route::get('categories/{category}/books', [\App\Http\Controllers\BookCategoryController::class, 'BookIndex'])->name('categories.books');
});