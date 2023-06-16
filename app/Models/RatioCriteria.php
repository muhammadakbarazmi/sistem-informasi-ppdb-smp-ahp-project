<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatioCriteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'v_criteria_id',
        'h_criteria_id',
        'value',
    ];
}
