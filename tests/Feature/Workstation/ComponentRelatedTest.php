<?php

use App\Models\Component;
use App\Models\Workstation;
use App\Models\ComponentCategory;

it("can have only one component with one of the specified categories", function () {
    $this->seed(\Database\Seeders\ComponentCategorySeeder::class);
    $workstation = Workstation::factory()->create();

    $joiCategories = ComponentCategory::where('just_one_instance', true)->get();

    foreach ($joiCategories as $category){
        $components = Component::factory(2)->create(['category_id' => $category->id]);

        $workstation->attachComponent($components[0]);
        expect(fn() => $workstation->attachComponent($components[1]))->toThrow(Exception::class);
    }

    $workstation->load('components');
    expect($workstation->components->count())->toBe($joiCategories->count());
});

it("can have multiple components with other categories than the specified one", function () {
    $otherCategory = ComponentCategory::factory()->create();
    $workstation = Workstation::factory()->create();

    Component::factory(3)->for($workstation)->create(['category_id' => $otherCategory->id]);
    $workstation->load('components');

    expect($workstation->components->where('category_id', $otherCategory->id)->count())->toBe(3);
});
