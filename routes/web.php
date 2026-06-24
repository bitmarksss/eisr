<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    DashboardController,

    InventoryController,
    FileController,

    LoanController,
    GroceryController,
    PaymentsController,
    UserController
};

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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('inventory')->group(function () {
    Route::get('/', [InventoryController::class, 'index'])->name('inventory.index');
    Route::post('/upload', [InventoryController::class, 'upload'])->name('inventory.upload');

});

Route::prefix('file')->group(function () {
    Route::get('/', [FileController::class, 'index'])->name('file.index');
    Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');

});

Route::prefix('loan')->group(function () {
    Route::get('/', [LoanController::class, 'index'])->name('loan.index');
    Route::post('/upload', [LoanController::class, 'upload'])->name('loan.upload');

});

Route::prefix('grocery')->group(function () {
    Route::get('/', [GroceryController::class, 'index'])->name('grocery.index');
    Route::post('/upload', [GroceryController::class, 'upload'])->name('grocery.upload');

});

Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentsController::class, 'index'])->name('payments.index');
    Route::post('/upload', [PaymentsController::class, 'upload'])->name('payments.upload');

});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');

    Route::post('/store', [UserController::class, 'store'])->name('users.store');

});
