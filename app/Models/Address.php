<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'street',
        'buildng_number',
        'floor_number',
        'apartment_number',
    ];
    function user(){
        $this->belongsTo(User::class);
    }

}
