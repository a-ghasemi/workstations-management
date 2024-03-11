<?php

namespace App\Models;

use App\Events\WorkstationCreating;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'address_id',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array'
    ];

    protected $dispatchesEvents = [
        'creating' => WorkstationCreating::class,
        'updating' => WorkstationCreating::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}
