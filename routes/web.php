<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\ContactController;


##Frontend Routes
Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/projects', [WebsiteController::class, 'projects'])->name('projects');
Route::get('/projects/{slug}', [WebsiteController::class, 'projectShow'])->name('projects.show');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/contact', [WebsiteController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


##Admin Routes
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'send'])->name('dashboard');
    
    Route::controller(ProjectsController::class)->prefix('projects')->name('projects.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/edit/{id}','edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::delete('/destroy/{id}','destroy')->name('destroy');
        Route::delete('/multi-destroy', 'multiDestroy')->name('multi_destroy');
        Route::get('/visibility-change/{id:id}', 'visibilityChange')->name('visibility');
    });
});

// Run the Artisan commands
Route::get('/clear-all', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('event:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    return "Artisan commands executed successfully!";
});

Route::get('/cache', function() {
    Artisan::call('config:cache');
    Artisan::call('event:cache');
    return "Artisan commands executed successfully!";
});