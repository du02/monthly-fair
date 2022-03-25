<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth', 'access.products'])->group(function (){

    // home
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('item', 'HomeController@store')->name('item.store');
    Route::get('item/{id}/edit', 'HomeController@edit')->name('item.edit');
    Route::post('item/{id}', 'HomeController@update')->name('item.update');
    Route::get('item/{id}/remove', 'HomeController@destroy')->name('item.destroy');
    Route::get('impress', 'HomeController@impress')->name('item.impress');

    // user
    Route::get('/user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::post('/user/{id}', 'UserController@update')->name('user.update');
});
