<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarioController;

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
    return view('auth.login');
});

/*Route::get('/inventario', function () {
    return view('inventario.index');
});
Route::get( '/inventario/create', [InventarioController::class, 'create']);*/ //para acceder ruta una por una

Route::resource( '/inventario', InventarioController::class)->middleware('auth'); //Para acceder a todas las rutas de una forma mas facil


Auth::routes(['register' => false, 'reset' => false]); //Para que no aparesca el registro, ni el restablecimiento de contraseña

Route::get('/home', [InventarioController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    //
    Route::get('/', [InventarioController::class, 'index'])->name('home');
});
