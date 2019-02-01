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

// Auth routes
Auth::routes();

// Public routes
Route::group(['prefix' => ''], function() {
    Route::get('/', 'App\AppHomeController@home');
    Route::get('/home', 'App\AppHomeController@home');
    Route::get('/tasks/{id}', 'App\AppTasksController@task');
    Route::get('/splashes/levelup', 'App\AppSplashController@levelUp');
    Route::post('/tasks/{id}', 'App\AppTasksController@taskSubmit');
});

// OAuth Routes
Route::get('auth/{provider}', 'Auth\OAuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\OAuthController@handleProviderCallback');

// Admin Routes
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'Admin\AdminDashboardController@dashboard');
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', 'Admin\AdminDashboardController@dashboard');
    });
    Route::group(['prefix' => 'questions'], function() {
        Route::get('/', 'Admin\AdminQuestionsController@questions');
    });
    Route::group(['prefix' => 'settings'], function() {
        Route::get('/', 'Admin\AdminSettingsController@general');
        Route::get('/general', 'Admin\AdminSettingsController@general');
    });
    Route::group(['prefix' => 'tasks'], function() {
        Route::get('/', 'Admin\AdminTasksController@tasks');
        Route::get('/entries', 'Admin\AdminTasksController@taskEntries');
        Route::post('/ajaxtasksfeed', 'Admin\AdminTasksController@ajaxTasksFeed');
        Route::post('/ajaxtasksconfirm', 'Admin\AdminTasksController@ajaxTasksConfirm');
    });
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', 'Admin\AdminUsersController@users');
    });
});

// Splash Routes
Route::group(['prefix' => 'splash'], function() {
    Route::get('/levelup', 'Splash\SplashController@levelUp');
    Route::get('/taskcomplete', 'Splash\SplashController@taskComplete');
});

// Questions routes
Route::group(['prefix' => 'questions'], function() {
    Route::get('/', 'Questions\QuestionsController@questions');
});
