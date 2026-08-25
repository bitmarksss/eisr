<?php
namespace Database\Seeders;
use App\Models\DailyReportsDetail;
use App\Models\DailyReportsHeader;
use Illuminate\Database\Seeder;
class DailyReportDetailSeeder extends Seeder { public function run(): void { DailyReportsDetail::factory()->count(2)->for(DailyReportsHeader::query()->firstOrFail(), 'header')->create(); } }
