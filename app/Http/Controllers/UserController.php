<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Exception;

class UserController extends Controller
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
        $rules = [
            'name' => 'required|alpha|string',
            'email' => array('required',
                        'regex:/^([a-zA-Z0-9]+([\.\-\_][a-zA-Z0-9])*)+@[a-zA-Z0-9\-]+(\.[a-zA-Z]{2,})+$/',
                        'unique:users,email'),
            'password' => 'required|min:8'
        ];
        $errorMessages = [
            'required' => 'Please fill all fields!',
            'name.alpha' => 'Name must not contain any non-alphabetic characters',
            'email.regex' => 'E-mail format not valid',
            'email.unique' => 'You\'re already registered',
            'password.min' => 'Password must be at least 8 characters long'
        ];
        $validator = Validator::make($request->all(), $rules, $errorMessages);

        if($validator -> fails()){
            $errors = $validator->errors()->first();
            return response($errors, 400)
                ->header('Content-Type', 'text/plain');
        }
        else{
            try{
                User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }
            catch (Exception $e){
                return response($e->getMessage(), 400)
                    ->header('Content-Type', 'text/plain');
            }
            return response("New user entry [".$request->email ."] was created ", 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
