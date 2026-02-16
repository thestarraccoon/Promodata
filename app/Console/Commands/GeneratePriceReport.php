<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GeneratePriceReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:prices {category_id} {--extension}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate price report for 7 days ago';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $start = now()->subDays(7);
        $end = now();

        $this->info("Отчет готов {$start} - {$end}");

        return 0;
    }
}
