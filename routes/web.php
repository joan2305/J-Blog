<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/blog/all','App\Http\Controllers\PageController@allBlog') -> name('getAllBlog');


// Route::group(['middleware' => 'RoleAdmin'], function(){
//     Route::get('/admin', function () {
//         return 'halo';
//     });
    
// });
// Route::group(['middleware' => 'RoleMember'], function(){
//     Route::get('/member', function () {
//         return 'halo';
//     });
    
// });

//kalo gamau banyak2 kyk yg di bawah stiap routing msti ada App\Http\Controllers, bisa pake grouping namespace
// Route::group(['namespace','App\Http\Controllers'], function(){
//    Route::get('/blog/all','PageController@allBlog') -> name('getAllBlog');
//    Route::group(['middleware' => 'RoleAdmin'], function(){
//       //Category Routes 
//       Route::get('/category', 'CategoryController@index');
//       Route::post('category', 'CategoryController@store') -> name('storeCategory');
//       Route::get('/category/{id}', 'CategoryController@edit') ->name('editCategory');
//       Route::put('/category/{id}', 'CategoryController@update') ->name('updateCategory');
//       Route::delete('/category/{id}', 'CategoryController@destroy') ->name('deleteCategory');
    
//       // ACCEPT BLOG
//       Route::put('/blog/accept/{id}', 'BlogController@acceptBlog')->name('acceptBlog');
//    });
   
//    // BLOG ROUTES
//    Route::get('/blog', 'BlogController@index');
//       Route::post('blog', 'BlogController@store') -> name('storeBlog');
//       Route::get('/blog/{id}', 'BlogController@edit') ->name('editBlog');
//       Route::put('/blog/{id}', 'BlogController@update') ->name('updateBlog');
//       Route::delete('/blog/{id}', 'BlogController@destroy') ->name('deleteBlog');
   
//    // SEARCH BLOG
//    Route::post('/blog/search', 'BlogController@search')->name('searchBlog');
//    Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

Route::group(['middleware' => 'RoleAdmin'], function(){
   //Category Routes 
   Route::get('/category', 'App\Http\Controllers\CategoryController@index');
   Route::post('category', 'App\Http\Controllers\CategoryController@store') -> name('storeCategory');
   Route::get('/category/{id}', 'App\Http\Controllers\CategoryController@edit') ->name('editCategory');
   Route::put('/category/{id}', 'App\Http\Controllers\CategoryController@update') ->name('updateCategory');
   Route::delete('/category/{id}', 'App\Http\Controllers\CategoryController@destroy') ->name('deleteCategory');
 
   // ACCEPT BLOG
   Route::put('/blog/accept/{id}', 'App\Http\Controllers\BlogController@acceptBlog')->name('acceptBlog');
});

// BLOG ROUTES
Route::get('/blog', 'App\Http\Controllers\BlogController@index');
   Route::post('blog', 'App\Http\Controllers\BlogController@store') -> name('storeBlog');
   Route::get('/blog/{id}', 'App\Http\Controllers\BlogController@edit') ->name('editBlog');
   Route::put('/blog/{id}', 'App\Http\Controllers\BlogController@update') ->name('updateBlog');
   Route::delete('/blog/{id}', 'App\Http\Controllers\BlogController@destroy') ->name('deleteBlog');

// SEARCH BLOG
Route::post('/blog/search', 'App\Http\Controllers\BlogController@search')->name('searchBlog');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');