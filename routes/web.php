<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;

Route::get('/notes', [NoteController::class, 'index'])->name('all');
Route::get('/notes/statistiques', [NoteController::class, 'statistiques']);
Route::get('/notes/show', [NoteController::class, 'show'])->name('show');
Route::get('/notes/decorate', [NoteController::class, 'decorate']);


Route::get('/', function () {
    return view('welcome');
});