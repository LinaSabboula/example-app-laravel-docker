<?php

namespace App\Http\Controllers;

use App\Models\Government;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GovernmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
//        TODO custom validation government names, dropdown list?
        $errorMessages = [
            'name.required' => 'Please provide a government',
            'name.unique' => 'Government already exists!',
        ];
        $validator = Validator::make($request->all(),[
                'name' => 'required|string|unique:governments,name',
                ], $errorMessages);

        if ($validator -> fails()){
            $errors = $validator->errors()->first();
            return response($errors, 400)
                ->header('Content-Type', 'text/plain');
        }
        else{
            try{
                Government::create([
                    'name' => $request->name,
                ]);
            }
            catch(Exception $e){
                return response($e->getMessage(), 400)
                    ->header('Content-Type', 'text/plain');
            }
            return response("New government entry [".$request->name ."] was created ", 200)
                            ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function show(Government $government)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function edit(Government $government)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Government $government)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Government  $government
     * @return \Illuminate\Http\Response
     */
    public function destroy(Government $government)
    {
        //
    }
}
