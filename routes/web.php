<?php


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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZmediaController;
use App\Http\Controllers\CeaController;
use App\Http\Controllers\VacaController;
use App\Http\Controllers\EurekaController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});


//Rutas para actividades 
Route::get('actividad', [ActividadController::class, 'index'])->middleware('auth')->name('actividad.index');
Route::get('actividad/create', [ActividadController::class, 'create'])->middleware('auth')->name('actividad.create');
Route::post('actividad', [ActividadController::class, 'store'])->middleware('auth')->name('actividad.store');
Route::get('actividad/{id}', [ActividadController::class, 'show'])->middleware('auth')->name('actividad.show');
Route::get('actividad/{actividad}/edit', [ActividadController::class, 'edit'])->middleware('auth')->name('actividad.edit');
Route::put('actividad/{actividad}', [ActividadController::class, 'update'])->middleware('auth')->name('actividad.update');

//Rutas para encargados
Route::get('encargado', [EncargadoController::class, 'index'])->middleware('auth')->name('encargado.index');
Route::get('encargado/create', [EncargadoController::class, 'create'])->middleware('auth')->name('encargado.create');
Route::post('encargado', [EncargadoController::class, 'store'])->middleware('auth')->name('encargado.store');
Route::get('encargado/{encargado}/edit', [EncargadoController::class, 'edit'])->middleware('auth')->name('encargado.edit');
Route::put('encargado/{encargado}', [EncargadoController::class, 'update'])->middleware('auth')->name('encargado.update');

//Rutas para HomePage
Route::get('home', [HomeController::class, 'index'])->middleware('auth')->name('home.index');

//Rutas para Zmedia
Route::get('zmedia', [ZmediaController::class, 'index'])->middleware('auth')->name('zmedia.index');

//Rutas para Cea
Route::get('cea', [CeaController::class, 'index'])->middleware('auth')->name('cea.index');

//Rutas para Vaca
Route::get('vaca', [VacaController::class, 'index'])->middleware('auth')->name('vaca.index');

//Rutas para Eureka
Route::get('eureka', [EurekaController::class, 'index'])->middleware('auth')->name('eureka.index');
