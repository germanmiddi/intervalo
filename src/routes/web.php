<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Manager\Competencia\CompetenciaController;
use App\Http\Controllers\Manager\Afirmation\AfirmationController;
use App\Http\Controllers\Manager\Afirmation\ImportController;
use App\Http\Controllers\Manager\Capsule\CapsuleController;
use App\Http\Controllers\Manager\Companie\CompanieController;
use App\Http\Controllers\Manager\Dashboard\DashboardController;
use App\Http\Controllers\Manager\Test\TestController as TestManagerController;
use App\Http\Controllers\Manager\User\UserController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\QuizController;
use App\Http\Controllers\Web\TestController;
use Illuminate\Support\Facades\Mail;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

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

//************************** */
// RUTAS PUBLICAS
//************************** */

/* Route::get('/login', [AuthenticatedSessionController::class, 'create'])
            ->middleware(['guest:'.config('fortify.guard')])
            ->name('login'); */

Route::get('/test/downloadexcel', [TestManagerController::class, 'download_excel'])->name('test.downloadexcel');
Route::post('/test', [TestController::class, 'store'])->name('test.store');

    //Web
Route::get('/', [HomeController::class, 'index'])->name('home');    
Route::get('/quiz/{competencias}', [QuizController::class, 'index'])->name('quiz');  
Route::post('/quiz/calculate', [QuizController::class, 'calculate'])->name('quiz.calculate');        
Route::get('/result', [QuizController::class, 'result'])->name('result');

//************************** */
// RUTAS PRIVADAS
//************************** */
Route::middleware('auth')->group(function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboardDetails', [DashboardController::class, 'details'])->name('dashboard.details');
    
    //Competencias
    Route::get('/competencia', [CompetenciaController::class, 'index'])->name('competencia');
    Route::get('/competencia/list', [CompetenciaController::class, 'list'])->name('competencia.list');
    Route::get('/competencia/create', [CompetenciaController::class, 'create'])->name('competencia.create');
    Route::post('/competencia', [CompetenciaController::class, 'store'])->name('competencia.store');
    Route::get('competencia/{competencia}/edit', [CompetenciaController::class, 'edit'])->name('competencia.edit');  
    Route::put('competencia/{competencia}', [CompetenciaController::class, 'update'])->name('competencia.update');
    Route::delete('competencia/{competencia}', [CompetenciaController::class, 'destroy'])->name('competencia.destroy');
    Route::get('/competencia/import', [CompetenciaController::class, 'import'])->name('competencia.import');
    Route::post('/competencia/importfile', [CompetenciaController::class, 'importfile'])->name('competencia.importfile');   
    Route::post('/competencia/importfilerelated', [CompetenciaController::class, 'importfilerelated'])->name('competencia.importfilerelated'); 
    
    //Afirmaciones
    Route::get('/afirmation', [AfirmationController::class, 'index'])->name('afirmation');
    Route::get('/afirmation/list', [AfirmationController::class, 'list'])->name('afirmation.list');
    Route::get('/afirmation/create', [AfirmationController::class, 'create'])->name('afirmation.create');
    Route::post('/afirmation', [AfirmationController::class, 'store'])->name('afirmation.store');
    Route::get('/afirmation/import', [ImportController::class, 'import'])->name('afirmation.import');  
    Route::post('/afirmation/importfile', [ImportController::class, 'importfile'])->name('afirmation.importfile');   
    Route::get('afirmation/{afirmation}/edit', [AfirmationController::class, 'edit'])->name('afirmation.edit');  
    Route::put('afirmation/{afirmation}', [AfirmationController::class, 'update'])->name('afirmation.update');
    Route::delete('afirmation/{afirmation}', [AfirmationController::class, 'destroy'])->name('afirmation.destroy');
    
    //Capsulas
    Route::get('/capsule', [CapsuleController::class, 'index'])->name('capsule');
    Route::get('/capsule/create', [CapsuleController::class, 'create'])->name('capsule.create');
    Route::post('/capsule', [CapsuleController::class, 'store'])->name('capsule.store');    
    Route::post('/capsule/{id}/edit', [CapsuleController::class, 'edit'])->name('capsule.edit');   
    Route::get('/capsule/list', [CapsuleController::class, 'list'])->name('capsule.list');
    Route::delete('/capsule/{id}', [CapsuleController::class, 'destroy'])->name('capsule.destroy');
    
    // TEST
    Route::get('/test', [TestManagerController::class, 'index'])->name('test');
    Route::get('/test/list', [TestManagerController::class, 'list'])->name('test.list');
    Route::post('/testUser', [TestController::class, 'storeUser'])->name('test.storeUser');

    // USERS
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/list', [UserController::class, 'list'])->name('user.list');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');   

    Route::get('/user/import', [UserController::class, 'importView'])->name('user.importView');
    Route::post('/user/import', [UserController::class, 'import'])->name('user.import');
    Route::get('/user/downloadTemplate', [UserController::class, 'donwloadTemplate'])->name('user.donwloadTemplate');

    Route::post('/user/sendResetLink', [UserController::class, 'sendResetLink'])->name('user.sendResetLink');

    // COMPANIES
    Route::get('/companie', [CompanieController::class, 'index'])->name('companie');
    Route::get('/companie/list', [CompanieController::class, 'list'])->name('companie.list');
    Route::get('/companie/create', [CompanieController::class, 'create'])->name('companie.create');
    Route::post('/companie', [CompanieController::class, 'store'])->name('companie.store');    

    Route::get('/companie/{id}/edit', [CompanieController::class, 'edit'])->name('companie.edit');   
    Route::post('/companie/{id}/update', [CompanieController::class, 'update'])->name('companie.update'); 
    Route::get('/companie/{id}/active', [CompanieController::class, 'active'])->name('companie.active');
    Route::delete('/companie/{id}', [CompanieController::class, 'destroy'])->name('companie.destroy');
    Route::get('/companie/listUserByCompanie/{id}', [CompanieController::class, 'listUserByCompanie'])->name('companie.listUserByCompanie');

    Route::get('/mycompanie', [CompanieController::class, 'myCompanie'])->name('mycompanie');
    Route::get('/mycompanie/list', [CompanieController::class, 'mylist'])->name('mycompanie.list');



});

