<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('userlist', 'MessageController@user_list')->name('user.list');
Route::get('usermessage/{id}', 'MessageController@user_message')->name('user.message');
Route::post('sendmessage', 'MessageController@send_message')->name('user.message.send');
Route::get('deletemessage/{id}', 'MessageController@delete_message')->name('user.message.delete');
Route::get('deleteallmessage/{id}', 'MessageController@delete_all_message')->name('user.all.message.delete');
