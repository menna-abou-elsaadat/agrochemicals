<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentMethodService
{
	public static function store($name,$number,$id=null)
	{
		if ($id) {
			$payment_method = PaymentMethod::find($id);
		}
		else
		{
			$payment_method = new PaymentMethod();
		}
		
		$payment_method->name = $name;
		$payment_method->number = $number;
		$payment_method->save();

		return $payment_method;
	}

	public static function delete($id)
	{
		$payment_method = PaymentMethod::find($id);
		$payment_method->delete();
	}
}
?>