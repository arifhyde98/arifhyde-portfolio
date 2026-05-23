<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'storeMessage'])->name('contact.post');
Route::post('/ai-chat', [HomeController::class, 'aiChat'])->name('ai.chat');

// Admin Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Skills CRUD
    Route::resource('skills', SkillController::class)->except(['show']);

    // Projects CRUD
    Route::resource('projects', ProjectController::class);

    // Timelines CRUD
    Route::resource('timelines', TimelineController::class)->except(['show']);

    // Testimonials CRUD
    Route::resource('testimonials', TestimonialController::class)->except(['show']);

    // Contact Messages Viewing & Deleting
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

    // Settings (SEO & Appearance)
    Route::get('/settings/seo', [SettingController::class, 'editSeo'])->name('settings.seo');
    Route::post('/settings/seo', [SettingController::class, 'updateSeo'])->name('settings.seo.update');
    Route::get('/settings/appearance', [SettingController::class, 'editAppearance'])->name('settings.appearance');
    Route::post('/settings/appearance', [SettingController::class, 'updateAppearance'])->name('settings.appearance.update');

    // Media Manager
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{medium}', [MediaController::class, 'destroy'])->name('media.destroy');
});
