<?php

it('shows upload form',function (){
    $response = $this->get(route('import.excel.create'));
    $response->assertStatus(200);
    $response->assertSee('Working Station | Import');
});
