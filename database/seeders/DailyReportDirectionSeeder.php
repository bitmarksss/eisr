<?php
namespace Database\Seeders;
use App\Models\DailyReportsDirection;
use App\Models\DailyReportsDetail;
use Illuminate\Database\Seeder;
class DailyReportDirectionSeeder extends Seeder { public function run(): void { DailyReportsDirection::factory()->count(2)->for(DailyReportsDetail::query()->firstOrFail(), 'detail')->create(); } }
