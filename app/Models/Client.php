<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $primaryKey = 'client_id';

    protected $fillable = [
        'name',
        'phone',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'client_id', 'client_id');
    }
}
