<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\UserController;
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

// Auth routes to gain access
Route::get('register', [RegisterController::class, 'show'])->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'show'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Routes accessible to authenticated users (both regular users and admins)
Route::middleware(['auth'])->group(function () {
    Route::get('/', [MissionController::class, 'show'])->name('home');
    Route::get('/donations', [DonationController::class, 'show'])->name('donations');

    Route::get('donate/missions/{id}', [DonationController::class, 'showMissionDonation'])->name('donate.missions.show');
    Route::post('donate/missions/{id}', [DonationController::class, 'donateToMission'])->name('donate.missions.create');
    Route::get('donate/campaigns/{id}', [DonationController::class, 'showFundraiserDonation'])->name('donate.fundraiser.show');
    Route::post('donate/campaigns/{id}', [DonationController::class, 'donateToFundraiser'])->name('donate.fundraiser.create');

    Route::get('/campaigns', [CampaignController::class, 'show']);
    Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.create');
    Route::get('/campaigns/{id}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/campaigns/{id}', [CampaignController::class, 'update'])->name('campaigns.update');
    Route::delete('/campaigns/{campaign}', [CampaignController::class, 'delete'])->name('campaigns.delete');

    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('profile', [UserController::class, 'update'])->name('profile.update');
});

// Page routes
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/terms-of-service', 'pages.terms-of-service')->name('terms-of-service');
Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy-policy');

// Routes accessible to authenticated admins only
Route::get('admin/login', [\App\Http\Controllers\Admin\AUth\LoginController::class, 'show'])->name('admin.login');
Route::post('admin/login', [\App\Http\Controllers\Admin\AUth\LoginController::class, 'login']);
Route::post('admin/logout', [\App\Http\Controllers\Admin\AUth\LoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['admin.auth'])->group(function () {
    // dashboard
    Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Missions Management
    Route::resource('missions', \App\Http\Controllers\Admin\MissionController::class);

    // Fundraisers Management
    Route::get('campaigns', [\App\Http\Controllers\Admin\CampaignController::class, 'index'])->name('admin.campaigns.index');
    Route::put('campaigns/{campaign}/update-status', [\App\Http\Controllers\Admin\CampaignController::class, 'updateStatus'])->name('admin.campaigns.updateStatus');

    // User Management
    Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::put('users/{user}/activate', [\App\Http\Controllers\Admin\UserController::class, 'activate'])->name('admin.users.activate');
    Route::put('users/{user}/deactivate', [\App\Http\Controllers\Admin\UserController::class, 'deactivate'])->name('admin.users.deactivate');

    // System Settings
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::get('settings/create', [SettingController::class, 'create'])->name('admin.settings.create');
    Route::post('settings', [SettingController::class, 'store'])->name('admin.settings.store');
    Route::get('settings/{setting}/edit', [SettingController::class, 'edit'])->name('admin.settings.edit');
    Route::put('settings/{setting}', [SettingController::class, 'update'])->name('admin.settings.update');

    // Analytics and Reports
    Route::get('reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::post('reports/generate', [ReportController::class, 'generate'])->name('admin.reports.generate');
});

