<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ProductController::class, 'gallery'])->middleware(['auth'])->name('product.gallery');

Route::get('/product/create', [ProductController::class, 'create'])->middleware(['auth'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->middleware(['auth'])->name('product.store');

Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->middleware(['auth'])->name('product.edit');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->middleware(['auth'])->name('product.update');

Route::get('/product/{id}', [ProductController::class, 'show'])->middleware(['auth'])->name('product.show');
Route::get('/product/generatepdf/{id}', [ProductController::class, 'generatePDF'])->middleware(['auth'])->name('product.generatepdf');

Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->middleware(['auth'])->name('product.destroy');


require __DIR__.'/auth.php';
