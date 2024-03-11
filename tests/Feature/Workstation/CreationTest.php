<?php

use App\Models\User;
use App\Models\Workstation;

it("can be created just using a name", function () {
    $data = [
        'name' => 'Example Workstation',
    ];

    Workstation::create($data);
    $retrievedWorkstation = Workstation::where('name', $data['name'])->first();

    expect($retrievedWorkstation)->toBeInstanceOf(Workstation::class)->not->toBeNull();
});

it("can be created just using an assigned user", function () {
    $user = User::factory()->create();
    $data = [
        'user_id' => $user->id,
    ];

    Workstation::create($data);
    $retrievedWorkstation = Workstation::where('user_id', $user->id)->first();

    expect($retrievedWorkstation)->toBeInstanceOf(Workstation::class)->not->toBeNull();
});

it("can be created using a name and an assigned user", function () {
    $user = User::factory()->create();
    $data = [
        'user_id' => $user->id,
        'name'    => "Example Workstation",
    ];

    Workstation::create($data);
    $retrievedWorkstation = Workstation::where('user_id', $user->id)->first();

    expect($retrievedWorkstation->name)->toBe($data['name']);
    expect($retrievedWorkstation)->toBeInstanceOf(Workstation::class)->not->toBeNull();
});

it("fails to be created without name or assigned user", function () {
    $data = [];
    expect(fn() => Workstation::create($data))->toThrow(Exception::class);
});

it("can have properties", function () {
    $properties = [
        'property1' => 'value1',
        'property2' => 'value2',
    ];

    $workstation = Workstation::factory()->create(['properties' => $properties]);

    expect($workstation->properties)->toBeArray()->toBe($properties);
});

it("fails if the name is not unique", function () {
    $data = [
        'name' => 'Example Workstation',
    ];
    Workstation::create($data);

    expect(fn() => Workstation::create($data))->toThrow(\Illuminate\Database\QueryException::class);
});
