<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/viewProduct/{id}', 'ProductController@view');

Route::get('/', 'HomeController@index');


Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/search/{idCategory}/{age}/{price?}', 'HomeController@searchGet');
Route::post('/search', 'HomeController@searchPost');

Route::get('/subSearch/{idSubCategory}/{idCategory}/{age}/{price?}', 'HomeController@subSearch');

Route::get('/viewUser/{id}', 'UserController@view');

Route::get('/userProducts/{idUser}', 'ProductController@userProducts');

Route::group(['middleware' => "auth"], function(){

  Route::get('/editarUsuario', function (){
    return view('editarUsuario');
  });
  Route::post('/editarUsuario', 'UserController@edit');

  Route::get('/editProduct/{id}', 'ProductController@viewEdit');
  Route::post('/editProduct/{id}', 'ProductController@edit');

  Route::get('/myProducts', 'ProductController@myProducts');

  Route::post('/registerProduct', 'ProductController@create');
  Route::get('/registerProduct', 'ProductController@viewRegister');

  Route::get('/viewWishlist', 'UserController@wishlist');
  Route::get('/checkout', 'UserController@checkout');

  Route::get('/api/subCategories/{id}', 'ApiController@subCategories');
  Route::get('/api/wishlist/{idProduct}', 'ApiController@wishlist');
  Route::get('/api/unwishlist/{idProduct}', 'ApiController@unwishlist');
  Route::get('/api/shoplist/{idProduct}', 'ApiController@shoplist');
  Route::get('/api/unshoplist/{idProduct}', 'ApiController@unshoplist');
  Route::get('/api/deleteProduct/{idProduct}', 'ApiController@deleteProduct');
  Route::get('/api/mercadopago/createPreference', 'ApiController@createPreference');
  Route::get('/api/mercadopago/response/{value}', 'ApiController@response');
});
