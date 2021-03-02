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

// Route::get('/', function () {
//     return view('welcome');
// });
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/home2', 'Auth\LoginController@index')->name('home2');
// Route::get('/logConseiller','Login2Controller@logConseiller')->name('logConseiller');
// Route::post('/loginConseiller','Login2Controller@loginConseiller')->name('loginConseiller');
Route::group( ['middleware' => ['auth']], function() {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('categories', 'CategorieController');
    Route::resource('plats', 'PlatController');
    
   
});

Route::get('/plats/destroy/{id}','PlatController@destroy')->name('plats_destroy');
Route::get('/show_plats','PlatController@showPlatByCategorie')->name('showPlat');
Route::get('/show_plats/serveur','PlatController@showPlatByCategorieForSerevur')->name('showPlat.serveur');
Route::get('/save_ticket','PlatController@saveTicket')->name('save.ticket');



////



Route::get('/inventaire/index','Inventaire@index')->name('inventaire.index');
Route::get('/ticket/show','Inventaire@show')->name('ticket.show');
Route::get('/ticket/delete','Inventaire@supprimer')->name('ticket.delete');