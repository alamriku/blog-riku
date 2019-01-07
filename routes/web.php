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



Route::get('/','WelcomeController@index');
Route::get('/contact','WelcomeController@contact');
Route::get('/lifeStyle','WelcomeController@lifeStyle');
Route::get('/travel',"WelcomeController@travel");
Route::get('/fashion','WelcomeController@fashion');
Route::get('/aboutMe','WelcomeController@aboutMe');
Route::group(['namespace'=>'Admin'],function(){
    Route::get('/admin','AdminController@index')->name('admin');
    Route::post('/admin_login','AdminController@adminLogin');
});

//the url admin_login is added to form tag in admin_login_blade
Route::get('/dashboard','SuperAdminController@index');
Route::get('/logout','SuperAdminController@logout');

Route::get('/add-category','SuperAdminController@addCategory');
Route::post('/save-category','SuperAdminController@saveCategory');
Route::get('/manage-category','SuperAdminController@manageCategory');
Route::get('/unpublish-category/{id}','SuperAdminController@unpublishCategory');
Route::get('/publish-category/{id}','SuperAdminController@publishCategory');
Route::get('/edit-category/{id}','SuperAdminController@fetchCategory');
Route::post('/edit-category/{id}','SuperAdminController@editCategory');
Route::get('/delete-category/{id}','SuperAdminController@deleteCategory');
Route::get('/add-blog','SuperAdminController@addBlog');
Route::post('/save-blog/',"SuperAdminController@saveBlog");
Route::get('/manage-blog/',"SuperAdminController@manageBlog");
Route::get('/unpublish-blog/{id}',"SuperAdminController@unpublishBlog");
Route::get('/publish-blog/{id}',"SuperAdminController@publishBlog");
Route::get('/delete-blog/{id}',"SuperAdminController@deleteBlog");
Route::get('/edit-blog/{id}','SuperAdminController@fetchBlog');
Route::post('/update-blog/{blog_id}',"SuperAdminController@updateBlog");
Route::post('/edit-category/{id}','SuperAdminController@editCategory');
Route::get('/blog-details/{blog_id}',"WelcomeController@blogDetail");
Route::get('/category-blog/{id}','WelcomeController@categoryBlog');
Route::post('/comment/{blog_id}','CommentController@store')->name('comment');
Route::get('/manage-comment/','SuperAdminController@manageComment');
Route::get('/unpublish-comment/{id}','SuperAdminController@unpublishComment');
Route::get('/publish-comment/{id}','SuperAdminController@publishComment');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


