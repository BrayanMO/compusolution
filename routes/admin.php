<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Admin\ShowProducts;

use App\Http\Livewire\Admin\CreateProduct;

use App\Http\Controllers\Admin\CategoryController;

use App\Http\Controllers\Admin\OrderController;


Route::get('/', ShowProducts::class)->name('admin.index');

Route::get('products/create', CreateProduct::class)->name('admin.products.create');

Route::get('products/{product}/edit', function () {

})->name('admin.products.edit');


Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');


Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');

Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
