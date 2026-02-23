<?php

namespace App\Console\Commands;

use App\Enums\Reports\ReportType;
use App\Services\Export\ExporterFactory;
use App\Services\Reports\Logger\ReportProcessLogger;
use App\Services\Reports\ReportFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class GeneratePriceReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:prices {category_id} {--format=csv}';

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
        $format = $this->option('format') ?: 'csv';

        $logger = new ReportProcessLogger();
        $logger->start();

        try {
            $reportData = ReportFactory::create(ReportType::PRICE_EXTREMES_WEEK, $categoryId)->generate();

            if (empty($reportData)) {
                $this->error("Нет данных для категории #{$categoryId}");
                $logger->error("Нет данных для категории #{$categoryId}");
                return self::FAILURE;
            }

            $filename = sprintf('report_%d_%s', $categoryId, now()->format('Y-m-d_H-i-s'));
            $headers = ['manufacturer_name', 'product_name', 'price', 'price_date'];
            $exporter = ExporterFactory::create($format);

            try {
                $filePath = $exporter->export($reportData, $filename, $headers);

                $logger->success($filePath);

                $this->info("Отчёт сохранён: {$filePath}");
                $this->info("Строк в отчёте: " . count($reportData));

            } catch (\Exception $fileError) {
                $logger->error($fileError->getMessage());
                $this->error("Ошибка записи файла: " . $fileError->getMessage());
                return self::FAILURE;
            }

            return self::SUCCESS;

        } catch (\Exception $e) {
            $logger->error($e->getMessage());
            $this->error("Ошибка генерации данных: " . $e->getMessage());
            return self::FAILURE;
        }
    }
}
