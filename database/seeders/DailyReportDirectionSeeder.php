<?php
namespace Database\Seeders;
use App\Models\DailyReportDirection;
use App\Models\DailyReportDetail;
use Illuminate\Database\Seeder;

class DailyReportDirectionSeeder extends Seeder { 
    
    public function run(): void 
    { 
        DailyReportDirection::factory()->count(2)->for(DailyReportDetail::query()->firstOrFail(), 'detail')->create(); 
    } 
}
