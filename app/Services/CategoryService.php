<?php

namespace App\Services;

use App\Models\Category;
use App\Services\FileService;

class CategoryService
{
	public static function store($name,$image,$id=null)
	{
		// update category 
		if($id)
		{
			$category = Category::find($id);
			if ($image) {
				// delete prev image
				FileService::delete($category->file_id);
			}
		}
		else
		{
			$category = new Category();
		}
		
		if ($image)
		{
			$file = FileService::store($image);
			$category->file_id = $file->id;
		}

		$category->name = $name;
		$category->save();

		return $category;
	}

	public static function delete($category_id)
	{
		$category = Category::find($category_id);
		if ($category->file) {
			FileService::delete($category->file_id);
		}
		$category->delete();
	}
}
?>