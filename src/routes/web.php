<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Manager\Competencia\CompetenciaController;
use App\Http\Controllers\Manager\Afirmation\AfirmationController;
use App\Http\Controllers\Manager\Capsule\CapsuleController;
use App\Http\Controllers\Manager\Dashboard\DashboardController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\QuizController;
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

    //Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

    //Competencias
Route::get('/competencia', [CompetenciaController::class, 'index'])
    ->name('competencia.list')
    ->middleware('auth');

Route::get('/competencia/create', [CompetenciaController::class, 'create'])
    ->name('competencia.create')
    ->middleware('auth');
    
Route::post('/competencia', [CompetenciaController::class, 'store'])
    ->name('competencia.store')
    ->middleware('auth');

    //Afirmaciones
Route::get('/afirmation', [AfirmationController::class, 'index'])
    ->name('afirmation.list')
    ->middleware('auth');

Route::get('/afirmation/create', [AfirmationController::class, 'create'])
    ->name('afirmation.create')
    ->middleware('auth');

Route::post('/afirmation', [AfirmationController::class, 'store'])
    ->name('afirmation.store')
    ->middleware('auth');    

    //Capsulas
Route::get('/capsule', [CapsuleController::class, 'index'])
    ->name('capsule.list')
    ->middleware('auth');

Route::get('/capsule/create', [CapsuleController::class, 'create'])
    ->name('capsule.create')
    ->middleware('auth');

Route::post('/capsule', [CapsuleController::class, 'store'])
    ->name('capsule.store')
    ->middleware('auth');    

    
    //Web
Route::get('/', [HomeController::class, 'index'])
    ->name('home');    

    //Web
Route::get('/quiz', [QuizController::class, 'index'])
    ->name('quiz');        