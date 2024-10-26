<?php

use App\Http\Controllers\Public\NewsController;
use App\Http\Controllers\Public\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//WorkController
Route::get('/our-work/all', [WorkController::class, 'getAll']);
Route::get('/our-work/three-only', [WorkController::class, 'getFirstThree']);
Route::get('/our-work/record', [WorkController::class, 'get']);

//NewsController
Route::get('/news/all', [NewsController::class, 'getAll']);
Route::get('/news/three-only', [NewsController::class, 'getFirstThree']);
Route::get('/news/record', [NewsController::class, 'get']);
