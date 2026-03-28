<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

Route::post('/chat', [ChatController::class, 'chat']);
Route::get('/projects', [ProjectController::class, 'index']);
