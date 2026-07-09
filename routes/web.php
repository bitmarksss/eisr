<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,

    DashboardController,
    InventoryController,
    StockRequestController,
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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'auth.session'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // SURFACE
    Route::prefix('surface')->name('surface.')->group(function () {
        Route::prefix('inventory')->name('inventory.')->group(function () {
            Route::get('/', [InventoryController::class, 'index'])->name('index');
            Route::post('/store', [InventoryController::class, 'store'])->name('store');
            Route::put('/{id}', [InventoryController::class, 'update'])->name('update');
            Route::post('/upload', [InventoryController::class, 'upload'])->name('upload');
        });

        Route::prefix('stock-request')->name('stock-request.')->group(function () {
            Route::get('/', [StockRequestController::class, 'index'])->name('index');
            Route::post('/store', [StockRequestController::class, 'store'])->name('store');
            Route::put('/{id}', [StockRequestController::class, 'update'])->name('update');
            Route::post('/upload', [StockRequestController::class, 'upload'])->name('upload');
        });
    });

    // UNDERGROUND
    Route::prefix('underground')->name('underground.')->group(function () {
        Route::prefix('inventory')->name('inventory.')->group(function () {
            Route::get('/', [InventoryController::class, 'index'])->name('index');
            Route::post('/store', [InventoryController::class, 'store'])->name('store');
            Route::put('/{id}', [InventoryController::class, 'update'])->name('update');
            Route::post('/upload', [InventoryController::class, 'upload'])->name('upload');

            Route::get('/update-record/{item_id}', [InventoryController::class, 'update_record'])->name('update-record');
            Route::post('/record', [InventoryController::class, 'record'])->name('record');
        });
        
        Route::prefix('stock-request')->name('stock-request.')->group(function () {
            Route::get('/', [StockRequestController::class, 'index'])->name('index');
            Route::post('/store', [StockRequestController::class, 'store'])->name('store');
            Route::put('/{id}', [StockRequestController::class, 'update'])->name('update');
            Route::post('/upload', [StockRequestController::class, 'upload'])->name('upload');
        });
    });

    Route::prefix('file')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('file.index');
        Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');

    });
    
    Route::prefix('admin')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');

            Route::post('/store', [UserController::class, 'store'])->name('users.store');
            Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        });
    });



    // Route::prefix('loan')->group(function () {
    //     Route::get('/', [LoanController::class, 'index'])->name('loan.index');
    //     Route::post('/upload', [LoanController::class, 'upload'])->name('loan.upload');
    // });
    // Route::prefix('grocery')->group(function () {
    //     Route::get('/', [GroceryController::class, 'index'])->name('grocery.index');
    //     Route::post('/upload', [GroceryController::class, 'upload'])->name('grocery.upload');
    // });
    // Route::prefix('payments')->group(function () {
    //     Route::get('/', [PaymentsController::class, 'index'])->name('payments.index');
    //     Route::post('/upload', [PaymentsController::class, 'upload'])->name('payments.upload');
    // });
});
