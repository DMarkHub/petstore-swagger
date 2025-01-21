<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('user.login');
})->name('dashboard');

Route::controller(PetController::class)->group(function () {
    Route::get('/pet', 'show')->name('pet.show');
    Route::post('/pet', 'show');

    Route::get('/pet/create', 'create')->name('pet.create');
    Route::post('/pet/create', 'create');

    Route::get('/pet/update/{id}', 'update')->name('pet.update');
    Route::post('/pet/update/{id}', 'update');

    Route::get('/pet/delete', 'update')->name('pet.delete');

    Route::get('/pet/find', 'find')->name('pet.find.by.status');
    Route::post('/pet/find', 'find');
});

Route::controller(StoreController::class)->group(function () {
    Route::get('/store/inventory', 'showInventory')->name('store.show.inventory');

    Route::get('/store/order', 'showOrder')->name('store.show.order');
    Route::post('/store/order', 'showOrder');

    Route::get('/store/create', 'createOrder')->name('store.order.create');
    Route::post('/store/create', 'createOrder');

    Route::get('/store/delete', 'deleteOrder')->name('store.order.delete');
    Route::post('/store/delete', 'deleteOrder');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user/create', 'create');

    Route::get('/user/create-multiple', 'createMultiple')->name('user.create.multiple');
    Route::post('/user/create-multiple', 'createMultiple');

    Route::get('/user/update/{username}', 'update')->name('user.update')->whereAlphaNumeric('username');
    Route::post('/user/update/{username}', 'update')->whereAlphaNumeric('username');

    Route::get('/user/delete/{username}', 'delete')->name('user.delete')->whereAlphaNumeric('username');

    Route::get('/user/show', 'show')->name('user.show');
    Route::post('/user/show', 'show');

    Route::get('/user/login', 'login')->name('user.login');
    Route::post('/user/login', 'login');

    Route::get('/user/logout', 'logout')->name('user.logout');
    Route::post('/user/logout', 'logout');
});