<?php

namespace App\services\ImportData\Validators;

use App\Models\User;
use App\services\ImportData\Validators\IValidator;

class UserValidator implements IValidator
{

    public function validate($data): array
    {
        $errors = [];

        foreach ($data as $row_index => $row) {
            $email = $row['user']['email'] ?? null;
            $name = $row['user']['name'] ?? null;
            $workstationName = $row['workstation']['name'] ?? null;

            if (!empty($workstationName) && empty($email) && empty($name)) {
                continue;
            }

            // Validate user only if email or name is provided
            if (!empty($email) || !empty($name)) {
                if (empty($name)) {
                    $errors[] = [
                        "row_number" => $row_index + 2,
                        "message"    => "User name is required if a user is provided."
                    ];
                }

                if (empty($email)) {
                    $errors[] = [
                        "row_number" => $row_index + 2,
                        "message"    => "User email is required if a user is provided."
                    ];
                } elseif (!$this->isEmailUnique($email, $name)) {
                    $errors[] = [
                        "row_number" => $row_index + 2,
                        "message"    => "User email must be unique."
                    ];
                }
            }
        }

        return $errors;
    }

    protected function isEmailUnique($email, $name): bool
    {
        return User::where('email', $email)->whereNot('name', $name)->doesntExist();
    }
}
