<?php

use Illuminate\Support\Facades\Route;
use Modules\CustomerAd\Http\Controllers\CustomerAdController;
use Modules\Ad\Http\Controllers\GalleryController;

Route::middleware([ 'setlang'])->group(function () {

    // subcategory & town dropdown routes
    Route::get('get_subcategory/{id}', [AdController::class, 'getSubcategory']);
    Route::get('get_town/{id}', [AdController::class, 'getTown']);

    Route::group(['as' => 'module.customerad.', 'prefix' => 'user/ad'], function () {

        // ad gallery routes
        Route::get('/gallery/{id}', [GalleryController::class, 'showGallery'])->name('show_gallery');
        Route::post('/ad-gallery/{id}', [GalleryController::class, 'storeGallery'])->name('store_gallery');
        Route::delete('/gallery/{image}', [GalleryController::class, 'deleteGallery'])->name('delete_gallery');

        // ad crud routes
        Route::get('/', [CustomerAdController::class, 'index'])->name('index');
        Route::get('/add', [CustomerAdController::class, 'create'])->name('create');
        Route::post('/add', [CustomerAdController::class, 'store'])->name('store');
        Route::get('/edit/{ad}', [CustomerAdController::class, 'edit'])->name('edit');
        Route::put('/update/{ad}', [CustomerAdController::class, 'update'])->name('update');
        Route::get('/favourite/change', [CustomerAdController::class, 'favourite_change'])->name('change');
        Route::get('/show/{ad:slug}', [CustomerAdController::class, 'show'])->name('show');
        Route::delete('/destroy/{ad}', [CustomerAdController::class, 'destroy'])->name('destroy');
    });
});
