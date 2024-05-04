<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserFavourite;
use App\Http\Resources\UserFavouriteResource;
use App\Helpers\ApiResponse;
use App\Http\Requests\Api\User\SetFavRequest;
use App\Http\Requests\Api\User\DelFavRequest;
use App\Services\UserFavouriteService;

class UserFavouriteController extends Controller
{
    public function index()
    {
        $favourites = UserFavourite::get();
        $data = UserFavouriteResource::collection($favourites);
        return ApiResponse::sendResponse(200,'user favourites data',$data);
    }

    public function set_fav(SetFavRequest $request)
    {
        $inputs = $request->input();
        $favourite = UserFavouriteService::setFav($inputs['user_id'],$inputs['product_id']);
        if ($favourite == 'error') {
            return ApiResponse::sendResponse(401,'user_id or product_id not found',null);
        }
        $data = new UserFavouriteResource($favourite);
        return ApiResponse::sendResponse(201,'user favourite created',$data);
    }

    public function del_fav(DelFavRequest $request)
    {
        $inputs = $request->input();
        $favourite = UserFavouriteService::delFav($inputs['user_id'],$inputs['product_id']);
        if ($favourite == 'error') {
            return ApiResponse::sendResponse(401,'user_id or product_id not found',null);
        }
        return ApiResponse::sendResponse(404,'user favourite was deleted',null);
    }
}
