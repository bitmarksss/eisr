<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    AuthController,
    
    ApprovalController,
    DashboardController,
    FileController,
    InventoryController,
    LevelController,
    ReportsController,
    DailyReportController,
    StockController,
    SupplierController,
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

    // MAINTENANCE
    Route::prefix('maintenance')->name('maintenance.')->group(function () {
    
        // SUPPLIERS
        Route::prefix('supplier')->name('supplier.')->group(function () {
            Route::get('/{supplier}/items', [SupplierController::class, 'supplierItems'])->name('suppliers.items');
        });
        
        // ITEMS
        Route::prefix('inventory')->name('inventory.')->group(function () {
            Route::get('/', [InventoryController::class, 'index'])->name('index');
            Route::post('/store', [InventoryController::class, 'store'])->name('store');
            Route::put('/{id}', [InventoryController::class, 'update'])->name('update');
            Route::post('/upload', [InventoryController::class, 'upload'])->name('upload');
        });
        
        // LEVELS
        Route::prefix('levels')->name('levels.')->group(function () {
            Route::get('/', [LevelController::class, 'index'])->name('index');
            Route::get('/store', [LevelController::class, 'store'])->name('store');
            Route::get('/update', [LevelController::class, 'update'])->name('update');
        });
        Route::get('/stock-approvers', [ApprovalController::class, 'index'])->name('stock-approvers.index');
        Route::put('/stock-approvers', [StockController::class, 'updateApprovers'])->name('stock-approvers.update');
    });

    // SURFACE
    Route::prefix('surface')->name('surface.')->group(function () {
        Route::prefix('inventory')->name('inventory.')->group(function () {
            Route::get('/', [InventoryController::class, 'index'])->name('index');
            Route::post('/store', [InventoryController::class, 'store'])->name('store');
            Route::put('/{id}', [InventoryController::class, 'update'])->name('update');
            Route::post('/upload', [InventoryController::class, 'upload'])->name('upload');
        });

        Route::prefix('stock')->name('stock.')->group(function () {
            // Route::get('/', [InventoryController::class, 'warehouse_index'])->name('index');
            
            Route::get('/', [StockController::class, 'index'])->name('index');
            Route::put('/{id}', [StockController::class, 'update'])->name('update');
            Route::post('/upload', [StockController::class, 'upload'])->name('upload');

            Route::prefix('receive')->name('receive.')->group(function () {
                Route::get('/', [StockController::class, 'receivingIndex'])->name('index');
                
                Route::get('/record', [StockController::class, 'receiveForm'])->name('form');
                Route::post('/receive/store', [StockController::class, 'receivingStore'])->name('store');
            });
            
            Route::prefix('issuance')->name('issuance.')->group(function () {
                Route::get('/', [StockController::class, 'issuanceIndex'])->name('index');

                Route::get('/form', [StockController::class, 'issuanceForm'])->name('form');
                Route::post('/record', [StockController::class, 'issuanceStore'])->name('record');
            });

            Route::get('/requests', [StockController::class, 'stockRequestsIndex'])->name('requests.index');

            Route::prefix('movements')->name('movements.')->group(function () {
                Route::put('/{movement}', [StockController::class, 'updateMovement'])->name('update');
                Route::post('/{movement}/cancel', [StockController::class, 'cancelMovement'])->name('cancel');
                Route::post('/{movement}/approve', [StockController::class, 'approveMovement'])->name('approve');

            });

            Route::get('/load-stock/{id}', [StockController::class, 'loadStockCard'])->name('stock-card');

            Route::get('/logs', [StockController::class, 'logs'])->name('logs');

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
        
        Route::prefix('stock')->name('stock.')->group(function () {
            Route::get('/', [StockController::class, 'index'])->name('index');
            // Route::get('/management', [StockController::class, 'index'])->name('management');
            Route::put('/{id}', [StockController::class, 'update'])->name('update');
            Route::post('/upload', [StockController::class, 'upload'])->name('upload');

            Route::get('/withdrawal', [StockController::class, 'withdrawal'])->name('withdrawal');
            Route::get('/issuance', [StockController::class, 'issuance'])->name('issuance');
            Route::get('/logs', [StockController::class, 'logs'])->name('logs');
        });
    });

    // REPORTS
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::prefix('daily')->name('daily.')->group(function () {
            Route::get('/', [DailyReportController::class, 'daily'])->name('index');
            Route::get('/create', [DailyReportController::class, 'create'])->name('create');
            Route::post('/', [DailyReportController::class, 'store'])->name('store');
            
            Route::get('/{header_id}', [DailyReportController::class, 'loadReport'])->name('load');
        });

        Route::get('/movement-data', [ReportsController::class, 'movement_data'])->name('movement-data');
        
        Route::prefix('pmc-tigerway')->name('pmc-tigerway.')->group(function () {
            // Route::get('/surface', [ReportsController::class, 'surface'])->name('surface');
            // Route::get('/underground', [ReportsController::class, 'underground'])->name('underground');

            Route::get('/consumption', [ReportsController::class, 'weekly_consumption'])->name('consumption');
            Route::get('/rcsu', [ReportsController::class, 'weekly_rcsu'])->name('rcsu');
        });
        
        Route::prefix('mill-mcd')->name('mill-mcd.')->group(function () {
            Route::get('/{type}', [ReportsController::class, 'weekly_mill_mcd'])->name('index');
        });
        
        Route::prefix('pnp')->name('pnp.')->group(function () {
            Route::get('/', [ReportsController::class, 'blaster'])->name('index');
        });

        Route::prefix('mgb')->name('mgb.')->group(function () {
            Route::get('/', [ReportsController::class, 'mgb'])->name('index');
        });

        Route::prefix('explosives')->name('explosives.')->group(function () {
            Route::get('/{type}', [ReportsController::class, 'explosives'])->name('index');
        });


        Route::get('/', [ReportsController::class, 'index'])->name('index');
        // Route::prefix('daily')->name('daily.')->group(function () {
        //     Route::get('/', [ReportsController::class, 'daily_index'])->name('index');
        // });
        // Route::prefix('weekly')->name('weekly.')->group(function () {
        //     Route::get('/', [ReportsController::class, 'weekly_index'])->name('index');
        // });

    });


    Route::prefix('file')->group(function () {
        Route::get('/', [FileController::class, 'index'])->name('file.index');
        Route::post('/upload', [FileController::class, 'upload'])->name('file.upload');

    });
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');

            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
        });

        Route::get('/logs', [ReportsController::class, 'logs'])->name('logs');
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
