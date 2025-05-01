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
            return $this->successResponse(message: "Role assigned successfully.");
        }catch(Exception $e){
            return $this->errorResponse();
        }
    }

    public function getUserRole($id){
        try{
            $user = User::find($id)->with("roles")->first();
            return $this->successResponse(data: new UserRoleResource($user));
        }catch(Exception $e){
            return $this->errorResponse();
        }
    }

    public function getRoles(){
        try{
            $roles = Role::select('id', 'name', 'slug')->get();
            return $this->successResponse(data: RoleResource::collection($roles));
        }catch(Exception $e){
            return $this->errorResponse();
        }
    }

}
