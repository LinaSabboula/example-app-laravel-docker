<?php

namespace App\Http\Controllers;

use App\Models\Government;
use App\Models\InactiveGovernment;
use Illuminate\Http\Request;

class InactiveGovernmentController extends Controller
{
    public function addInactive(){
        $inactives = Government::where('is_active', false)->get();
        foreach($inactives as $inactive){
            $inactiveGovernment = new InactiveGovernment();
            $inactiveGovernment->government_id = $inactive->id;
            $inactiveGovernment->save();
        }
    }
}
