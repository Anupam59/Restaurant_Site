<?php

use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\CommonPageController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Site.Pages.HomePage');
});

Route::get('/panel/dashboard', function () {
    return view('Admin.Pages.Dashboard.DashboardPage');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('panel/common-page-list', [CommonPageController::class, 'CommonPageIndex']);
    Route::get('panel/common-page-create', [CommonPageController::class, 'CommonPageCreate']);
    Route::post('panel/common-page-entry', [CommonPageController::class, 'CommonPageEntry']);
    Route::get('panel/common-page-edit/{id}', [CommonPageController::class, 'CommonPageEdit']);
    Route::post('panel/common-page-update/{id}', [CommonPageController::class, 'CommonPageUpdate']);

    Route::get('panel/event-list', [EventController::class, 'EventIndex']);
    Route::get('panel/event-create', [EventController::class, 'EventCreate']);
    Route::post('panel/event-entry', [EventController::class, 'EventEntry']);
    Route::get('panel/event-edit/{id}', [EventController::class, 'EventEdit']);
    Route::post('panel/event-update/{id}', [EventController::class, 'EventUpdate']);

    Route::get('panel/gallery-list', [GalleryController::class, 'GalleryIndex']);
    Route::get('panel/gallery-create', [GalleryController::class, 'GalleryCreate']);
    Route::post('panel/gallery-entry', [GalleryController::class, 'GalleryEntry']);
    Route::get('panel/gallery-edit/{id}', [GalleryController::class, 'GalleryEdit']);
    Route::post('panel/gallery-update/{id}', [GalleryController::class, 'GalleryUpdate']);

    Route::get('panel/testimonial-list', [TestimonialController::class, 'TestimonialIndex']);
    Route::get('panel/testimonial-create', [TestimonialController::class, 'TestimonialCreate']);
    Route::post('panel/testimonial-entry', [TestimonialController::class, 'TestimonialEntry']);
    Route::get('panel/testimonial-edit/{id}', [TestimonialController::class, 'TestimonialEdit']);
    Route::post('panel/testimonial-update/{id}', [TestimonialController::class, 'TestimonialUpdate']);

    Route::get('panel/chef-list', [ChefController::class, 'ChefIndex']);
    Route::get('panel/chef-create', [ChefController::class, 'ChefCreate']);
    Route::post('panel/chef-entry', [ChefController::class, 'ChefEntry']);
    Route::get('panel/chef-edit/{id}', [ChefController::class, 'ChefEdit']);
    Route::post('panel/chef-update/{id}', [ChefController::class, 'ChefUpdate']);

    Route::get('panel/menu-list', [MenuController::class, 'MenuIndex']);
    Route::get('panel/menu-create', [MenuController::class, 'MenuCreate']);
    Route::post('panel/menu-entry', [MenuController::class, 'MenuEntry']);
    Route::get('panel/menu-edit/{id}', [MenuController::class, 'MenuEdit']);
    Route::post('panel/menu-update/{id}', [MenuController::class, 'MenuUpdate']);

    Route::get('panel/menu-item-list', [MenuItemController::class, 'MenuItemIndex']);
    Route::get('panel/menu-item-create', [MenuItemController::class, 'MenuItemCreate']);
    Route::post('panel/menu-item-entry', [MenuItemController::class, 'MenuItemEntry']);
    Route::get('panel/menu-item-edit/{id}', [MenuItemController::class, 'MenuItemEdit']);
    Route::post('panel/menu-item-update/{id}', [MenuItemController::class, 'MenuItemUpdate']);

});

require __DIR__.'/auth.php';
