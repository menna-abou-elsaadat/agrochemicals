<?php

namespace App\Services;

use App\Models\Dieses as DiesesModel;

class DiesesService
{
	public static function store($product_id,$dieses,$hse_precuations,$phi,$id=null)
	{
		if($id)
		{
			$dieses_record = DiesesModel::find($id);
		}
		else
		{
			$dieses_record = new DiesesModel();
		}

		$dieses_record->category_product_id = $product_id;
		$dieses_record->dieses = $dieses;
		$dieses_record->hse_precuations = $hse_precuations;
		$dieses_record->phi = $phi;
		$dieses_record->save();

		return $dieses_record;
	}

	public static function remove($id)
	{
		$dieses_record = DiesesModel::find($id);
		$dieses_record->delete();
	}
}
?>