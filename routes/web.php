<?php

use App\Http\Controllers\contatoController;
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


Route::get('/', [contatoController::class, 'index'])->name('contato.index');
Route::post('contato/store', [contatoController::class, 'store'])->name('contato.store');
Route::post('contato/buscaCep', [contatoController::class, 'buscaCep'])->name('contato.buscaCep');