<?php

namespace App\Http\Controllers;

use App\Models\InactiveGovernment;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class InactiveGovernmentController extends Controller
{
    public function addInactive(Collection $updatedGovernments){
        foreach($updatedGovernments as $inactive){
            InactiveGovernment::create([
                'government_id' => $inactive->id,
            ]);
        }
    }
}
