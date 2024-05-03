<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,150',
            'email' => 'required|email|between:4,150|unique:users',
            'password' => 'required|between:6,150'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

      
        $user = User::create($validator->validated());
      
        $token = $user->createToken('Personal Access Token', ['user'])->plainTextToken;
        $user->token = $token;
      
        return response()->json(
            $user, 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user =  User::where(['email' => $request['email'], 'password' => $request['password']])->first();

        $token = $user->createToken('Personal Access Token', ['user'])->plainTextToken;
        $user->token = $token;
        return response()->json($user, 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
         $user = User::findOrFail($id);
         $user->fill($request->except(['id']));
         $user->save();
         return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        if ($user->delete() == false) {
            return response()->json([
                "Can't delete user with id"
            ], 404);
        }
        return response()->json([
            "id" => $id,
            "deleted" => true,
        ], 204);
    }
}
