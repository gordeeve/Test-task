<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::any('auth', [AuthController::class, 'auth']);
Route::any('test', function (){
    return 'ok';
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class);
    Route::post('tasks/{id}/set-done', [TaskController::class, 'setTaskDone']);
});

