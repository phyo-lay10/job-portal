<?php

use App\Http\Controllers\admin\AppController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\NewsCategoryController;
use App\Http\Controllers\admin\NewsController;
use App\Http\Controllers\admin\PaymentMethodController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeDislikeController;
use App\Http\Controllers\UiController;
use Illuminate\Support\Facades\Route;


// Ui
Route::get('/', [UiController::class, 'index'])->name('index');

// News
Route::get('news', [UiController::class, 'news'])->name('news');
// News detail
Route::get('news/{id}/detail', [UiController::class, 'newsDetail'])->name('newsDetail');
// News search
Route::get('search_news', [UiController::class, 'searchNews'])->name('searchNews');
Route::get('news_search_by_id/{id?}', [UiController::class, 'newsSearchById'])->name('newsSearchById');
// News comment
Route::post('news/comment/{newsId}', [CommentController::class, 'comment'])->name('comment')->middleware('auth');
Route::post('news/reply/{newsId}', [CommentController::class, 'reply'])->name('reply')->middleware('auth');
// News like dislike
Route::post('news/like/{newsId}', [LikeDislikeController::class, 'like'])->name('like');
Route::post('news/dislike/{newsId}', [LikeDislikeController::class, 'dislike'])->name('dislike');

// Search Job
Route::get('search_job', [UiController::class, 'search'])->name('search');
Route::get('search_by_id/{id?}', [UiController::class, 'searchById'])->name('searchById');

// Company
Route::get('companies', [UiController::class, 'company'])->name('company');

// Search Company
Route::get('search_company', [UiController::class, 'searchCompany'])->name('searchCompany');

// Application Form
Route::middleware('auth')->group(function () {
    Route::get('apply/{id}', [ApplicationController::class, 'apply'])->name('apply');
    Route::post('apply/store', [ApplicationController::class, 'store'])->name('store');
    Route::get('profile', [UiController::class, 'profile'])->name('profile');
    // Logout
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    // Login
    Route::get('login', [AuthController::class, 'login'])->name('loginForm');
    Route::post('login', [AuthController::class, 'loginStore'])->name('login.store');

    // Register
    Route::get('register', [AuthController::class, 'register'])->name('registerForm');
    Route::post('register', [AuthController::class, 'registerStore'])->name('register.store');
});

// Register Update
Route::post('register/{id}/update', [AuthController::class, 'registerUpdate'])->name('registerUpdate');


// Admin
Route::prefix('admin')->middleware('isEmployer')->group(function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');

    // Category
    Route::resource('categories', CategoryController::class);

    // Job
    Route::resource('jobs', JobController::class);

    // Payment Method
    Route::resource('payment-methods', PaymentMethodController::class);

    // Payment
    Route::get('payment', [DashboardController::class, 'payment'])->name('payment');

    // Payment Store
    Route::post('payment/create', [DashboardController::class, 'paymentStore'])->name('payment.store');

    // User Lists
    Route::get('user-list', [DashboardController::class, 'userList'])->name('userList');

    // Payment Detail
    Route::get('payment/{employerId}/detail', [DashboardController::class, 'paymentDetail'])->name('paymentDetail');
    Route::post('payment/{userId}/confirm', [DashboardController::class, 'paymentConfirm'])->name('paymentConfirm');

    // Print payment
    Route::get('print-pdf/{id}', [DashboardController::class, 'printPdf'])->name('print');

    // Applications
    Route::get('jobs/{jobId}/applications', [JobController::class, 'getApplications'])->name('jobs.applications');

    // Accept app
    Route::post('applications/{id}/accept', [JobController::class, 'acceptApplication'])->name('applications.accept');

    // Reject app
    Route::post('applications/{id}/reject', [JobController::class, 'rejectApplication'])->name('applications.reject');

    // News Category
    Route::resource('news-categories', NewsCategoryController::class);

    // News
    Route::resource('news', NewsController::class);

    // Reports
    Route::get('reports', [DashboardController::class, 'report']);

    // Profile
    Route::get('profile/page', [DashboardController::class, 'profile'])->name('profilePage');
    Route::post('profile/{id}', [DashboardController::class, 'profileUpdate'])->name('profileUpdate');

    // Show Hide comment
    Route::post('comment/{id}/show_hide', [NewsController::class, 'showHideComment']);
    // Delete comment
    Route::post('comment/{id}/delete', [NewsController::class, 'deleteComment'])->name('deleteComment');
});

