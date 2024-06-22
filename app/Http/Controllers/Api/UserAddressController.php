<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\UserAddressResource;
use App\Http\Requests\Api\User\AddressRequest;
use App\Services\UserAddressService;
use App\Models\User;

class UserAddressController extends Controller
{
    //
    public function index($user_id)
    {
        if(!isset($user_id))
        {
            return ApiResponse::sendResponse(401,'user_id is required',Null);
        }
        $user = User::find($user_id);
        if(!$user)
        {
            return ApiResponse::sendResponse(401,'user_id not found',Null);
        }
        $data['addresses'] = UserAddressResource::collection($user->addresses);
        return ApiResponse::sendResponse(200,'user addresses data',$data);
    }

    public function create(AddressRequest $request)
    {
        $inputs = $request->input();
        $address = UserAddressService::create($inputs['user_id'],$inputs['address'],$inputs['city']);
        $data['address'] = new UserAddressResource($address);
        return ApiResponse::sendResponse(301,'user addresses created',$data);

    }
}
