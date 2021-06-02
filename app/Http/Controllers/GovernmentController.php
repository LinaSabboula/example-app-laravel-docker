<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Government;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $governments = Government::select('id', 'name')
                        ->orderBy('created_at')
                        ->get();
        return response($governments, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     *  Display activated governments
     * @return \Illuminate\Http\Response
     */
    public function getActive(){
        $governments = Government::where('is_active', true)->get();
        return response($governments, 200)
            ->header('Content-Type', 'application/json');
    }

    /**
     * Deactivate inactive governments in DB
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function deactivateGovernments(){
        $governments = Government::doesnthave('cities')
            ->where('is_active', true)
            ->get();
        foreach ($governments as $government){
            $government->update(['is_active' => false]);
        }
        return $governments;
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
     * get count of `governments`
     * @return \Illuminate\Http\Response
     */
    public function getCount(){
        try {
            $count = DB::table('governments')->count();
        }
        catch (Exception $e){
            return response($e->getMessage(), 400)
                ->header('Content-Type', 'text/plain');
        }
        return response($count, 200)
            ->header('Content-Type', 'text/plain');
    }

    /**
     * Delete a specified government if it is not a foreign key in `cities` table
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        $rules = [
            'id' => [
                'exists:governments,id',
                function($attribute, $id, $fails){
                    $cities = City::where('government_id', $id)->get();
                    if(sizeof($cities) > 0){
                        $fails("Cannot delete government in use!");
                    }

                }
            ],
        ];
        $errorMessages = [
            'id.exists' => "Government does not exist!",
        ];
        $validator = Validator::make(['id' => $id], $rules, $errorMessages);
        if ($validator->fails()){
            $errors = $validator->errors()->first();
            return response($errors, 400)
                ->header('Content-Type', 'text/plain');
        }
        else{
            try{
                Government::find($id)->delete();
            }
            catch(Exception $e){
                return response($e->getMessage(), 400)
                    ->header('Content-Type', 'text/plain');
            }
            return response("Successfully deleted government", 200)
                ->header('Content-Type', 'text/plain');
        }
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
