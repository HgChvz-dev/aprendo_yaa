<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', [App\Http\Controllers\FrontController::class, 'index']);
// home/ln2Zo6SVnZFQlJVQppmUlZ+jXFCZnqSVl6KLnUpb

Auth::routes(); 
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/{id_cc}', [App\Http\Controllers\HomeController::class, 'buscar'])->name('home.buscar');
Route::post('/store', [App\Http\Controllers\HomeController::class, 'store'])->name('home.store');
Route::get('/certifica/{id_cur}',[App\Http\Controllers\HomeController::class, 'certifica'])->name('certifica');

Auth::routes();
Route::get('/quiz/{id_lc}',[App\Http\Controllers\QuizController::class, 'index']);
Route::get('/evaluando/{id_ev}',[App\Http\Controllers\QuizController::class, 'evaluando']);
Route::get('/final/{datofinal}',[App\Http\Controllers\QuizController::class, 'final'])->name('quiz.final');

// Route::get('/quiz/{id_lc}', [App\Http\Controllers\QuizController::class,'evaluar']);
// Route::post('/home', [App\Http\Controllers\HomeController::class, 'buscar']);

// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
