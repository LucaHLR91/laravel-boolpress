<?php

use Illuminate\Support\Facades\Route;
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
// ROTTA CHE GESTISCE LA HOMEPAGE VISIBILE AGLI UTENTI
Route::get('/', 'HomeController@index')->name('index');

// ROTTA CHE GESTIRA I POST PER L'UTENTE GENERICO
Route::resource('/posts', 'PostController');

// SERIE DI ROTTE CHE GESTISCE TUTTO IL MECCANISMO DI AUTENTICAZIONE

Auth::routes();

//  SERIE DI ROTTA CHE GESTISCONO IL BACKOFFICE
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')
    ->group(function() {
        // PAGINA DI ATTERRAGGIO DOPO IL LOGIN (CON IL PREFIX L'URL E' /ADMIN)
        Route::get('/', 'HomeController@index')->name('index');
        // RICHIAMA I POST
        Route::resource('/posts', 'PostController');
        Route::resource('/categories', 'CategoryController');
    });
