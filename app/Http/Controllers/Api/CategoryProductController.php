<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\CategoryProductResource;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    public function index()
    {
        $products = CategoryProduct::get();
        $data = CategoryProductResource::collection($products);
        return ApiResponse::sendResponse(200,'products data',$data);
    }

    public function special()
    {
        $products = CategoryProduct::where('special',1)->get();
        $data = CategoryProductResource::collection($products);
        return ApiResponse::sendResponse(200,'special products data',$data);
    }

    public function search(Request $request)
    {
        $inputs = $request->input();
        $products = CategoryProduct::query();
        foreach ($inputs as $key => $input) {
            $products = $products->search($key,$input);
        }
        $products = $products->get();
        $data = CategoryProductResource::collection($products);
        return ApiResponse::sendResponse(200,' products data',$data);

    }

}
