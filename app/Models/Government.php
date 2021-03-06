<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Government extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_active'
    ];
    public function cities(){
        return $this->hasMany(City::class);
    }
    public function inactiveGovernments(){
        return $this->hasMany(InactiveGovernment::class);
    }
}
