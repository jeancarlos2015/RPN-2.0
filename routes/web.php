<?php
//
///*
//|--------------------------------------------------------------------------
//| Web Routes
//|--------------------------------------------------------------------------
//|
//| Here is where you can register web routes for your application. These
//| routes are loaded by the RouteServiceProvider within a group which
//| contains the "web" middleware group. Now create something great!
//|
//*/
//
//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();
Route::get('/', function () { return view('welcome'); })->name('/');
Route::resource('/tasks', 'TaskController');
Route::prefix('admin')->middleware(['auth'])->group(/**
 *
 */
    function () {
    //Rotas para acessar as views
    Route::get('/index','ControleVersaoController@index')->name('index');
    Route::get('/index_git_init','ControleVersaoController@index_git_init')->name('index_git_init');
    Route::get('/index_create_branch','ControleVersaoController@index_create_branch')->name('index_create_branch');
    Route::get('/index_git_commit','ControleVersaoController@index_git_commit')->name('index_git_commit');
    Route::get('/index_merge_branch','ControleVersaoController@index_merge_branch')->name('index_merge_branch');
    Route::get('/index_checkout_branch','ControleVersaoController@index_checkout_branch')->name('index_checkout_branch');
    Route::get('/index_clone_repository','ControleVersaoController@index_clone_repository')->name('index_clone_repository');
    Route::get('/area','ControleVersaoController@area')->name('area');

});