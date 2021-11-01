<?php

use App\Http\Controllers\AjaxDashboardChartStatsController;
use App\Http\Controllers\PostStatsController;
use App\Http\Controllers\ProfileStatsController;
use App\Http\Controllers\CommentStatsController;
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
    return view('welcome');
});


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/dashboard', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']])->middleware("super_moderator");
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});




Route::get("/stats/get-last7days-stats-g1",[AjaxDashboardChartStatsController::class,"getAllChartsStatsForGroup1"]);
Route::get("/stats/get-last7days-stats-g2",[AjaxDashboardChartStatsController::class,"getAllChartsStatsForGroup2"]);
Route::get("/stats/get-last7days-per-day-stats-g2",[AjaxDashboardChartStatsController::class,"getPerDayAllPieChartsStatsForGroup2"]);

Route::get("/stats/get-last-signaled-posts-and-profiles-stats-g3",[AjaxDashboardChartStatsController::class,"getLastSignaledPostsAndProfilesAndCommentsGroup3Stats"]);

Route::get("/post/signaled-posts",[PostStatsController::class,"getLast5SignaledPosts"])->name("all-signaled-posts");
Route::get("/comment/signaled-comments",[CommentStatsController::class,"getLast5SignaledComments"])->name("all-signaled-comments");
Route::get("/blog-users/signaled-profiles",[ProfileStatsController::class,"getLast5SignaledProfiles"])->name("all-signaled-profiles");

Route::get("/blog-users/blacklisted-profiles",[ProfileStatsController::class,"getBlacklistedProfiles"])->name("blacklisted-profiles");

Route::get('/stats/blog-users/signals-contexts/{id}',[ProfileStatsController::class,"getSignalsContextsForUser"])->name("profile-signals-contexts");

Route::get('/stats/post/{id}/signals',[PostStatsController::class,"getSignalsForPost"])->name("post-signals");

Route::get('/stats/comment/{id}/signals',[CommentStatsController::class,"getSignalsForComment"])->name("comment-signals");

//show one for post,comment & profile
Route::get("/posts/{id}/show",[PostStatsController::class,"show"])->name("show-post");
Route::get("/comments/{id}/show",[CommentStatsController::class,"show"])->name("show-comment");
Route::get("/profiles/{id}/show",[ProfileStatsController::class,"show"])->name("show-profile");