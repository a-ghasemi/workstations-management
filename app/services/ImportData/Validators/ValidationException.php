<?php

namespace App\services\ImportData\Validators;

class ValidationException extends \Exception
{
    protected $errors = [];

    public function __construct(array $errors = [], int $code = 0, \Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct("Validation error(s) occurred", $code, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getErrorMessages(): string
    {
        $output = [];

        foreach($this->errors as $error) {
            $output[] = "Validation error on row #" . $error['row_number']. ": " . $error['message'];
        }

        return implode("\n", $output);
    }
}
