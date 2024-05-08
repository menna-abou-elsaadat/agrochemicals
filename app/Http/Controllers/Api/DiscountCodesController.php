<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Http\Resources\DiscountCodeResource;
use App\Helpers\ApiResponse;

class DiscountCodesController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input();
        if (!isset($input['code'])) {
            return ApiResponse::sendResponse(401,'code is required',Null);
        }
        $code = DiscountCode::where('code',$input['code'])->first();
        if (!$code) {
           return ApiResponse::sendResponse(401,'this code name not found',Null);
        }
        $value = $code->value;
        return ApiResponse::sendResponse(200,'discount code data',$value);
    }
}
