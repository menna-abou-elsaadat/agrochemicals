<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\User\OrderRequest;
use App\Helpers\ApiResponse;
use App\Services\OrderService;
use App\Models\CategoryProduct;

class OrderController extends Controller
{
    public function make_order(OrderRequest $request)
    {
        $inputs = $request->input();

        //validate products
        foreach ($inputs['products'] as $key => $product) {
            $category_product = CategoryProduct::find($product['id']);
            if(!$category_product)
            {
                return ApiResponse::sendResponse(401,'product id '.$product['id'].' not found',null);
            }
        }

        $order = OrderService::store($inputs['user_id'],$inputs['address'],$inputs['city'],$inputs['phone'],$inputs['total_price'],$inputs['shipping_fees'],$inputs['discount'],$inputs['final_price'],$inputs['payment_type'],$inputs['products']);


        return ApiResponse::sendResponse(200,'order created Successfully',null);

    }
}
