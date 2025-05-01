<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleRequest;
use App\Models\Role;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function assignRole(AssignRoleRequest $request, User $user)
    {
        try{
            $roleId = Role::find($request->role_id)->value("id");
            $user->roles()->attach($roleId);
            return response()->json([
                "message" => "Role assigned successfully.",
                "status" => 201
            ]);
        }catch(Exception $e){
            return response()->json([
                "message" => "Server Error.",
                "status" => 500
            ]);
        }
    }

    public function getUserRole(User $user){
        try{
            $userId = $user->id;
            $userRoles = $user->roles()->get();
            return response()->json([
                "message" => "User roles retrieved successfully.",
                "status" => 200,
                "data" => $userRoles
            ]);

        }catch(Exception $e){
            return response()->json([
                "message" => "Server Error.",
                "status" => 500
            ]);
        }
    }

    public function getRoles(){
        try{
            $roles = Role::select('id', 'name', 'slug')->get();
            return response()->json([
                "message" => "Roles retrieved successfully.",
                "status" => 200,
                "data" => $roles
            ]);
        }catch(Exception $e){
            throw $e;
            return response()->json([
                "message" => "Server Error.",
                "status" => 500
            ]);
        }
    }

}
