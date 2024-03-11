<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComponentCategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }

    public function withJustOneInstance(): self
    {
        return $this->state(function (){
            return [
                'just_one_instance' => true,
            ];
        });
    }
}
