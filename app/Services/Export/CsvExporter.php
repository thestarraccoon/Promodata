<?php

namespace App\Services\Export;

use App\Contracts\ExporterInterface;
use App\Enums\FileExtension;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class CsvExporter implements ExporterInterface
{
    private string $extension = FileExtension::CSV;
    public function export(array $data, string $filename, array $headers = []): string
    {
        $path = "reports/{$filename}.{$this->extension}";

        $absolutePath = Storage::path($path);

        $directory = dirname($absolutePath);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $handle = fopen($absolutePath, 'w');

        if (!empty($headers)) {
            fputcsv($handle, $headers);
        }

        foreach ($data as $row) {
            fputcsv($handle, (array) $row);
        }

        fclose($handle);

        return $absolutePath;
    }
}
