<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'street',
        'building',
        'floor_number',
        'apartment_number',
        'user_id',
        'area_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function area(){
        return $this->belongsTo(Area::class);
    }

}
