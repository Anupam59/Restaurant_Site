<?php

use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\CommonPageController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\PlatterController;
use App\Http\Controllers\Admin\SiteCommonController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'HomePage']);



Route::get('/admin/dashboard', function () {
    return view('Admin.Pages.Dashboard.DashboardPage');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('admin/common-page-list', [CommonPageController::class, 'CommonPageIndex']);
    Route::get('admin/common-page-create', [CommonPageController::class, 'CommonPageCreate']);
    Route::post('admin/common-page-entry', [CommonPageController::class, 'CommonPageEntry']);
    Route::get('admin/common-page-edit/{id}', [CommonPageController::class, 'CommonPageEdit']);
    Route::post('admin/common-page-update/{id}', [CommonPageController::class, 'CommonPageUpdate']);

    Route::get('admin/event-list', [EventController::class, 'EventIndex']);
    Route::get('admin/event-create', [EventController::class, 'EventCreate']);
    Route::post('admin/event-entry', [EventController::class, 'EventEntry']);
    Route::get('admin/event-edit/{id}', [EventController::class, 'EventEdit']);
    Route::post('admin/event-update/{id}', [EventController::class, 'EventUpdate']);

    Route::get('admin/gallery-list', [GalleryController::class, 'GalleryIndex']);
    Route::get('admin/gallery-create', [GalleryController::class, 'GalleryCreate']);
    Route::post('admin/gallery-entry', [GalleryController::class, 'GalleryEntry']);
    Route::get('admin/gallery-edit/{id}', [GalleryController::class, 'GalleryEdit']);
    Route::post('admin/gallery-update/{id}', [GalleryController::class, 'GalleryUpdate']);

    Route::get('admin/testimonial-list', [TestimonialController::class, 'TestimonialIndex']);
    Route::get('admin/testimonial-create', [TestimonialController::class, 'TestimonialCreate']);
    Route::post('admin/testimonial-entry', [TestimonialController::class, 'TestimonialEntry']);
    Route::get('admin/testimonial-edit/{id}', [TestimonialController::class, 'TestimonialEdit']);
    Route::post('admin/testimonial-update/{id}', [TestimonialController::class, 'TestimonialUpdate']);

    Route::get('admin/chef-list', [ChefController::class, 'ChefIndex']);
    Route::get('admin/chef-create', [ChefController::class, 'ChefCreate']);
    Route::post('admin/chef-entry', [ChefController::class, 'ChefEntry']);
    Route::get('admin/chef-edit/{id}', [ChefController::class, 'ChefEdit']);
    Route::post('admin/chef-update/{id}', [ChefController::class, 'ChefUpdate']);

    Route::get('admin/menu-list', [MenuController::class, 'MenuIndex']);
    Route::get('admin/menu-create', [MenuController::class, 'MenuCreate']);
    Route::post('admin/menu-entry', [MenuController::class, 'MenuEntry']);
    Route::get('admin/menu-edit/{id}', [MenuController::class, 'MenuEdit']);
    Route::post('admin/menu-update/{id}', [MenuController::class, 'MenuUpdate']);

    Route::get('admin/menu-item-list', [MenuItemController::class, 'MenuItemIndex']);
    Route::get('admin/menu-item-create', [MenuItemController::class, 'MenuItemCreate']);
    Route::post('admin/menu-item-entry', [MenuItemController::class, 'MenuItemEntry']);
    Route::get('admin/menu-item-edit/{id}', [MenuItemController::class, 'MenuItemEdit']);
    Route::post('admin/menu-item-update/{id}', [MenuItemController::class, 'MenuItemUpdate']);

    Route::get('admin/platter-list', [PlatterController::class, 'PlatterIndex']);
    Route::get('admin/platter-create', [PlatterController::class, 'PlatterCreate']);
    Route::post('admin/platter-entry', [PlatterController::class, 'PlatterEntry']);
    Route::get('admin/platter-edit/{id}', [PlatterController::class, 'PlatterEdit']);
    Route::post('admin/platter-update/{id}', [PlatterController::class, 'PlatterUpdate']);

    Route::get('admin/site-info', [SiteCommonController::class, 'SiteInfo']);
    Route::post('admin/site-info-update', [SiteCommonController::class, 'SiteInfoUpdate']);
    Route::get('admin/site-social-media', [SiteCommonController::class, 'SiteSocialMedia']);
    Route::post('admin/site-social-media-update', [SiteCommonController::class, 'SiteSocialMediaUpdate']);
    Route::get('admin/site-data', [SiteCommonController::class, 'SiteData']);
    Route::post('admin/site-data-update', [SiteCommonController::class, 'SiteDataUpdate']);

});

require __DIR__.'/auth.php';
