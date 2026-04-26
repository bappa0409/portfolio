<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterSettingsController;
use App\Http\Controllers\Admin\HeaderSettingsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\Setting\AboutController;
use App\Http\Controllers\Admin\Setting\ContactController as SettingContactController;
use App\Http\Controllers\Admin\Setting\GitHubController;
use App\Http\Controllers\Admin\Setting\HomepageController;
use App\Http\Controllers\AjaxController;
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

    /* =======================
     | DASHBOARD
     ======================= */
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    /* =======================
     | WEBSITE SETTINGS (GLOBAL)
     ======================= */
    // Route::prefix('website')->name('website.')->group(function () {

    //     // Header / Navigation
    //     Route::get('/header', [HeaderSettingsController::class, 'edit'])
    //         ->name('header.edit');
    //     Route::post('/header', [HeaderSettingsController::class, 'update'])
    //         ->name('header.update');

    //     // Footer
    //     Route::get('/footer', [FooterSettingsController::class, 'edit'])
    //         ->name('footer.edit');
    //     Route::post('/footer', [FooterSettingsController::class, 'update'])
    //         ->name('footer.update');
    // });

    /* =======================
     | HOMEPAGE SETTINGS
     ======================= */
    Route::controller(HomepageController::class)->prefix('homepage')->name('homepage.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::post('/section-meta', 'updateSectionMeta')->name('section_meta');
        Route::post('/hero', 'updateHero')->name('hero');
        Route::post('/services', 'updateServices')->name('services');
        Route::post('/featured-projects', 'updateFeaturedProjects')->name('featured_projects');
        Route::post('/cta-1', 'updateCta1')->name('cta_1');
        Route::post('/why-choose', 'updateWhyChoose')->name('why_choose');
        Route::post('/process', 'updateProcess')->name('process');
        Route::post('/tech-stack', 'updateTechStack')->name('tech_stack');
        Route::post('/stats', 'updateStats')->name('stats');
        Route::post('/cta-2', 'updateCta2')->name('cta_2');
        Route::post('/testimonials', 'updateTestimonials')->name('testimonials');
        Route::post('/faq', 'updateFaq')->name('faq');
    });

    /* =======================
     | ABOUT PAGE SETTINGS
     ======================= */
    Route::controller(AboutController::class)->prefix('about')->name('about.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::post('/header', 'header')->name('header');
        Route::post('/terminal', 'terminal')->name('terminal');
        Route::post('/tags', 'tags')->name('tags');
        Route::post('/profile', 'profile')->name('profile');
        Route::post('/journey', 'journey')->name('journey');
        Route::post('/education', 'education')->name('education');
        Route::post('/training', 'training')->name('training');
        Route::post('/experience', 'experience')->name('experience');
        Route::post('/skills', 'skills')->name('skills');
        Route::post('/philosophy', 'philosophy')->name('philosophy');
        Route::post('/passions', 'passions')->name('passions');
        Route::post('/footer', 'footer')->name('footer');
    });

    /* =======================
     | CONTACT PAGE SETTINGS
     ======================= */
    Route::controller(SettingContactController::class)->prefix('contact')->name('contact.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::post('page-meta', 'updatePageMeta')->name('page_meta');
        Route::post('contact-cards', 'updateContactCards')->name('contact_cards');
        Route::post('social-links', 'updateSocialLinks')->name('social_links');
    });


    /* =======================
     | GITHUB SETTINGS
     ======================= */
    Route::controller(GitHubController::class)->prefix('github')->name('github.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
    });
    
    /* =======================
     | PROJECT MANAGEMENT
     ======================= */
    Route::controller(ProjectController::class)->prefix('projects')->name('projects.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{project}/edit', 'edit')->name('edit');
        Route::put('/{project}', 'update')->name('update');
        Route::delete('/{project}', 'destroy')->name('destroy');
        Route::delete('/multi-destroy', 'multiDestroy')->name('multi_destroy');
        Route::post('/{project}/visibility', 'toggleVisibility')->name('visibility');
    });
});



##API
Route::group(['prefix' => 'ajax'], function () {
    Route::controller(AjaxController::class)->group(function () {
        Route::get('/github', 'githubRepos')->name('get_github_repos');
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

