<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Comment;
use App\Notifications\CommentPost;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

Route::get('/test', function (){
//    $user = Auth::user();
//    $post = 4;
//    $user->notify(new \App\Notifications\LikePost(\App\User::findOrFail(4), \App\Post::findOrFail($post)));
foreach (\Illuminate\Support\Facades\Auth::user()->notifications as $notification) {
    $notification->markAsRead();
}});

Route::get('/comtest', function (){
    $user = Auth::user();
    $post = Post::findOrFail(17);
    $auth = User::findOrFail(1);
    $auth->notify(new CommentPost($user, $post, Comment::findOrFail(11)));
});

Route::get('/',  'PostController@getIndex')->name('blog.index');
Route::get('/explore',  'PostController@getExploreIndex')->name('blog.explore');

Route::get('post/{slug}', 'PostController@getPost')->name( 'blog.post');
Route::get('/search_results', 'PostController@searchPost')->name('search');

Route::group(['middleware'=>'auth'], function() {
    Route::get('post/{id}/like', 'PostController@getLikePost')->name('blog.post.like');
    Route::get('bookmark/{id}', 'PostController@createBookmark')->name('bookmark');//add to bookmarks db
    Route::get('bookmarks', 'PostController@getBookmarksindex')->name('bookmarks');//show bookmarks view
    Route::get('delete_bookmark/{id}', 'PostController@destroyBookmark')->name('delete_bookmark');//show bookmarks view
    Route::post('comment/{id}', 'CommentController@store')->name('comment');
    Route::get('comment/{id}/like', 'CommentController@LikeComment')->name('comment.like');
});

Route::get('about', function (){ return view('other.about');})->name('other.about');

Route::group(['prefix' => 'author', 'middleware'=>'auth'], function() {

    Route::get('', 'PostController@getAdminIndex')->name('admin.index');

    Route::post('/profile', 'UsersController@showedit')->name('edit');

    Route::post('/profile_update', 'UsersController@editinfo')->name('profile.update');

    Route::get('create', 'PostController@getAdminCreate')->name('admin.create');

    Route::post('create', 'PostController@postAdminCreate')->name('admin.create');

//    Route::post('create', 'PostController@tagAdminCreate')->name('admin.tag.create');

    Route::get('edit/{id}', 'PostController@getAdminEdit')->name('admin.edit');

    Route::get('delete/{slug}', 'PostController@getAdminDelete')->name('admin.delete');

    Route::post('edit', 'PostController@postAdminUpdate')->name('admin.update');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('posts/check_slug', 'PostController@check_slug')->name('posts.check_slug');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'super_admin'], function () {
    Voyager::routes();
});
