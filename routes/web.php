<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');
Route::post('/business/store', 'HomeController@store')
    ->name('business.store');
Route::get('/business/show', 'HomeController@show')
    ->name('business.show');
Route::delete('/business/{busines}', [
    'uses' => 'HomeController@destroy',
    'as' => 'business.destroy'
]);
Route::put('/business/{busines}',[
	'uses' => 'HomeController@update',
	'as' => 'business.update'
]);

// ejercicios
Route::post('/ejercicio_one', 'HomeController@ejercicio_one')
    ->name('ejercicio_one');
Route::post('/ejercicio_three', 'HomeController@ejercicio_three')
    ->name('ejercicio_three');