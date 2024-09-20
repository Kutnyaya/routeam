<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search', [SearchController::class, 'search'])->name('search');


Route::post('/api/find', [SearchApiController::class, 'find']);
Route::get('/api/find', [SearchApiController::class, 'find']);
Route::delete('/api/find/{search}', [SearchApiController::class, 'delete']);
