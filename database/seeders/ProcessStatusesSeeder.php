<?php
namespace Database\Seeders;

use App\Models\ProcessStatus;
use Illuminate\Database\Seeder;

class ProcessStatusesSeeder extends Seeder
{
    public function run(): void
    {
        ProcessStatus::create(['ps_name' => 'created']);
        ProcessStatus::create(['ps_name' => 'running']);
        ProcessStatus::create(['ps_name' => 'completed']);
        ProcessStatus::create(['ps_name' => 'failed']);
        ProcessStatus::create(['ps_name' => 'cancelled']);
    }
}
