<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRolesController extends Controller
{

    public $rootPassword = "123456";

    public function __construct()
    {
        $this->middleware('api');
    }

    public function setAsAdmin(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'status' => 'required',
            'uid' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json();
        }
        if(!$this->validateUser($request->all()['password'])){
            return response()->json(['error'], 403);
        }
        $userId = $request->all()['uid'];
        $userRole = User::find($userId);
        if($userRole == null) return response()->json(false, 404);
        $userRole = $userRole->globalRoles;
        $userRole->is_admin = $request->all()['status'];
        $userRole->save();
        return response()->json([
            'success',
        ], 200);
    }

    public function setAsRoot(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'status' => 'required',
            'uid' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json();
        }
        if(!$this->validateUser($request->all()['password'])){
            return response()->json(['error'], 403);
        }
        $userId = $request->all()['uid'];
        $userRole = User::find($userId);
        if($userRole == null) return response()->json(false, 404);
        $userRole = $userRole->globalRoles;
        $userRole->is_root = $request->all()['status'];
        $userRole->save();
        return response()->json([
            'success',
        ], 200);
    }

    public function setAsControlManager(Request $request)
    {
        $validator = $validator = Validator::make($request->all(), [
            'status' => 'required',
            'uid' => 'required',
            'password' => 'required',
        ]);
        if($validator->fails()){
            return response()->json();
        }
        if(!$this->validateUser($request->all()['password'])){
            return response()->json(['error'], 403);
        }
        $userId = $request->all()['uid'];
        $userRole = User::find($userId);
        if($userRole == null) return response()->json(false, 404);
        $userRole = $userRole->globalRoles;
        $userRole->is_control_manager = $request->all()['status'];
        $userRole->save();
        return response()->json([
            'success',
        ], 200);
    }

    private function validateUser($password){
        $userRoles = Auth::user();
        if($userRoles == null) return false;
        if($userRoles->globalRoles->is_root) return  true;
        return $password === $this->rootPassword;
    }

}
