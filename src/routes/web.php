<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Manager\Competencia\CompetenciaController;
use App\Http\Controllers\Manager\Afirmation\AfirmationController;
use App\Http\Controllers\Manager\Afirmation\ImportController;
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
    ->name('competencia')
    ->middleware('auth');

Route::get('/competencia/list', [CompetenciaController::class, 'list'])
    ->name('competencia.list')
    ->middleware('auth');

Route::get('/competencia/create', [CompetenciaController::class, 'create'])
    ->name('competencia.create')
    ->middleware('auth');
    
Route::post('/competencia', [CompetenciaController::class, 'store'])
    ->name('competencia.store')
    ->middleware('auth');


Route::get('competencia/{competencia}/edit', [CompetenciaController::class, 'edit'])
    ->name('competencia.edit')
    ->middleware('auth');  

Route::put('competencia/{competencia}', [CompetenciaController::class, 'update'])
    ->name('competencia.update')
    ->middleware('auth');

Route::delete('competencia/{competencia}', [CompetenciaController::class, 'destroy'])
    ->name('competencia.destroy')
    ->middleware('auth');

Route::get('/competencia/import', [CompetenciaController::class, 'import'])
    ->name('competencia.import')
    ->middleware('auth');  

Route::post('/competencia/importfile', [CompetenciaController::class, 'importfile'])
    ->name('competencia.importfile')
    ->middleware('auth');   



    //Afirmaciones
Route::get('/afirmation', [AfirmationController::class, 'index'])
    ->name('afirmation')
    ->middleware('auth');

Route::get('/afirmation/list', [AfirmationController::class, 'list'])
    ->name('afirmation.list')
    ->middleware('auth');

Route::get('/afirmation/create', [AfirmationController::class, 'create'])
    ->name('afirmation.create')
    ->middleware('auth');

Route::post('/afirmation', [AfirmationController::class, 'store'])
    ->name('afirmation.store')
    ->middleware('auth');    

Route::get('/afirmation/import', [ImportController::class, 'import'])
    ->name('afirmation.import')
    ->middleware('auth');  

Route::post('/afirmation/importfile', [ImportController::class, 'importfile'])
    ->name('afirmation.importfile')
    ->middleware('auth');   

Route::get('afirmation/{afirmation}/edit', [AfirmationController::class, 'edit'])
    ->name('afirmation.edit')
    ->middleware('auth');  

Route::put('afirmation/{afirmation}', [AfirmationController::class, 'update'])
    ->name('afirmation.update')
    ->middleware('auth');

Route::delete('afirmation/{afirmation}', [AfirmationController::class, 'destroy'])
    ->name('afirmation.destroy')
    ->middleware('auth');


    //Capsulas
Route::get('/capsule', [CapsuleController::class, 'index'])
    ->name('capsule')
    ->middleware('auth');

Route::get('/capsule/create', [CapsuleController::class, 'create'])
    ->name('capsule.create')
    ->middleware('auth');

Route::post('/capsule', [CapsuleController::class, 'store'])
    ->name('capsule.store')
    ->middleware('auth');    

Route::post('/capsule/{id}/edit', [CapsuleController::class, 'edit'])
    ->name('capsule.edit')
    ->middleware('auth');   
    
Route::get('/capsule/list', [CapsuleController::class, 'list'])
    ->name('capsule.list')
    ->middleware('auth');

Route::delete('/capsule/{id}', [CapsuleController::class, 'destroy'])
    ->name('capsule.destroy')
    ->middleware('auth');

    //Web
Route::get('/', [HomeController::class, 'index'])
    ->name('home');    

    //Web
Route::get('/quiz/{competencias}', [QuizController::class, 'index'])
    ->name('quiz');        

Route::post('/quiz/calculate', [QuizController::class, 'calculate'])
    ->name('quiz.calculate');        

Route::get('/result', [QuizController::class, 'result'])
    ->name('result');        