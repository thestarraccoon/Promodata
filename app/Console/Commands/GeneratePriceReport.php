<?php

namespace App\Console\Commands;

use App\Enums\Reports\ReportType;
use App\Services\Reports\ReportFactory;
use Illuminate\Console\Command;

class GeneratePriceReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:prices {category_id}';

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
        $categoryId = (int) $this->argument('category_id');

        try {
            $reportData = ReportFactory::create(ReportType::PRICE_EXTREMES_WEEK, $categoryId)->generate();
            dd($reportData);

            $this->info("Отчет готов для категории #{$categoryId}");

            return self::SUCCESS;

        } catch (\Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
