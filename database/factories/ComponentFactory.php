<?php

namespace Database\Factories;

use App\Models\ComponentCategory;
use App\Models\ComponentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComponentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'type_id'     => ComponentType::count() ?
                ComponentType::all()->random()->id
                : ComponentType::factory()->create()->id,
            'category_id' => ComponentCategory::count() ?
                ComponentCategory::all()->random()->id
                : ComponentCategory::factory()->create()->id,
            'make'        => fake()->name(),
            'model'       => fake()->name(),
        ];
    }

    public function withSerialNumber(string $serial_number = null): self
    {
        return $this->state(function () use ($serial_number) {
            return [
                'serial_number' => $serial_number ?? Str::random(10),
            ];
        });
    }

}
