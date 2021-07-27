<?php

use App\Http\Controllers\GarbageCanController;
use App\Http\Controllers\Note;
use App\Http\Controllers\NoteController;
use App\Models\Notes;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::prefix('note')->group(function () {
    Route::post('store', [NoteController::class, 'store']);
    Route::get('index', [NoteController::class, 'index']);
    Route::delete('delete/{id}', [NoteController::class, 'destroy']);
    Route::put('updateFixed/{id}/{type}', [NoteController::class, 'updateFixed']);
    Route::put('changeBgColor/{id}', [NoteController::class, 'changeBgColor']);

    Route::get('getLabel', [NoteController::class, 'getLabel']);
    Route::post('addLabel', [NoteController::class, 'addLabel']);
    Route::put('updateNoteLabel/{id}/{label}', [NoteController::class, 'updateNoteLabel']);
});

Route::prefix('garbageCan')->group(function () {
    Route::get('/', function () {
        return view('garbageCan');
    });
    Route::get('index', [GarbageCanController::class, 'index']);
    Route::put('recovery/{id}', [GarbageCanController::class, 'recovery']);
});
