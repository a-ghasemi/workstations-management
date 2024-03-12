<?php

use App\Models\Workstation;
use App\Models\Address;
use App\Models\Component;
use App\Models\User;

beforeAll(function (){
    User::factory()->count(10)->create();
    Address::factory()->count(10)->create();
    Workstation::factory()->count(10)->create()->each(function ($workstation) {
        Component::factory()->count(10)->create([
            'workstation_id' => $workstation->id,
        ]);
    });
});

it('shows all workstations in homepage',function (){
    $response = $this->get(route('home'));
    $response->assertStatus(200);
    $response->assertSee('Working Stations List');

    Workstation::all()->each(function ($workstation) use ($response) {
        $response->assertSee($workstation->id);
        $response->assertSee($workstation->name);
    });
});

it('shows workstation details',function (){
    Workstation::all()->each(function ($workstation) {
        $response = $this->get(route('workstations.show', $workstation));
        $response->assertStatus(200);
        $response->assertSee($workstation->id);
        $response->assertSee($workstation->name);
        $response->assertSee($workstation->address->name);
        $response->assertSee($workstation->address->street);
        $response->assertSee($workstation->address->zip_code);
        $response->assertSee($workstation->address->city);
        $response->assertSee($workstation->address->country);

        $workstation->components->each(function ($component) use ($response) {
            $response->assertSee($component->id);
            $response->assertSee($component->serial_number);
            $response->assertSee($component->type->name);
            $response->assertSee($component->category->name);
            $response->assertSee($component->make);
            $response->assertSee($component->model);
        });

    });
});

