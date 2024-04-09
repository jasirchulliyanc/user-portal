<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


Route::get('/user/{role}', [Api\UserController::class, 'index']);
Route::get('/users/{id}', [Api\UserController::class, 'getUser']);
Route::post('/user/create', [Api\UserController::class, 'store']);
Route::post('/user/edit', [Api\UserController::class, 'update']);
Route::delete('/user/{user}/delete', [Api\UserController::class, 'destroy']);
Route::post('/login', [Api\UserController::class, 'login']);
