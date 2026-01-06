<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\SearchController;

Route::get('/', [BookController::class, 'index']);//api fullsach
Route::get('/search', [SearchController::class, 'apiSearch']);//apitimkiem