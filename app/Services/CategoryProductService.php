<?php

namespace App\Services;

use App\Models\CategoryProduct;
use App\Services\FileService;

class CategoryProductService
{
	public static function store($data,$id=null)
	{
		if ($id) {
			$product = CategoryProduct::find($id);
			if ($data['product_file'] && $product->file) {
				// delete prev image
				FileService::delete($product->file_id);
			}
		}
		else
		{
			$product = new CategoryProduct();
		}

		if ($data['product_file']) {

			$file = FileService::store($data['product_file']);
			$product->file_id = $file->id;
		}
		
		$product->name = $data['name'];
		$product->category_id = $data['category_id'];
		$product->secondary_name = $data['secondary_name'];
		$product->description = $data['description'];
		$product->price = $data['price'];
		$product->cost = $data['cost'];
		$product->discount = $data['discount'];
		$product->special = $data['special']?1:0;
		$product->stock = $data['stock'];
		$product->active_material = $data['active_material'];
		$product->origin_country = $data['origin_country'];
		$product->properties = $data['properties'];
		$product->recommended_doses = $data['recommended_doses'];
		$product->hse_precuations = $data['hse_precuations'];
		$product->other_data = $data['other_data'];
		$product->save();

		return $product;
	}
	public static function delete($product_id)
	{
		$product = CategoryProduct::find($product_id);
		if ($product->file) {
			FileService::delete($product->file_id);
		}
		$product->delete();
	}
}
?>