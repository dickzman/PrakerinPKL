<?php


Route::get('/', function () {
    return view('welcome');
});



Auth::routes();


// disable register routes

Route::match(['GET', 'POST'], '/register', function(){
    return redirect('/login');
})->name('register');



// end disable register routes


Route::get('/home', 'HomeController@index')->name('home');


// peserta module

Route::get('/peserta/json', 'PesertaController@data_json')->name('peserta.json');
Route::get('/peserta/trash/json', 'PesertaController@trash_json')->name('peserta_trash.json');
Route::get('/peserta/{id}/restore', 'PesertaController@restore')->name('peserta_trash.restore');
Route::delete('/peserta/{id}/delete', 'PesertaController@delete_permanent')->name('peserta.delete');
Route::get('/peserta/trash', 'PesertaController@trash')->name('peserta.trash');
Route::resource('/peserta', 'PesertaController');

// end peserta module



// pembimbing module

Route::get('/pembimbing/json', 'PembimbingController@data_json')->name('pembimbing.json');
Route::get('pembimbing/trash/json', 'PembimbingController@trash_json')->name('pembimbing_trash.json');
Route::get('pembimbing/{id}/restore', 'PembimbingController@restore')->name('pembimbing_trash.restore');
Route::delete('pembimbing/{id}/delete', 'PembimbingController@delete_permanent')->name('pembimbing.delete');
Route::get('pembimbing/trash', 'PembimbingController@trash')->name('pembimbing.trash');
Route::resource('/pembimbing', 'PembimbingController');

// end pembimbing module
