<?php
namespace App\Services\Reports;

use App\Contracts\Reports\ReportGeneratorInterface;
use App\Enums\FileExtension;
use App\Enums\Reports\ReportType;
use App\Services\Reports\Prices\ProductPriceExtremesWeek;
use InvalidArgumentException;

class ReportFactory
{
    public static function create(string $reportType, int $categoryId): ReportGeneratorInterface
    {
        return match($reportType) {
            ReportType::PRICE_EXTREMES_WEEK => new ProductPriceExtremesWeek($categoryId),

            default => throw new InvalidArgumentException("Report type {$reportType} not supported")
        };
    }
}
