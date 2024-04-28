<?php

namespace App\Services;

use App\Models\DiscountCode;

class DiscountCodesService
{
	public static function store($code,$value,$id=null)
	{
		if($id)
		{
			$discount_code = DiscountCode::find($id);
		}
		else
		{
			$discount_code = new DiscountCode();
		}

		$discount_code->code = $code;
		$discount_code->value = $value;
		$discount_code->save();

		return $discount_code;
	}

	public static function remove($code_id)
	{
		$discount_code = DiscountCode::find($code_id);
		$discount_code->delete();
	}
}
?>