<?php

namespace App\Contracts\Reports;

interface ReportGeneratorInterface
{
    public function generate(): array;
}
