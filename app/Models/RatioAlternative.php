<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatioAlternative extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_id',
        'v_alternative_id' ,
        'h_alternative_id' ,
        'value' ,
    ];
}
