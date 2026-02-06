<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomepageSettingsController;
use App\Http\Controllers\Admin\AboutSettingsController;
use App\Http\Controllers\Admin\ContactSettingsController;
use App\Http\Controllers\Admin\FooterSettingsController;
use App\Http\Controllers\Admin\HeaderSettingsController;
use App\Http\Controllers\Admin\ProjectController;
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
    Route::controller(HomepageSettingsController::class)->prefix('homepage')->name('homepage.')->group(function () {
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
    Route::controller(AboutSettingsController::class)->prefix('about')->name('about.')->group(function () {
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
    });

    /* =======================
     | CONTACT PAGE SETTINGS
     ======================= */
    Route::controller(ContactSettingsController::class)->prefix('contact')->name('contact.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::post('page-meta', 'updatePageMeta')->name('page_meta');
        Route::post('contact-cards', 'updateContactCards')->name('contact_cards');
        Route::post('social-links', 'updateSocialLinks')->name('social_links');
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




    // Route::controller(HomepageSettingsController::class)->prefix('homepage-settings')->name('homepage.')->group(function () {
    //     Route::get('/settings', 'edit')->name('settings.edit');

    //     // =========================
    //     // SECTION-WISE AJAX UPDATES
    //     // =========================

    //     Route::post('/settings/section-meta', 'updateSectionMeta')->name('settings.section_meta');
    //     Route::post('/settings/hero', 'updateHero')->name('settings.hero');
    //     Route::post('/settings/services', 'updateServices')->name('settings.services');
    //     Route::post('/settings/featured-projects', 'updateFeaturedProjects')->name('settings.featured_projects');
    //     Route::post('/settings/cta-1', 'updateCta1')->name('settings.cta_1');
    //     Route::post('/settings/why-choose', 'updateWhyChoose')->name('settings.why_choose');
    //     Route::post('/settings/process', 'updateProcess')->name('settings.process');
    //     Route::post('/settings/tech-stack', 'updateTechStack')->name('settings.tech_stack');
    //     Route::post('/settings/stats', 'updateStats')->name('settings.stats');
    //     Route::post('/settings/cta-2', 'updateCta2')->name('settings.cta_2');
    //     Route::post('/settings/testimonials', 'updateTestimonials')->name('settings.testimonials');
    //     Route::post('/settings/faq', 'updateFaq')->name('settings.faq');

    // });

    // Route::controller(AboutSettingsController::class)->prefix('about-settings')->name('about.')->group(function () {
    //     Route::get('/settings', 'edit')->name('settings.edit');

    //     // section saves
    //     Route::post('/header',  'header')->name('settings.header');
    //     Route::post('/terminal', 'terminal')->name('settings.terminal');
    //     Route::post('/tags', 'tags')->name('settings.tags');
    //     Route::post('/profile', 'profile')->name('settings.profile');
    //     Route::post('/journey', 'journey')->name('settings.journey');
    //     Route::post('/education', 'education')->name('settings.education');
    //     Route::post('/training', 'training')->name('settings.training');
    //     Route::post('/experience','experience')->name('settings.experience');
    //     Route::post('/skills',   'skills')->name('settings.skills');
    //     Route::post('/philosophy', 'philosophy')->name('settings.philosophy');
    //     Route::post('/passions', 'passions')->name('settings.passions');
    // });

    // Route::controller(ProjectController::class)->prefix('project')->name('project.')->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('/create','create')->name('create');
    //     Route::post('/store','store')->name('store');

    //     Route::get('/edit/{project}', 'edit')->name('edit');
    //     Route::post('/update/{project}', 'update')->name('update');
    //     Route::delete('/destroy/{id}','destroy')->name('destroy');
    //     Route::delete('/multi-destroy', 'multiDestroy')->name('multi_destroy');
    //     Route::get('/visibility-change/{id:id}', 'visibilityChange')->name('visibility');
    // });
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