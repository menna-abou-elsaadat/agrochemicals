<?php

namespace App\Services;

use App\Models\Advertisment;
use App\Services\FileService;

class AdvService
{
	public static function store($text,$image,$id=null)
	{
		// update adv 
		if($id)
		{
			$adv = Advertisment::find($id);
			if ($image) {
				// delete prev image
				FileService::delete($adv->file_id);
			}
		}
		else
		{
			$adv = new Advertisment();
		}
		
		if ($image)
		{
			$file = FileService::store($image);
			$adv->file_id = $file->id;
		}

		$adv->text = $text;
		$adv->save();

		return $adv;
	}

	public static function delete($adv_id)
	{
		$adv = Advertisment::find($adv_id);
		FileService::delete($adv->file_id);
		$adv->delete();
	}
}
?>