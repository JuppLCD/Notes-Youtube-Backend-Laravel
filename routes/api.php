<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\NoteListController;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/valid_token', [AuthController::class, 'validToken']);


    Route::apiResource('notes', NoteController::class);
    Route::apiResource('lists', NoteListController::class);

    Route::get('notes/idYTVideo/{idYTVideo}', [NoteController::class, 'getNotesByIdYTVideo']);
    Route::post('notes/{note}/lists/{noteList}', [NoteController::class, 'addNoteInNoteList']);
});
