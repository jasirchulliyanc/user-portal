<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


Route::get('/user', [Api\UserController::class, 'index']);
Route::post('/user/create', [Api\UserController::class, 'store']);
Route::post('/user/edit', [Api\UserController::class, 'update']);
Route::delete('/user/{user}/delete', [Api\UserController::class, 'destroy']);