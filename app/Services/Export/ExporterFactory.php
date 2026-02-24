<?php

namespace App\Services\Export;

use App\Contracts\ExporterInterface;
use InvalidArgumentException;

class ExporterFactory
{
    public static function create(string $format = 'csv'): ExporterInterface
    {
        return match (strtolower($format)) {
            'csv' => new CsvExporter(),

            default => throw new InvalidArgumentException("Формат '{$format}' не поддерживается")
        };
    }
}
