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
Route::get('/search', 'HomeController@search')->name('home.search');

Auth::routes();

Route::get('/admin', 'Auth\AdminController@index')->name('admin.index');

Route::prefix('user')->group(function() {
    Route::get('/activate', 'Auth\ActivationController@activate')->name('user.activate');
    Route::get('/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('user.activate.resend');
    Route::post('/activate/resend', 'Auth\ActivationResendController@resend');

    Route::get('/profile', 'Users\ProfileController@show')->name('user.profile');
    Route::get('/profile/edit', 'Auth\UpdateController@show')->name('user.update');
    Route::patch('/profile/edit', 'Auth\UpdateController@update');

    Route::get('/purchase', 'Shops\PurchaseController@show')->name('user.purchase');

    Route::get('/cart', 'Users\CartController@index')->name('cart.index');
    Route::post('/cart/{item}/add', 'Users\CartController@store')->name('cart.store');
    Route::post('/cart/{item}/delete', 'Users\CartController@destroy')->name('cart.destroy');
});

Route::resource('store', 'Shops\StoreController', ['except' => [
    'index', 'show', 'edit'
]]);

Route::prefix('{store}')->group(function() {
    Route::get('/', 'Shops\StoreController@show')->name('store.show');
    Route::get('/purchase', 'Shops\StoreController@showPurchase')->name('store.purchase');

    Route::resource('item', 'Shops\ItemController', ['except' => [
        'index', 'show', 'create', 'edit'
    ]]);

    Route::get('{item}', 'Shops\ItemController@show')->name('item.show');
});

Route::post('/purchase/{item}', 'Shops\PurchaseController@store')->name('purchase.store');
Route::patch('/purchase/{purchase}/confirm', 'Shops\PurchaseController@confirm')->name('purchase.confirm');
Route::patch('/purchase/{purchase}/cancel', 'Shops\PurchaseController@cancel')->name('purchase.cancel');
