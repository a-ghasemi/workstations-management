<?php

namespace App\services\ImportData;

use Illuminate\Support\Collection;

class ImportExecutor
{
    private readonly IStrategy $strategy;

    public function __construct(IStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function execute(mixed $source): void
    {
        $this->strategy->importData($source);
    }
}
