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

Route::namespace('App\Http\Controllers')->group(function () {

    Route::get('/about', function () {
        return view('about');
    })->name('about');

//Exchange Rates
    Route::get('/currency', 'ExchangeRateController@index')->name('currency.index');

//Home
    Route::get('/home', 'HomeController@index')->name('home.index');

//Profile
    Route::get('profile/{id}/edit', 'ProfileController@edit')->name('profile.edit');
    Route::put('profile/{id}', 'ProfileController@update')->name('profile.update');

//Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::delete('dashboard/{id}', 'DashboardController@destroy')->name('dashboard.destroy');

//Users
    Route::get('users', 'UsersController@index')->name('users');
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
   // Route::get('test', 'UsersController@test')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
    Route::get('/notifications', 'UsersController@notifications');

//Roles
    Route::get('roles/roles', 'RolesController@index')->name('roles.index');
    Route::get('roles/{user}/edit', 'RolesController@edit')->name('roles.edit');
    Route::put('roles/{user}', 'RolesController@update')->name('roles.update');
    Route::delete('roles/{user}', 'RolesController@destroy')->name('roles.destroy');

//Posts
    Route::resource('posts', 'PostController');
//    Route::get('posts/create', 'PostController@create')->name('posts.create');
//    Route::post('posts', 'PostController@store')->name('posts.store');
//    Route::get('posts/{post_id}', 'PostController@show')->name('posts.show');
//    Route::get('posts/', 'PostController@index')->name('posts.index');
//    Route::get('posts/{id}/edit', 'PostController@edit')->name('posts.edit');
//    Route::put('posts/{id}', 'PostController@update')->name('posts.update');
//    Route::delete('posts/{id}', 'PostController@destroy')->name('posts.destroy');

//Comments
    Route::post('comments/{post_id}', 'CommentsController@store')->name('comments.store');
    Route::get('comments/{id}/edit', 'CommentsController@edit')->name('comments.edit');
    Route::get('comments/{id}/blogEdit', 'CommentsController@blogEdit')->name('comments.blogEdit');
    Route::put('comments/{id}', 'CommentsController@update')->name('comments.update');
    Route::delete('comments/{id}', 'CommentsController@destroy')->name('comments.destroy');

//Blog
    Route::get('blog/{id}', 'BlogController@getSingle')->name('blog.single');
    Route::get('blog', 'BlogController@getIndex')->name('blog.index');

    Route::post('ckeditor/upload', 'CKEditorController@upload')->name('ckeditor.image-upload');
});

Auth::routes(['verify' => true]);


