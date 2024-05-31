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
use App\Http\Requests\Api\User\ChangePasswordRequest;
use Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $inputs = $request->input();
        $user = UserService::store(2,$inputs['name'], $inputs['email'],$inputs['password'],$inputs['phone'],null,null,$inputs['city'],0,$inputs['device_token']);
        $data['user_id'] = $user->id;
        Auth::login($user);
        $data['token'] = $user->createToken($user->phone_number)->plainTextToken;

        return ApiResponse::sendResponse(201,'User Account Created Successfully',$data);

    }
     public function login(LoginRequest $request)
    {
        $inputs = $request->input();
        if (Auth::attempt(['phone_number'=>$inputs['phone'],'password'=>$inputs['password']])) {
            $user = Auth::user();
            $data['token'] = $user->createToken($user->phone_number)->plainTextToken;
            // $data['user'] = new UserResource($user);
            $data['user_id'] = $user->id;

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
        $user = UserService::store(2,$inputs['name'],$inputs['email'],$inputs['password'], $inputs['phone'],null,null,$inputs['city'],0,$inputs['device_token'],$id=$inputs['id']);

        $data['name'] = $user->name;
        $data['email'] = $user->email;

        return ApiResponse::sendResponse(200,'User Account updated Successfully',$data);
    }

    public function change_password(ChangePasswordRequest $request)
    {
        $inputs = $request->input();
        $user = User::find($inputs['user_id']);
        if(!$user)
        {
            return ApiResponse::sendResponse(401,'User id not found',null);
        }

        if (!Hash::check($inputs['old_password'], $user->password))
        {
             return ApiResponse::sendResponse(401,'old password doesnot match',null);
        }

        $user->password = Hash::make($inputs['new_password']);
        $user->save();
        return ApiResponse::sendResponse(200,'User password updated Successfully',null);
    }
}
