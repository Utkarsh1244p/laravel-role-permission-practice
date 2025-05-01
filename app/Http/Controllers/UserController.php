<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleRequest;
use App\Http\Resources\RoleResource;
use App\Http\Resources\UserRoleResource;
use App\Models\Role;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    public function assignRole(AssignRoleRequest $request, User $user)
    {
        try{
            $roleId = Role::where("name", $request->role)->value("id");
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

    public function getUserRole($id){
        try{
            $user = User::find($id)->with("roles")->first();
            return response()->json([
                "message" => "User roles retrieved successfully.",
                "status" => 200,
                "data" => new UserRoleResource($user)
            ]);

        }catch(Exception $e){
            throw $e;
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
                "data" => RoleResource::collection($roles)
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
