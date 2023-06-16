<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Criteria extends Model
{
    use SoftDeletes;

    protected $fillable = ['code', 'name'];

    public static function getIdfromName($name){
        $data = Criteria::where('name', '=', $name)->first();
        return $data->id;
    }
}
