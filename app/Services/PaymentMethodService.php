<?php

namespace App\Services;

use App\Models\PaymentMethod;

class PaymentMethodService
{
	public static function store($name,$number)
	{
		$payment_method = new PaymentMethod();
		$payment_method->name = $name;
		$payment_method->number = $number;
		$payment_method->save();

		return $payment_method;
	}
}
?>