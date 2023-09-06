<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.products');
    })->name('dashboard');





Route::get('/items',[\App\Http\Controllers\itemController::class,'index'])->name('items');
Route::get('/items/get',[\App\Http\Controllers\itemController::class,'getdata'])->name('getItem');
Route::post('/items/save',[\App\Http\Controllers\itemController::class,'store'])->name('saveItem');
Route::get('/items/{id}/edit',[\App\Http\Controllers\itemController::class,'edit'])->name('editItem');
Route::post('/items/update',[\App\Http\Controllers\itemController::class,'update'])->name('updateItem');
    Route::post('/items/delete',[\App\Http\Controllers\itemController::class,'destroy'])->name('deleteitem');




Route::get('/products',[\App\Http\Controllers\productsController::class,'index'])->name('products');
Route::get('/products/get',[\App\Http\Controllers\productsController::class,'getdata'])->name('getproducts');
Route::post('/products/save',[\App\Http\Controllers\productsController::class,'store'])->name('saveproduct');
Route::get('/products/recipe/{id}',[\App\Http\Controllers\productsController::class,'getRecipe'])->name('getTheRecipe');
Route::get('/products/{id}/edite',[\App\Http\Controllers\productsController::class,'edit'])->name('editproduct');
Route::post('/products/update',[\App\Http\Controllers\productsController::class,'update'])->name('updateproduct');
Route::post('/products/delete',[\App\Http\Controllers\productsController::class,'destroy'])->name('deleteproduct');


});
