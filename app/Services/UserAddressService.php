<?php

namespace App\Services;

use App\Models\UserAddress;

class UserAddressService
{
	public static function create($user_id,$address,$city)
	{
		$new_address = new UserAddress();
		$new_address->user_id = $user_id;
		$new_address->address = $address;
		$new_address->city = $city;
		$new_address->save();

		return $new_address;
	}

}
?>