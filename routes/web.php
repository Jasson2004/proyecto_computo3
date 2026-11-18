<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Rutas Públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/entrada/{slug}', [HomeController::class, 'show'])->name('posts.show');

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Panel Administrativo Protegido (auth + admin)
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Publicaciones y Borradores
        Route::get('/publicaciones', [PostController::class, 'index'])->name('posts.index');
        Route::get('/borradores', [PostController::class, 'drafts'])->name('posts.drafts');
        Route::get('/entradas/crear', [PostController::class, 'create'])->name('posts.create');
        Route::post('/entradas', [PostController::class, 'store'])->name('posts.store');
        Route::get('/entradas/{post}/editar', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/entradas/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::patch('/entradas/{post}/publicar', [PostController::class, 'publish'])->name('posts.publish');
        Route::patch('/entradas/{post}/despublicar', [PostController::class, 'unpublish'])->name('posts.unpublish');
        Route::delete('/entradas/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::delete('/evidencias/{image}', [PostController::class, 'destroyImage'])->name('images.destroy');

        // Categorías
        Route::get('/categorias', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categorias', [CategoryController::class, 'store'])->name('categories.store');
        Route::put('/categorias/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categorias/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });