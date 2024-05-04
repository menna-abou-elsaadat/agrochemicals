<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Resources\PaymentMethodResource;
use App\Helpers\ApiResponse;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $payment_methods = PaymentMethod::get();
        $data = PaymentMethodResource::collection($payment_methods);
        return ApiResponse::sendResponse(200,'Payment Methods data',$data);
    }
}
