<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Operation extends Model
{
    use HasFactory;

    protected $table = 'operations';

    protected $fillable = [
        'name', 'operator', 'description',
    ];

    public function calculators(): HasMany
    {
        return $this->hasMany(Calculator::class);
    }
}