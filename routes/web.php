<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductAttributesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\StockTransactionsController;
use App\Http\Controllers\UserController;

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

Route::get('/', [DashboardController::class, 'redirectTo'])->middleware('auth')->name('index');

Route::get('/maintenance', function () {
    return view('index', [
        'title' => 'Maintenance Page',
    ]);
});

Route::group(['middleware' => 'admin'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('suppliers', SuppliersController::class);
        Route::resource('users', UserController::class);

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductsController::class, 'index'])->name('products.index');
            Route::post('/store', [ProductsController::class, 'store'])->name('products.store');
            Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show');
            Route::put('/{id}', [ProductsController::class, 'update'])->name('products.update');
            Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
            Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
            Route::get('/spreadsheet/preview', [ProductsController::class, ''])->name('');
            Route::post('/spreadsheet/import', [ProductsController::class, 'importSpreadsheet'])->name('products.import');
            Route::post('/spreadsheet/export', [ProductsController::class, 'exportSpreadsheet'])->name('products.export');
        });
        Route::prefix('products/categories')->group(function () {
            Route::get('/all', [CategoriesController::class, 'index'])->name('categories.index');
            Route::post('/store', [CategoriesController::class, 'store'])->name('categories.store');
            Route::get('/{id}/edit', [CategoriesController::class, 'show'])->name('categories.show');
            Route::put('/{id}/update', [CategoriesController::class, 'update'])->name('categories.update');
            Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
        });
        Route::prefix('products/attributes')->group(function () {
            Route::get('/all', [ProductAttributesController::class, 'index'])->name('attributes.index');
            Route::post('/store', [ProductAttributesController::class, 'store'])->name('attributes.store');
            Route::get('/{id}', [ProductAttributesController::class, 'show'])->name('attributes.show');
            Route::get('/{id}/edit', [ProductAttributesController::class, 'edit'])->name('attributes.edit');
            Route::put('/{id}', [ProductAttributesController::class, 'update'])->name('attributes.update');
            Route::delete('/{id}', [ProductAttributesController::class, 'destroy'])->name('attributes.destroy');
        });
        Route::prefix('stock')->group(function () {
            Route::get('/transaction/history', [StockTransactionsController::class, 'index'])->name('stock.index');
            Route::get('/transaction/history/generate/stock-report', [StockTransactionsController::class, 'downloadReportByCriteria'])->name('stock.report-type');
            Route::get('/transaction/history/generate/transaction-report', [StockTransactionsController::class, 'downloadReportByType'])->name('stock.transaction-report');
            Route::get('/opname', [StockTransactionsController::class, 'opnameStockView'])->name('stock.opname');
            Route::post('update/minimum-quantity', [StockTransactionsController::class, 'updateStockMinimum'])->name('stock.update-minimum');
        });

        /* Define a custom route */
        Route::get('/user/activities/report', [DashboardController::class, 'downloadUserActivityReport'])->name('user.activities-report');
    });
});

Route::group(['middleware' => 'manajer'], function () {
    Route::prefix('manajer')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('manajer.dashboard');
    });
});

Route::group(['middleware' => 'staff'], function () {
    Route::prefix('staff')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('staff.dashboard');
    });
});

require __DIR__ . '/auth.php';
