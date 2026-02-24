<?php

namespace App\Repositories;

use DateTimeInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
class ProductRepository
{
    public function getProductPricesExtremum(
        int $categoryId,
        DateTimeInterface $start = null,
        DateTimeInterface $end = null
    ): Builder
    {
        return DB::table('products as p')
            ->join('manufacturers as m', 'p.id', '=', 'm.id')
            ->joinSub(
                DB::table('prices')
                    ->whereBetween('price_date', [$start, $end])
                    ->selectRaw('
                        product_id,
                        price,
                        price_date,
                        ROW_NUMBER() OVER (
                            PARTITION BY product_id
                            ORDER BY
                                CASE
                                    WHEN price = (
                                        SELECT MIN(price)
                                        FROM prices p2
                                        WHERE p2.product_id = prices.product_id
                                        AND p2.price_date BETWEEN ? AND ?
                                    ) THEN 1
                                    WHEN price = (
                                        SELECT MAX(price)
                                        FROM prices p2
                                        WHERE p2.product_id = prices.product_id
                                        AND p2.price_date BETWEEN ? AND ?
                                    ) THEN 2
                                END
                        ) as rn
                    ', [$start, $end, $start, $end]),
                'pr',
                fn($join) => $join
                    ->on('p.id', '=', 'pr.product_id')
                    ->whereIn('pr.rn', [1, 2])
            )
            ->where('p.category_id', $categoryId)
            ->selectRaw('
                m.manufacturer_name,
                p.product_name,
                pr.price,
                pr.price_date
            ')
            ->orderBy('p.id')
            ->orderBy('pr.price','desc');
    }
}
