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
            $roleId = Role::find($request->role)->value("id");
            $user->roles()->create([
            "user_id" => $user->id,
            "role_id" => $roleId,
            ]);
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


}
