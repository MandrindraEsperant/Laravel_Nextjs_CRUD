<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        //Return json Response
        return response()->json([
            'resultat' => $users
        ], 200);
    }

    public function store(UserStoreRequest $request)
    {
        try {
            //Create User
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            // Return json Response
            return response()->json([
                'message' => "User successfully created."
            ], 200);
        } catch (\Exception $e) {
            //return json Response
            return response()->json([
                'message' => 'Something went really wrong'
            ], 500);
        }
    }
    public function show($id)
    {
        //User detail
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        //Return json Response
        return response()->json([
            'resultat' => $user
        ], 200);
    }

    public function update(UserStoreRequest $request, $id)
    {
        try {
            //Find user
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }

            //echo : "request : $request->image"
            $user->name = $request->name;
            $user->email = $request->email;

           //Update User
           $user->save();

            // Return json Response
            return response()->json([
                    'message'=>'User updated successfully'
            ]);
        } catch (\Exception $e) {
            //return json Response
            return response()->json([
                'message' => 'Something went really wrong'
            ], 500);
        }
    }
    public function destroy($id){
        try {
            //Find user
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }            

           //Delete User
           $user->delete();

            // Return json Response
            return response()->json([
                    'message'=>'User deleted successfully'
            ]);
        } catch (\Exception $e) {
            //return json Response
            return response()->json([
                'message' => 'Something went really wrong'
            ], 500);
        }
    }
}
