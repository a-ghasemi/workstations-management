<?php

namespace App\services\ImportData\Validators;

interface IValidator
{
    public function validate($data): array;
}
