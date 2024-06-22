<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\User\OrderRequest;
use App\Helpers\ApiResponse;
use App\Services\OrderService;
use App\Models\CategoryProduct;
use App\Models\User;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\File as FileModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function get_orders($user_id)
    {
        if (!isset($user_id)) {
            return ApiResponse::sendResponse(401,'user_id is required',Null);
        }
        $user = User::find($user_id);

        if (!$user) {
            return ApiResponse::sendResponse(401,'user_id is wrong',Null);
        }
        $data = OrderResource::collection($user->orders);
        return ApiResponse::sendResponse(200,'user orders', $data);
    }

    public function payment_status(Request $request)
    {
        $inputs = $request->input();
        if (!isset($inputs['order_id'])) {
            return ApiResponse::sendResponse(401,'order_id is required',Null);
        }
        $order = Order::find($inputs['order_id']);
        if(!$order)
        {
            return ApiResponse::sendResponse(401,'order_id is wrong',Null);
        }
        if (!isset($inputs['payment_status'])) {
            return ApiResponse::sendResponse(401,'payment_status is required',Null);
        }

        $order->payment_status = $inputs['payment_status'];
        $order->save();
        return ApiResponse::sendResponse(200,'order payment status was updated', Null);
    }

    public function order_status(Request $request)
    {
        $inputs = $request->input();
        if (!isset($inputs['order_id'])) {
            return ApiResponse::sendResponse(401,'order_id is required',Null);
        }
        $order = Order::find($inputs['order_id']);
        if(!$order)
        {
            return ApiResponse::sendResponse(401,'order_id is wrong',Null);
        }
        if (!isset($inputs['order_status'])) {
            return ApiResponse::sendResponse(401,'order_status is required',Null);
        }

        $order->order_status = $inputs['order_status'];
        $order->save();
        return ApiResponse::sendResponse(200,'order payment status was updated', Null);
    }

    public function proof_payment(Request $request)
    {
        $inputs = $request->input();
        if (!isset($inputs['order_id'])) {
            return ApiResponse::sendResponse(401,'order_id is required',Null);
        }
        $order = Order::find($inputs['order_id']);
        if(!$order)
        {
            return ApiResponse::sendResponse(401,'order_id is wrong',Null);
        }
        if (!isset($inputs['image'])) {
            return ApiResponse::sendResponse(401,'image is required',Null);
        }

        $uuid = md5(rand());
        $file_path = $inputs['image']->storeAs($uuid,$inputs['image']->getCLientOriginalName(),['disk' => 'my_files']);

        $file = new FileModel();
        $file->uuid = $uuid;
        $file->name = $inputs['image']->getCLientOriginalName();
        $file->type = 'image';
        $file->save();

        $order->file_id = $file->id;
        $order->save();
        return ApiResponse::sendResponse(200,'order payment status was updated', Null);
    }
}
