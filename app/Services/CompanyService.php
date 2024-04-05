<?php

namespace App\Services;

use App\Models\CompanyData;;

class CompanyService
{
	public static function store($name,$value,$id=null)
	{
		if($id)
		{
			$company_data = CompanyData::find($id);
		}
		else
		{
			$company_data = new CompanyData();
		}

		$company_data->name = $name;
		$company_data->value = $value;
		$company_data->save();

		return $company_data;
	}

	public static function remove($id)
	{
		$company_data = CompanyData::find($id);
		$company_data->delete();
	}
}
?>