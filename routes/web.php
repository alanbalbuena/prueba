<?php

use App\Http\Controllers\CartaPorteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\EfectivoController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Support\Facades\Auth;
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

Route::resource('chofer', ChoferController::class)->middleware('auth');
Route::resource('cartaPorte', CartaPorteController::class)->middleware('auth');
Route::resource('efectivo', EfectivoController::class)->middleware('auth');
Route::resource('prestamo', PrestamoController::class)->middleware('auth');


Auth::routes(['register'=>false,'reset'=>false]);
//Auth::routes();

//Route::get('/home', [CartaPorteController::class, 'sinFacturar'])->name('sinFacturar');
Route::get('/home', function () {
    return redirect('/sinFacturar/empresa');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return redirect('/sinFacturar/empresa');
    });
    //Route::get('/', [CartaPorteController::class, 'sinFacturar'])->name('sinFacturar');   
    Route::get('/sinFacturar/{id}', [CartaPorteController::class, 'sinFacturar'])->name('sinFacturar');                               
    Route::get('/facturadas', [CartaPorteController::class, 'index'])->name('facturadas'); 
    
    Route::get('/buscar', [CartaPorteController::class, 'buscar'])->name('buscar');   
});

