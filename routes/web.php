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

Auth::routes();
Route::get('/user/logout', 'UserController@logout')->name('User > Logout');

Route::get('/', 'HomeController@Index')->name('Home');

Route::get('/article/{slug}', 'ArticleController@Show')->name('Article > Single');

Route::get('page/{slug}', 'PageController@Show')->name('Page > Single');

Route::get('/tag/{slug}', 'TagController@Archive')->name('Tag > Archive');

Route::get('/category/{slug}', 'CategoryController@Archive')->name('Category > Archive');

Route::get('/author/{username}', 'UserController@Archive')->name('User > Archive');

Route::post('/comment/{id}/submit' ,'CommentController@Submit')->name('Comment > Submit');

Route::prefix('admin')->middleware('auth', 'HasAdminAccess')->group(function () {
	Route::get('/', 'AdminController@Index')->name('Admin');

    Route::get('profile', 'AdminController@Profile')->name('Profile');
    Route::post('profile/update', 'AdminController@Update')->name('Profile > Update');

	Route::get('article/new', 'ArticleController@New')->name('Article > New');
	Route::post('article/new/submit', 'ArticleController@Submit')->name('Article > Submit');
    Route::get('article/manage/', 'ArticleController@Manage')->name('Article > Manage');
    Route::get('article/edit/{id}', 'ArticleController@Edit')->name('Article > Edit');
    Route::post('article/edit/{id}/update', 'ArticleController@Update')->name('Article > Update');
    Route::post('article/delete/{id}', 'ArticleController@DeletePermanently')->name('Article > Delete');
    Route::post('article/restore/{id}', 'ArticleController@Restore')->name('Article > Restore');

    Route::get('page/new', 'PageController@New')->name('Page > New');
    Route::post('page/new/submit', 'PageController@Submit')->name('Page > Submit');
    Route::get('page/manage/', 'PageController@Manage')->name('Page > Manage');
    Route::get('page/edit/{id}', 'PageController@Edit')->name('Page > Edit');
    Route::post('page/edit/{id}/update', 'PageController@Update')->name('Page > Update');
    Route::post('page/delete/{id}', 'PageController@DeletePermanently')->name('Page > Delete');
     Route::post('page/restore/{id}', 'PageController@Restore')->name('Page > Restore');

    Route::get('tag', 'TagController@Manage')->name('Tag > Manage');
    Route::post('tag/new/submit', 'TagController@Submit')->name('Tag > Submit');
    Route::post('tag/delete/{id}', 'TagController@Delete')->name('Tag > Delete');
    // Route::post('tag/resotre/{id}', 'TagController@Restore')->name('Tag > Restore');

    Route::get('category', 'CategoryController@Manage')->name('Category > Manage');
    Route::post('category/new/submit', 'CategoryController@Submit')->name('Category > Submit');
    Route::post('category/delete/{id}', 'CategoryController@Delete')->name('Category > Delete');
    // Route::post('category/resotre/{id}', 'CategoryController@Restore')->name('Category > Restore');
});
