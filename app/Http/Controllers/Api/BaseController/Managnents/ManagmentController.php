<?php

namespace App\Http\Controllers\Api\BaseController\Managnents;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;

class ManagmentController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }

    public function newManagment(Request $request){
        $validator = Validator::make($request->all(), [
            ''
        ], []);
    }

    public function deleteManagment(Request $request){

    }

    public function viewManagment(Request $request){

    }

    public function viewAllManagments(Request $request){

    }

}
