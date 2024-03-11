<?php


uses(
    Tests\TestCase::class,
     Illuminate\Foundation\Testing\LazilyRefreshDatabase::class,
)->in('Unit', 'Feature');

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

