<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DailyReportsItem;
use App\Models\DailyReportsDetail;

class DailyReportItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DailyReportsItem::factory()->count(2)->for(DailyReportsDetail::query()->firstOrFail(), 'detail')->create();
    }
}
