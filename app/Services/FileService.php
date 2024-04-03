<?php

namespace App\Services;

use App\Models\File as FileModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FileService
{
	public static function store($file_content)
	{
		$uuid = md5(rand());
		$file_path = $file_content['file']->storeAs($uuid,$file_content['file']->getCLientOriginalName(),['disk' => 'my_files']);

		$file = new FileModel();
		$file->uuid = $uuid;
		$file->name = $file_content['file']->getCLientOriginalName();
		$file->type = $file_content['type'];
		$file->save();

		return $file;

	}

	public static function delete($file_id)
	{
		$file = FileModel::find($file_id);
		$folderPath = public_path('/uploads/'.$file->uuid);
      	$deletedFile = File::deleteDirectory($folderPath);
      	$file->delete();
	}
}

?>