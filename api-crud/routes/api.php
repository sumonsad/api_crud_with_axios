<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/posts',[PostController::class,'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/post/{id}', [PostController::class, 'show']);
