<?php

use App\Models\Address;

it("can be created with required arguments", function () {
    $data = Address::factory()->raw();

    $address = Address::create($data);

    expect($address->street)->toBe($data['street']);
    expect($address->zip_code)->toBe($data['zip_code']);
    expect($address->city)->toBe($data['city']);
    expect($address->country)->toBe($data['country']);
});

it("fails to be created with missed required arguments", function () {
    expect(fn() => Address::factory()->create(['street' => null]))->toThrow(\Illuminate\Database\QueryException::class);
    expect(fn() => Address::factory()->create(['zip_code' => null]))->toThrow(\Illuminate\Database\QueryException::class);
    expect(fn() => Address::factory()->create(['city' => null]))->toThrow(\Illuminate\Database\QueryException::class);
    expect(fn() => Address::factory()->create(['country' => null]))->toThrow(\Illuminate\Database\QueryException::class);
});

it("can be created with optional name", function () {
    $data = Address::factory()->withName()->raw();

    $address = Address::create($data);

    expect($address->name)->toBe($data['name']);
});

it("fails if the name is not unique", function () {
    $data1 = Address::factory()->withName()->raw();
    $data2 = Address::factory()->withName($data1['name'])->raw();

    Address::create($data1);

    expect(fn() => Address::create($data2))->toThrow(\Exception::class);
});
