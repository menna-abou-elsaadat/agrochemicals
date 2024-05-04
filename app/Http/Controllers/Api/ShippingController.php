<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingFees;
use App\Http\Resources\ShippingResource;
use App\Helpers\ApiResponse;

class ShippingController extends Controller
{
    public function index()
    {
        $Shipping_Fees = ShippingFees::get();
        $data = ShippingResource::collection($Shipping_Fees);
        return ApiResponse::sendResponse(200,'shipping data',$data);
    }
}
