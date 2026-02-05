<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageSettingsController;
use App\Http\Controllers\Admin\ProjectController;
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

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::controller(HomepageSettingsController::class)->prefix('homepage')->name('homepage.')->group(function () {
        Route::get('/settings', 'edit')->name('settings.edit');
        // Route::post('/settings', 'update')->name('settings.update');

        // =========================
        // SECTION-WISE AJAX UPDATES
        // =========================

        Route::post('/settings/section-meta', 'updateSectionMeta')->name('settings.section_meta');
        Route::post('/settings/hero', 'updateHero')->name('settings.hero');
        Route::post('/settings/services', 'updateServices')->name('settings.services');
        Route::post('/settings/featured-projects', 'updateFeaturedProjects')->name('settings.featured_projects');
        Route::post('/settings/cta-1', 'updateCta1')->name('settings.cta_1');
        Route::post('/settings/why-choose', 'updateWhyChoose')->name('settings.why_choose');
        Route::post('/settings/process', 'updateProcess')->name('settings.process');
        Route::post('/settings/tech-stack', 'updateTechStack')->name('settings.tech_stack');
        Route::post('/settings/stats', 'updateStats')->name('settings.stats');
        Route::post('/settings/cta-2', 'updateCta2')->name('settings.cta_2');
        Route::post('/settings/testimonials', 'updateTestimonials')->name('settings.testimonials');
        Route::post('/settings/faq', 'updateFaq')->name('settings.faq');

    });
    Route::controller(ProjectController::class)->prefix('project')->name('project.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');

        Route::get('/edit/{project}', 'edit')->name('edit');
        Route::post('/update/{project}', 'update')->name('update');
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