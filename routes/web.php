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



Route::get( '/' , function () {
    return redirect('/dashboard/auth/login');
});

Route::get( '/dashboard/{any}' , fn( ) => view( 'admin-panel' ) )-> where( 'any' , '.*' )   -> name( 'admin' ) ;
Route::get( '/dashboard' , fn( ) => view( 'admin-panel' ) ) ;



// Route::get( '{any}' , fn( ) => view( 'site' ) )-> where( 'any' , '.*' )-> name( 'site' ) ;
Auth::routes();


