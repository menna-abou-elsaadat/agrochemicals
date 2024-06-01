<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Services\FileService;

class OrderService
{
	public static function store($user_id,$address,$city,$phone,$total_price,$shipping_fees,$discount,$final_price,$payment_type,$products)
	{
		$order = new Order();
		$order->user_id = $user_id;
		$order->shipping_address = $address;
		$order->shipping_governorate = $city;
		$order->phone = $phone;
		$order->total_price = $total_price;
		$order->shipping_fees = $shipping_fees;
		$order->discount = $discount;
		$order->final_price = $final_price;
		$order->payment_type = $payment_type;
		$order->purchase_date = date("Y-m-d");
		$order->save();

		foreach ($products as $key => $product) {
			$order_product = self::storeOrderProduct($order->id,$product['id'],$product['price'],$product['count']);
		}

	}

	public static function storeOrderProduct($order_id,$product_id,$price,$count)
	{
		$order_product = new OrderProduct();
		$order_product->order_id = $order_id;
		$order_product->category_product_id = $product_id;
		$order_product->price = $price;
		$order_product->count = $count;
		$order_product->save();

		return $order_product;
	}

}
?>