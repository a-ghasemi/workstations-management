<?php

namespace App\services\ImportData;

use Illuminate\Support\Collection;

interface IStrategy
{
    public function importData($source): void;
}
