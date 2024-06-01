<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Resources\CategoryProductResource;
use App\Http\Resources\SingleCategoryProductResource;
use App\Models\CategoryProduct;

class CategoryProductController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input();
        if (!isset($input['category_id'])) {
            return ApiResponse::sendResponse(401,'category id is required',Null);
        }
        $products = CategoryProduct::where('category_id',$input['category_id'])->get();
        $data = CategoryProductResource::collection($products);
        return ApiResponse::sendResponse(200,'products data',$data);
    }

    public function get_product(Request $request)
    {
        $input = $request->input();
        if (!isset($input['product_id'])) {
            return ApiResponse::sendResponse(401,'product_id is required',Null);
        }
        $product = CategoryProduct::find($input['product_id']);

        if (!$product) {
            return ApiResponse::sendResponse(401,'product_id is wrong',Null);
        }
        $data = new SingleCategoryProductResource($product);
        return ApiResponse::sendResponse(200,'product data',$data);
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
