<?php

namespace App\Http\Controllers\Api\BaseController\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRolesController extends Controller
{

    public $rootPassword = "123456";

    public function __construct()
    {
        $this->middleware('api');
    }

    public function setAsAdmin(Request $request)
    {
        $user = Auth::user();
        $userId = $request->all()['uid'];
        return response()->json([
            $user->globalRoles,
        ], 200);
    }

    public function setAsRoot()
    {

    }

    public function setAsControlManager()
    {

    }
}
