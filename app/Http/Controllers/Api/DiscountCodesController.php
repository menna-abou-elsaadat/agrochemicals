<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCode;
use App\Http\Resources\DiscountCodeResource;
use App\Helpers\ApiResponse;

class DiscountCodesController extends Controller
{
    public function index()
    {
        $codes = DiscountCode::get();
        $data = DiscountCodeResource::collection($codes);
        return ApiResponse::sendResponse(200,'discount codes data',$data);
    }
}
