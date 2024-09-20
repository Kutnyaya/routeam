<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchApiController;

Route::post('/find', [SearchApiController::class, 'find']);
Route::get('/find', [SearchApiController::class, 'find']);
Route::delete('/find/{search}', [SearchApiController::class, 'delete']);

