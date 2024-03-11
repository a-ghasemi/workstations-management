<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'street'   => fake()->streetAddress,
            'zip_code' => fake()->randomNumber(5) . ' ' . Str::random(2),
            'city'     => fake()->city,
            'country'  => fake()->country,
        ];
    }

    public function withName(string $name = null): self {
        return $this->state(function (array $attributes) use ($name) {
            return [
                'name' => $name ?? fake()->name(),
            ];
        });
    }
}
