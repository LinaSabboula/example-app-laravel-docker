<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    function city(){
        return $this->belongsTo(City::class);
    }
    function addresses(){
        return $this->hasMany(Address::class);
    }
}
