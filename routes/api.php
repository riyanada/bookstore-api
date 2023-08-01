<?php

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('nama', function() {
//     return "Bookstore-API";
// });
// Route::get('category/{id}', function($id){
//     $categories = [
//         1 => 'Matematika',
//         2 => 'Bahasa',
//         3 => 'Teknologi'
//     ];
//     $id = (int) $id;
//     if($id==0) return 'Silahkan pilih kategori';
//     else return "Anda memilih kategori <b>".$categories[$id]."</b>";
// });
// Route::get('/book/{id}', function () {
//     return 'menampilkan buku';
// })->where('id', '[0-9]+');
Route::prefix('v1')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

    Route::get('categories', 'CategoryController@index');
    Route::get('categories/random/{count}', 'CategoryController@random');
    Route::get('categories/slug/{slug}', 'CategoryController@slug');
    Route::get('books', 'BookController@index');
    Route::get('book/{id}', 'BookController@view')->where('id', '[0-9]+');
    Route::get('books/top/{count}', 'BookController@top');
    Route::get('books/slug/{slug}', 'BookController@slug');
    Route::get('books/search/{keyword}', 'BookController@search');
    Route::get('provinces', 'ShopController@provinces');
    Route::get('cities', 'ShopController@cities');
    Route::get('couriers', 'ShopController@couriers');
    
    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'AuthController@logout');
        Route::post('shipping', 'ShopController@shipping');
        Route::post('services', 'ShopController@services');
        Route::post('payment', 'ShopController@payment');
        Route::get('my-order', 'ShopController@myorder');
    });
});
Route::middleware(['cors'])->group(function () {
    Route::get('buku/{title}', 'BookController@print');
});
// Route::middleware('throttle:10,1')->group(function () {
//     Route::get('buku/{title}', 'BookController@print');
// });