<?php

namespace App\Services;

use App\Models\User;
use Hash;

class UserService
{
	public static function store($role_id,$name,$email,$password,$phone_number=null,$address_1=null,$address_2=null,$region=null,$points=0,$device_token=null,$id=null)
	{
		// update user 
		if($id)
		{
			$user = User::find($id);
		}
		else
		{
			$user = new User();
		}
		
		$user->name = $name;
		$user->role_id = $role_id;
		$user->email = $email;
		$user->password = Hash::make($password);
		$user->phone_number = $phone_number;
		$user->address_1 = $address_1;
		$user->address_2 = $address_2;
		$user->region = $region;
		$user->points = $points;
		$user->device_token = $device_token;
		$user->save();

		return $user;
	}

	public static function usersWhoseRole($role_id)
	{
		return User::join('user_roles','users.id','user_roles.user_id')->where('user_roles.role_id',$role_id)->select('users.*');
	}
}
?>