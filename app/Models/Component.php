<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'workstation_id',
        'type_id',
        'category_id',
        'make',
        'model',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ComponentType::class);
    }
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ComponentCategory::class);
    }

    public function workstation()
    {
        return $this->belongsTo(Workstation::class);
    }

}
