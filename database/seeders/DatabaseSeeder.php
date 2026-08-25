<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            UserFactorySeeder::class, // Test
            SupplierSeeder::class, // Test
            InventoryKindSeeder::class,
            InventoryItemSeeder::class, // Test
            LevelSeeder::class, // Test
            InventoryStockSeeder::class, // Test
            StockSeeder::class, // Test
            StockMovementSeeder::class, // Test
            DailyReportsHeaderSeeder::class,
            DailyReportDetailSeeder::class,
            DailyReportItemSeeder::class,
            DailyReportDirectionSeeder::class,
        ]);
    }
}
