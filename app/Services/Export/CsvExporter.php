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

        Storage::disk('public')->put($path, $this->generateCsv($data, $headers));

        return $path;
    }

    private function generateCsv(array $data, array $headers): string
    {
        $handle = fopen('php://temp', 'r+');

        if (!empty($headers)) {
            fputcsv($handle, $headers);
        }

        foreach ($data as $row) {
            fputcsv($handle, (array) $row);
        }

        rewind($handle);

        $csv = stream_get_contents($handle);

        fclose($handle);

        return $csv;
    }
}
