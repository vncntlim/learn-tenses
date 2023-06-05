<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TensesController;
use App\Http\Controllers\VerbController;

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
    return Inertia::render('GenerateTenses');
})->name('generate-tenses');

Route::get('/spell-check/{word?}', [TensesController::class, 'spellCheck'])->name('spell-check');

Route::post('/process-verb', [TensesController::class, 'conjugate'])->name('process-verb');

Route::resource('verbs', VerbController::class)->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
