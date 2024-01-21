<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\AdminMiddleware;

//welcome page
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::post('/login', [LoginController::class, 'login'])->name('login');

Auth::routes();

//admin
Route::get('/dashboard/home', 'App\Http\Controllers\DashboardController@home')->name('admin.home');

Route::get('dashboard/categories', 'App\Http\Controllers\CategoryController@index')->name('categories');
Route::get('dashboard/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('category');

Route::get('dashboard/categories/edit/{id}', 'App\Http\Controllers\CategoryController@edit')->name('category.edit');
Route::post('dashboard/categories/edit/{id}', 'App\Http\Controllers\CategoryController@update')->name('category.update');
Route::get('dashboard/categories/delete/{id}', 'App\Http\Controllers\CategoryController@destroy')->name('category.destroy');

Route::get('dashboard/category/new', 'App\Http\Controllers\CategoryController@create')->name('category.new');
Route::post('dashboard/category/new', 'App\Http\Controllers\CategoryController@store')->name('category.store');

Route::get('dashboard/users', 'App\Http\Controllers\UsersController@index')->name('dashboard.users');
Route::get('dashboard/users/{id}', 'App\Http\Controllers\UsersController@show')->name('dashboard.user');

Route::get('dashboard/users/{id}/edit', 'App\Http\Controllers\UsersController@edit')->name('dashboard.user.edit');
Route::post('dashboard/users/{id}/update', 'App\Http\Controllers\UsersController@update')->name('dashboard.user.update');
Route::get('dashboard/users/{id}/delete', 'App\Http\Controllers\UsersController@destroy')->name('dashboard.user.destroy');

Route::get('/user/{id}/block', [UsersController::class, 'block'])->name('dashboard.user.block');
Route::get('/user/{id}/unblock', [UsersController::class, 'unblock'])->name('dashboard.user.unblock');

//user
Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

    Route::post('/category/{category}/join', [CategoryController::class, 'join'])->name('category.join');
    Route::get('/category/{category}/topic-overview', [UsersController::class, 'topicoverview'])->name('user.topicoverview');

    Route::get('/category/{category}/new-topic', [TopicController::class, 'newTopic'])->name('user.newtopic');
    Route::post('/category/{category}/topic', [TopicController::class, 'storeTopic'])->name('topic.store');
    Route::get('/category/{category}/{topic}', [UsersController::class, 'topic'])->name('user.topic');
    Route::post('/category/{category}/{topic}/reply', [TopicController::class, 'storeReply'])->name('topic.reply');

    Route::delete('/category/{category}/{topic}', [TopicController::class, 'deleteTopic'])->name('topic.delete');
    Route::delete('/category/{category}/{topic}/{reply}', [TopicController::class, 'deleteReply'])->name('reply.delete');

    Route::get('/reports', 'App\Http\Controllers\ReportController@index')->name('reports');
    Route::post('/submit-report/{post_id?}/{reply_id?}', [ReportController::class, 'submitReport'])->name('submit.report');

    Route::get('/topics', 'App\Http\Controllers\TopicController@topics')->name('topics');
    Route::get('/replies', 'App\Http\Controllers\TopicController@replies')->name('replies');

    Route::post('/subscribe', 'App\Http\Controllers\SubscribeController@subscribe')->name('subscribe');


    //Route::get('/telegram/join', [TelegramController::class, 'joinGroup'])->name('telegram.join');
    //Route::post('/telegram/subscribe', [TelegramController::class, 'subscribeToNotifications'])->name('telegram.subscribe');
    //Route::post('/telegram/send-notification', [TelegramController::class, 'sendNotificationToGroup'])->name('telegram.send-notification');

    //Route::post('/telegram/notification', [TelegramController::class, 'sendNotification']);

    //telegram notification
    //Route::post('/notify-replies/{category}/{topic}', [UsersController::class, 'notifyForReplies'])->name('notify.replies');
    //Route::post('/subscribe', [UsersController::class, 'subscribeToNotifications'])->name('subscribe');
    

    //Route::post('/telegram/updates', [TelegramController::class, 'handleUpdates'])->name('telegram.updates');
    //Route::post('/users/notify', [UsersController::class, 'sendNotification'])->name('users.notify');
    //Route::post('/telegram/callback', [TelegramController::class, 'handleCallback'])->name('telegram.callback');


    //Route::get('subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');
    Route::post('/subscribe', [SubscribeController::class, 'subscribe'])->name('subscribe');
    Route::post('/trigger-notification', [TelegramController::class, 'triggerNotification'])->name('trigger.notification');

});