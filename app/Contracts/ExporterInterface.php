<?php

namespace App\Contracts;

interface ExporterInterface
{
    public function export(array $data, string $filename, array $headers = []): string;
}
