<?php
namespace Database\Seeders;
use App\Models\DailyReportDetail;
use App\Models\DailyReportHeader;
use Illuminate\Database\Seeder;
class DailyReportDetailSeeder extends Seeder { public function run(): void { DailyReportDetail::factory()->count(2)->for(DailyReportHeader::query()->firstOrFail(), 'header')->create(); } }
