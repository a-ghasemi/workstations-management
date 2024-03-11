<?php

use App\Models\Component;

it("can be created with required arguments", function () {
    $data = Component::factory()->raw();

    $component = Component::create($data);

    expect($component->type->id)->toBe($data['type_id']);
    expect($component->category->id)->toBe($data['category_id']);
    expect($component->make)->toBe($data['make']);
    expect($component->model)->toBe($data['model']);
});

it("fails to be created with missed required arguments", function () {
    expect(fn() => Component::factory()->create(['type' => null]))->toThrow(\Illuminate\Database\QueryException::class);
    expect(fn() => Component::factory()->create(['category' => null]))->toThrow(\Illuminate\Database\QueryException::class);
    expect(fn() => Component::factory()->create(['make' => null]))->toThrow(\Illuminate\Database\QueryException::class);
    expect(fn() => Component::factory()->create(['model' => null]))->toThrow(\Illuminate\Database\QueryException::class);
});

it("can be created with optional serial number", function () {
    $data = Component::factory()->withSerialNumber()->raw();

    $component = Component::create($data);

    expect($component->serial_number)->toBe($data['serial_number']);
});

it("fails to create if the serial number is not unique", function () {
    $data1 = Component::factory()->withSerialNumber()->raw();
    $data2 = Component::factory()->withSerialNumber($data1['serial_number'])->raw();

    Component::create($data1);

    expect(fn() => Component::create($data2))->toThrow(\Exception::class);
});

it("can have properties", function () {
    $properties = [
        'property1' => 'value1',
        'property2' => 'value2',
    ];

    $component = Component::factory()->create(['properties' => $properties]);

    expect($component->properties)->toBeArray()->toBe($properties);
});
