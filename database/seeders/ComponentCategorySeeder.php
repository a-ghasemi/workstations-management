<?php

namespace Database\Seeders;

use App\Models\ComponentCategory;
use Illuminate\Database\Seeder;

class ComponentCategorySeeder extends Seeder
{
    // joi : just one instance
    protected $joi_component_categories = [
        'Desktop',
        'Laptop',
        'Tablet',
        'ThinClient',
    ];

    public function run(): void
    {
        foreach ($this->joi_component_categories as $category) {
            ComponentCategory::create([
                'name' => $category,
                'just_one_instance' => true,
            ]);
        }
    }
}
