<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(PetController::class)->group(function () {
    Route::get('/pet/{id}', 'show')->whereNumber('id');
});