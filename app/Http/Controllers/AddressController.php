<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Address;
use Exception;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'street' => 'required|string',
            'building' => 'required|string',
            'floor_number' => 'nullable|numeric',
            'apartment_number' => 'nullable|numeric',
            'user_id' => 'exists:users,id',
            'area_id' => 'exists:areas,id',
        ]);

        if ($validator->fails()) {
            return response('Validation Failed', 400)
                        ->header('Content-Type', 'text/plain');
        }
        else{
            try{
                Address::create([
                    'street' => $request->street,
                    'building' => $request->building,
                    'floor_number' => $request->floor_number,
                    'apartment_number' => $request->apartment_number,
                    'user_id' => $request->user_id,
                    'area_id' => $request->area_id
                ]);
            }
            catch(Exception $e){
                return response($e->getMessage(), 400)
                                ->header('Content-Type', 'text/plain');
            }
            return response('Successfully created new Address entry', 200)
                            ->header('Content-Type', 'text/plain');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Display all addresses associated with a specific user
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showUserAddresses($id){
        $validator = Validator::make(['id' => $id], [
            'id' => 'exists:users,id',
        ]);
        if ($validator->fails()) {
            return response('user_id is invalid', 400)
                    ->header('Content-Type', 'text/plain');
        }
        else{
            $addresses = Address::where('user_id', $id)
                                        ->orderByDesc('created_at')
                                        ->get();
            return response($addresses, 200)
                ->header('Content-Type', 'application/json');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
