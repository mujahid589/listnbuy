<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::prefix('ourteam')->group(function() {
//    Route::get('/', 'OurTeamController@index');
//});
use Illuminate\Support\Facades\Route;
use Modules\OurTeam\Http\Controllers\OurTeamController;

Route::middleware(['auth:super_admin', 'setlang'])->group(function () {
    // OurTeam Routes
    Route::prefix('admin/ourteam')->name('module.')->group(function () {
        Route::get('/', [OurTeamController::class, 'index'])->name('ourteam.index');
        Route::get('/add', [OurTeamController::class, 'create'])->name('ourteam.create');
        Route::post('/add', [OurTeamController::class, 'store'])->name('ourteam.store');
        Route::get('/edit/{ourteam}', [OurTeamController::class, 'edit'])->name('ourteam.edit');
        Route::put('/update/{ourteam}', [OurTeamController::class, 'update'])->name('ourteam.update');
        Route::delete('/destroy/{ourteam}', [OurTeamController::class, 'destroy'])->name('ourteam.destroy');
    });
});

