<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function workstations() {
        return $this->hasMany(Workstation::class);
    }
}
