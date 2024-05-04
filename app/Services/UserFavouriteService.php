<?php

namespace App\Services;

use App\Models\UserFavourite;
use App\Models\User;
use App\Models\CategoryProduct;

class UserFavouriteService
{
	public static function setFav($user_id,$category_product_id)
	{
		$user = User::find($user_id);
		$product = CategoryProduct::find($category_product_id);
		if (!$user || !$product) {
			return 'error';
		}

		$favourite = UserFavourite::where('user_id',$user_id)->where('category_product_id',$category_product_id)->first();
		if (!$favourite) {
			
			$favourite = new UserFavourite();
			$favourite->user_id = $user_id;
			$favourite->category_product_id = $category_product_id;
			$favourite->save();
		}

		return $favourite;
	}

	public static function delFav($user_id,$category_product_id)
	{
		$user = User::find($user_id);
		$product = CategoryProduct::find($category_product_id);
		if (!$user || !$product) {
			return 'error';
		}

		$favourite = UserFavourite::where('user_id',$user_id)->where('category_product_id',$category_product_id)->delete();
		
	}
}
?>