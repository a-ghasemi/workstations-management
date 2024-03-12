<?php

namespace App\services\ImportData\Validators;

use App\Models\Workstation;
use App\services\ImportData\Validators\IValidator;

class WorkstationValidator implements IValidator
{

    public function validate($data): array
    {
        $errors = [];

        foreach ($data as $row_index => $row) {
            $hasUniqueName = !empty($row['workstation']['name']) && $this->isNameUnique($row['workstation']['name']);
            $hasUser = !empty($row['user']['email']);

            if (!$hasUniqueName && !$hasUser) {
                $errors[] = [
                    "row_number" => $row_index + 2,
                    "message"    => "Each workstation must have either a unique name or a user."
                ];
            }
        }

        return $errors;
    }

    protected function isNameUnique($name)
    {
        return Workstation::where('name', $name)->doesntExist();
    }
}
