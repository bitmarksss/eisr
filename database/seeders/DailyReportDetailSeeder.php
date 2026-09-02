<?php
namespace Database\Seeders;
use App\Models\DailyReportDetail;
use App\Models\DailyReportHeader;
use Illuminate\Database\Seeder;

class DailyReportDetailSeeder extends Seeder { 
    public function run(): void 
    { 
        // DailyReportDetail::factory()
        //     ->count(2)
        //     ->for(
        //         DailyReportHeader::query()
        //         ->firstOrFail(), 
        //         'header'
        //     )
        //     ->create(); 

        $header = DailyReportHeader::query()->firstOrFail();
        
        // Create 1-3 records for each of the 3 shifts
        for ($shift = 1; $shift <= 3; $shift++) {
            DailyReportDetail::factory()
                ->count(random_int(1, 3))  // Random 1-3 records per shift
                ->for($header, 'header')
                ->state(['shift_no' => $shift])  // Lock shift_no
                ->create();
        }
    }
}
