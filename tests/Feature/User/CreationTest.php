<?php

use App\Models\User;
use App\Models\Workstation;

it("can create a user with valid data", function () {
    $data = [
        'name'       => 'Example User',
        'email'      => 'user@example.com',
        'properties' => ['age' => 25, 'gender' => 'male'],
    ];

    User::create($data);
    $retrievedUser = User::where('email', 'user@example.com')->first();

    expect($retrievedUser)->toBeInstanceOf(User::class)->not->toBeNull();
    expect($retrievedUser->name)->toBe($data['name']);
    expect($retrievedUser->email)->toBe($data['email']);
    expect($retrievedUser->properties)->toBeArray()->toBe($data['properties']);
});

it("can create with no properties", function () {
    $data = [
        'name'       => 'Example User',
        'email'      => 'user@example.com',
    ];

    $user = User::create($data);
    $returnedUser = User::find($user->id);

    expect($returnedUser)->toBeInstanceOf(User::class)->not->toBeNull();
    expect($returnedUser->name)->toBe($data['name']);
    expect($returnedUser->email)->toBe($data['email']);
    expect($returnedUser->properties)->toBeEmpty();
});

it("fails user creation by duplicate email", function () {
    User::create([
        'name'       => 'Example User',
        'email'      => 'user@example.com',
    ]);

    expect(fn() => User::create([
        'name'       => 'Example User 2',
        'email'      => 'user@example.com',
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

it("fails user creation by empty name", function () {
    expect(fn() => User::create([
        'name'       => '',
    ]))->toThrow(\Illuminate\Database\QueryException::class);
});

it("can add multiple workstations to a user", function () {
    $user = User::create([
        'name'       => 'Example User',
        'email'      => 'user@example.com',
    ]);

    $workstations = Workstation::factory()->count(5)->create([
        'user_id' => $user->id
    ]);

    $retrievedUser = User::find($user->id);
    $retrievedWorkstations = $retrievedUser->workstations;
    expect($retrievedWorkstations->toArray())->toEqual($workstations->toArray());
});

