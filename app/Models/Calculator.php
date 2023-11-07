<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Calculator extends Model
{
    use HasFactory;

    protected $table = 'calculators';

    protected $fillable = [
        'chat', 'operator', 'first_number', 'last_number', 'result'
    ];

    public function operation(): BelongsTo
    {
        return $this->belongsTo(Operation::class, 'operator_id');
    }
}