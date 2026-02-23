<?php
namespace Database\Seeders;

use App\Enums\ProcessStatuses;
use App\Models\ProcessStatus;
use Illuminate\Database\Seeder;

class ProcessStatusesSeeder extends Seeder
{
    public function run(): void
    {
        ProcessStatus::create(['ps_name' => ProcessStatuses::RUNNING]);
        ProcessStatus::create(['ps_name' => ProcessStatuses::COMPLETED]);
        ProcessStatus::create(['ps_name' => ProcessStatuses::FAILED]);
    }
}
