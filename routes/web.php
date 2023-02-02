<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});


Route::get('/app', function () {
    return view('app');
});

Route::get('/app/employee/{id}', fn() => view('app'));
Route::get('/app/employee', fn() => view('app'));
Route::get('/app/admin', fn() => view('app'));
Route::get('/app/management/{id}', fn() => view('app'));
Route::get('/app/mdep/{id}', fn() => view('app'));
Route::get('/app/edep/{id}', fn() => view('app'));
Route::get('/app/notification', fn() => view('app'));
Route::get('/app/outgoing', fn() => view('app'));
Route::get('/app/create/outgoing', fn() => view('app'));
Route::get('/app/outgoing/{id}', fn() => view('app'));
Route::get('/app/marks', fn() => view('app'));
Route::get('/app/ingoing', fn() => view('app'));
Route::get('/app/ingoing/{id}', fn() => view('app'));
Route::get('/app/reports', fn() => view('app'));
