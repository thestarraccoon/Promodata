<?php

namespace App\Services\Reports\Prices;

use App\Contracts\Reports\ReportGeneratorInterface;
use App\Enums\FileExtension;
use App\Repositories\ProductRepository;
use Illuminate\Support\Carbon;

class ProductPriceExtremesWeek implements ReportGeneratorInterface
{
    private readonly Carbon $periodStart;
    private readonly Carbon $periodEnd;
    public function __construct(
        private int                        $categoryId,
        private ?ProductRepository $productRepository = null,
    ) {
        $this->productRepository ??= new ProductRepository();
        $this->periodStart = now()->subDays(7);
        $this->periodEnd = now();
    }

    public function generate(): array
    {
        return $this->productRepository
            ->getProductPricesExtremum(
                $this->categoryId,
                $this->periodStart,
                $this->periodEnd
            )
            ->cursor()
            ->toArray();
    }
}
