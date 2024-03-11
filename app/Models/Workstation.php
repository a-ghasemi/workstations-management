<?php

namespace App\Models;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
