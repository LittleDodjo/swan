<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});


Route::get('/app', function () {
    return view('app');
});

Route::get('/app/outgoing', fn() => view('app'));
Route::get('/app/create/outgoing', fn() => view('app'));
Route::get('/app/outgoing/{id}', fn() => view('app'));
Route::get('/app/outgoing/edit/{id}', fn() => view('app'));
Route::get('/app/marks', fn() => view('app'));
