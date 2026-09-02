<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\InventoryItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UnitOfMeasurementSeeder::class,
            SuperAdminSeeder::class,
            PermissionSeeder::class,

            // Test
            UserFactorySeeder::class, 
            SupplierSeeder::class, 
            InventoryKindSeeder::class,
            InventoryItemSeeder::class, 
            LevelSeeder::class, 
            InventoryStockSeeder::class, 
            StockSeeder::class, 
            StockMovementSeeder::class, 
            // LocationSeeder::class, 
            DailyReportHeaderSeeder::class,
            DailyReportDetailSeeder::class,
            DailyReportItemSeeder::class,
            DailyReportDirectionSeeder::class,
        ]);

        // dump([
        //     'inventory_items' => InventoryItem::count(),
        // ]);
    }
}
