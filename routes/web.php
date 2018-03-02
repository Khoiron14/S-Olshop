<?php

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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/admin', 'Auth\AdminController@index')->name('admin.index');

Route::prefix('user')->group(function() {
    Route::get('/profile', 'Auth\ProfileController@show')->name('user.profile');
    Route::patch('/profile/edit', 'Auth\UpdateController@update')->name('user.update');

    Route::get('/cart', 'Users\CartController@index')->name('cart.index');
    Route::post('/cart/item/{item}/add', 'Users\CartController@store')->name('cart.store');
    Route::post('/cart/item/{item}/delete', 'Users\CartController@destroy')->name('cart.destroy');
});

Route::resource('store', 'Shops\StoreController', ['except' => [
    'index', 'show', 'edit'
]]);

Route::prefix('{store}')->group(function() {
    Route::get('/', 'Shops\StoreController@show')->name('store.show');

    Route::resource('item', 'Shops\ItemController', ['except' => [
        'index', 'create', 'edit'
    ]]);
});
