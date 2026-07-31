<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\DashboardController;


Route::get('/', function () {
    return redirect()->route('bundles.index');
});

Route::resource('bundles', BundleController::class);

Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

Route::get('/buyers/{buyer}/styles', [BundleController::class, 'getStyles'])
    ->name('buyers.styles');

// Route::get('/', function () {
//     return view('welcome');
// });
