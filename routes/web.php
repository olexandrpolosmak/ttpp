<?php

use App\Http\Controllers\Admin\Dishes\CreateDishAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('admin/dishes', CreateDishAdminController::class)
    ->name('admin.dishes.create');
