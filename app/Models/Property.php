<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $primaryKey = 'property_id';

    protected $fillable = [
        'type',
        'price',
        'location',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'property_id', 'property_id');
    }
}
