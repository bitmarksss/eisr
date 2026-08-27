<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DailyReportItem;
use App\Models\DailyReportDetail;

class DailyReportItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DailyReportItem::factory()->count(2)->for(DailyReportDetail::query()->firstOrFail(), 'detail')->create();
    }
}
