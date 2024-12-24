<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ContactController;
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
})->name('welcome');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index'); // Lista de trabajos

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');  // Ruta para mostrar el formulario de inicio de sesión
Route::post('/login', [AuthController::class, 'login']);  // Ruta para manejar el inicio de sesión

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');  // Ruta para mostrar el formulario de registro
Route::post('/register', [AuthController::class, 'register']);  // Ruta para manejar el registro


Route::get('/medios', function () {return view('medios');})->name('medios');
Route::get('/nosotros', function () {return view('nosotros');})->name('nosotros');
Route::get('/contactanos', function () { return view('contactanos');})->name('contactanos');

Route::get('/contactanos', [ContactController::class, 'showForm'])->name('contactanos');
Route::post('/contactanos', [ContactController::class, 'sendEmail'])->name('send.contact');

Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index'); 
    // Usuarios con opción 'dar-trabajo' tienen acceso completo
    Route::middleware(['job.option:dar-trabajo'])->group(function () {
        // Funcionalidades exclusivas para 'dar-trabajo'
        Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
        Route::get('/myjobs', [JobController::class, 'myjobs'])->name('jobs.myjobs');
        Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
        Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
        Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');

      
        
    });

    

    // Rutas comunes para todos los usuarios autenticados
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});





