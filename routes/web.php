<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MusicController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SongController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;



// Authentication routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

// Admin Authentication routes
Route::get('/admin/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [App\Http\Controllers\Admin\AdminAuthController::class, 'logout'])->name('admin.logout');

// Default route
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Public routes
Route::get('/songs', [SongController::class, 'index'])->name('songs.index');
Route::get('/songs/sh/{song}', [SongController::class, 'show'])->name('songs.show');

// Feedback routes
Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

// Authentication routes
Route::middleware(['auth'])->group(function () {
    // Song management
    Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
    Route::get('/songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');
    Route::put('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
    Route::delete('/songs/{song}', [SongController::class, 'destroy'])->name('songs.destroy');

    // Playlist management
    Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');
    Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
    Route::put('/playlists/{playlist}', [PlaylistController::class, 'update'])->name('playlists.update');
    Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');

    // Playlist song management
    Route::post('/playlists/{playlist}/songs', [PlaylistController::class, 'addSong'])->name('playlists.songs.add');
    Route::delete('/playlists/{playlist}/songs', [PlaylistController::class, 'removeSong'])->name('playlists.songs.remove');
    Route::put('/playlists/{playlist}/songs/reorder', [PlaylistController::class, 'reorderSongs'])->name('playlists.songs.reorder');
});

// Admin routes
// Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Feedback management
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('admin.feedback.index');
    Route::get('/feedback/{feedback}', [FeedbackController::class, 'show'])->name('admin.feedback.show');
    Route::put('/feedback/{feedback}', [FeedbackController::class, 'update'])->name('admin.feedback.update');
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');

    // Music Management
    Route::prefix('music')->group(function () {
        Route::get('/', [MusicController::class, 'index'])->name('admin.music.index');
        Route::get('/create', [MusicController::class, 'create'])->name('admin.music.create');
        Route::post('/', [MusicController::class, 'store'])->name('admin.music.store');
        Route::get('/{music}', [MusicController::class, 'show'])->name('admin.music.show');
        Route::get('/{music}/edit', [MusicController::class, 'edit'])->name('admin.music.edit');
        Route::put('/{music}', [MusicController::class, 'update'])->name('admin.music.update');
        Route::delete('/{music}', [MusicController::class, 'destroy'])->name('admin.music.destroy');
    });

    // User Management
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        Route::post('/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    });
});
