<?php

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
});
