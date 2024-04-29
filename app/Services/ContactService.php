<?php

namespace App\Services;

use App\Models\Contact;;

class ContactService
{
	public static function store($name,$value,$id=null)
	{
		if($id)
		{
			$contact = Contact::find($id);
		}
		else
		{
			$contact = new Contact();
		}

		$contact->name = $name;
		$contact->value = $value;
		$contact->save();

		return $contact;
	}
}
?>