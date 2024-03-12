<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SimpleImport implements ToCollection
{
    public function collection(Collection $collection)
    {
        return $collection;
    }
}
