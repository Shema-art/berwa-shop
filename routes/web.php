<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; // Added ProductController import
use App\Http\Controllers\ProductImportController;
use App\Http\Controllers\StockMovementController;
use Illuminate\Support\Facades\Route;
use App\Models\Product; // Added Product model import

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
    return view('auth/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

   
    Route::resource('products', ProductController::class);
    Route::resource('imports', ProductImportController::class);
    Route::resource('exports', ExportController::class);
    
    Route::post('stock/in', [StockMovementController::class, 'storeStockIn'])->name('stock.in');
    Route::post('stock/out', [StockMovementController::class, 'storeStockOut'])->name('stock.out');
});

require __DIR__.'/auth.php';
