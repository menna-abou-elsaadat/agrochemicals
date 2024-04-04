<?php

namespace App\Services;

use App\Models\ShippingFees;

class ShippingFeesService
{
	public static function store($governorate,$shipping_cost,$min_free_shipping_cost,$id=null)
	{
		if($id)
		{
			$shipping_fees = ShippingFees::find($id);
		}
		else
		{
			$shipping_fees = new ShippingFees();
		}

		$shipping_fees->governorate = $governorate;
		$shipping_fees->shipping_cost = $shipping_cost;
		$shipping_fees->min_free_shipping_cost = $min_free_shipping_cost;
		$shipping_fees->save();

		return $shipping_fees;
	}

	public static function remove($shipping_fees_id)
	{
		$shipping_fees = ShippingFees::find($shipping_fees_id);
		$shipping_fees->delete();
	}
}
?>