<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Helpers\ApiResponse;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\EditRequest;
use Auth;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $inputs = $request->input();
        $user = UserService::store($role_id = 2,$name = $inputs['name'],$email = $inputs['email'],$password = $inputs['password'],$phone_number = $inputs['phone'],$phone_number=null,$address_1=null,$region=$inputs['city']);
        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return ApiResponse::sendResponse(201,'User Account Created Successfully',$data);

    }
     public function login(LoginRequest $request)
    {
        $inputs = $request->input();
        if (Auth::attempt(['phone_number'=>$inputs['phone'],'password'=>$inputs['password']])) {
            $user = Auth::user();
            $data['token'] = $user->createToken($user->phone_number)->plainTextToken;
            $data['user'] = new UserResource($user);

            return ApiResponse::sendResponse(200,'User Account logged in Successfully',$data);

        }
        else
        {
            return ApiResponse::sendResponse(401,'User credentails not found',null);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ApiResponse::sendResponse(200,'User logged out Successfully',null);

    }

    public function edit_user_data(EditRequest $request)
    {
        $inputs = $request->input();
        $user = UserService::store($role_id = 2,$name = $inputs['name'],$email = $inputs['email'],$password = $inputs['password'],$phone_number = $inputs['phone'],$phone_number=null,$address_1=null,$region=$inputs['city'],$points=0,$id=$inputs['id']);

        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return ApiResponse::sendResponse(200,'User Account updated Successfully',$data);
    }
}
