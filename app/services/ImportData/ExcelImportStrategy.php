<?php

namespace App\services\ImportData;

use App\Imports\SimpleImport;
use App\Models\Address;
use App\Models\Component;
use App\Models\ComponentCategory;
use App\Models\ComponentType;
use App\Models\User;
use App\Models\Workstation;
use App\services\ImportData\Validators\UserValidator;
use App\services\ImportData\Validators\ValidationException;
use App\services\ImportData\Validators\WorkstationValidator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExcelImportStrategy implements IStrategy
{
    const HEADERS = [
        'workstation_name'     => 0,
        'workstation_remark'   => 1,
        'user_email'           => 2,
        'user_name'            => 3,
        'user_employee_number' => 4,
        'user_phone_number'    => 5,
        'address_name'         => 6,
        'address_street'       => 7,
        'address_zipcode'      => 8,
        'address_city'         => 9,
        'address_country'      => 10,
    ];
    const COMPONENT_HEADERS = [
        'component_type'            => 0,
        'component_category'        => 1,
        'component_make'            => 2,
        'component_model'           => 3,
        'component_serial_number'   => 4,
        'component_display_size'    => 5,
        'component_keyboard_layout' => 6,
    ];

    protected $validators;

    public function __construct()
    {
        $this->validators = [
            new WorkstationValidator(),
            new UserValidator(),
        ];
    }

    public function importData($source): void
    {
        $raw_data = Excel::toCollection(new SimpleImport(), $source);

        $records = $this->extractData($raw_data);

        $this->validateData($records);

        $this->updateDatabase($records);
    }

    protected function extractData(Collection $collection): Collection
    {
        return $collection->first()->slice(1)->map(function ($row) {
            $data = [
                'workstation' => [
                    'name'   => $row[self::HEADERS['workstation_name']],
                    'remark' => $row[self::HEADERS['workstation_remark']],
                ],
                'user'        => [
                    'email'      => $row[self::HEADERS['user_email']],
                    'name'       => $row[self::HEADERS['user_name']],
                    'properties' => [
                        'employee_number' => $row[self::HEADERS['user_employee_number']],
                        'phone_number'    => $row[self::HEADERS['user_phone_number']],
                    ]
                ],
                'address'     => [
                    'name'     => $row[self::HEADERS['address_name']],
                    'street'   => $row[self::HEADERS['address_street']],
                    'zip_code' => $row[self::HEADERS['address_zipcode']],
                    'city'     => $row[self::HEADERS['address_city']],
                    'country'  => $row[self::HEADERS['address_country']],
                ],
                'components'  => [],
            ];
            return $this->extractComponents($row, $data);
        });
    }

    protected function updateDatabase(Collection $records): void
    {
        DB::beginTransaction();
        foreach ($records as $row_number => $record) {
            try {
                $user = (isset($record['user']['email'])) ?
                    User::firstOrCreate(['email' => $record['user']['email']], $record['user'])
                    : null;
                $address = Address::firstOrCreate(
                    ['name' => $record['address']], //TODO: name is not good enough to stop address separation
                    $record['address']
                );

                $workstation = Workstation::create([
                    'name'       => $record['workstation']['name'],
                    'user_id'    => $user?->id,
                    'address_id' => $address->id,
                    'properties' => [
                        'remark' => $record['workstation']['remark'],
                    ],
                ]);

                foreach ($record['components'] as $component) {
                    $type = ComponentType::firstOrCreate(
                        ['name' => $component['component_type']],
                        ['name' => $component['component_type']]
                    );
                    $category = ComponentCategory::firstOrCreate(
                        ['name' => $component['component_category']],
                        ['name' => $component['component_category']],
                    );
                    $component = Component::create([
                        'serial_number' => null,
                        'type_id'       => $type->id,
                        'category_id'   => $category->id,
                        'make'          => $component['component_make'],
                        'model'         => $component['component_model'],
                        'properties'    => $component['properties'] ?? null,
                    ]);
                    $workstation->attachComponent($component);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                throw new \Exception(
                    "Message:" . $e->getMessage()
                    . "\nExcel row no: " . ($row_number + 1)
                    . "\nTrace:" . $e->getTraceAsString()
                );
            }
        }
        DB::commit();
    }

    protected function extractComponents($row, array $data): array
    {
        $col_index = count(self::HEADERS);
        while ($col_index < count($row)) {
            $component = [];
            foreach (self::COMPONENT_HEADERS as $header => $offset) {
                $component[$header] = $row[$col_index + $offset] ?? null;
            }
            $col_index += count(self::COMPONENT_HEADERS);

            if (!array_filter($component, function ($value) {
                return !is_null($value);
            })) {
                continue;
            }

            $data['components'][] = $component;
        }
        return $data;
    }

    protected function validateData(Collection $records): void
    {
        $errors = [];

        foreach ($this->validators as $validator) {
            $validatorErrors = $validator->validate($records);
            $errors = array_merge($errors, $validatorErrors);
        }

        if (!empty($errors)) {
            throw new ValidationException($errors);
        }
    }
}
