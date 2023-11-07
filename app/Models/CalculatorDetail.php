<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalculatorDetail extends Model
{
    use HasFactory;

    protected $table = 'calculators';

    protected $fillable = [
        'calculator_id', 'operator_id', 'first_number', 'last_number'
    ];
}