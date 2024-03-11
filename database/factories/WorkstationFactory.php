<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkstationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'       => fake()->words(3, true),
            'user_id'    => User::count() ? User::all()->random()->id : User::factory()->create()->id,
            'address_id' => Address::count() ? Address::all()->random()->id : Address::factory()->create()->id,
            'properties' => [],
        ];
    }
}
