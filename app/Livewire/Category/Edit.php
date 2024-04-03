<?php

namespace App\Livewire\Category;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Services\CategoryService;

class Edit extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $name;
    public Category $category;
    public $uploaded_file;
    #[Validate('')]
    public $category_file;
    public function render()
    {
        return view('livewire.category.edit');
    }

    #[On('openEditModal')]
    public function openEditModal($category_id)
    {
        $this->category = Category::find($category_id);
        $this->name = $this->category->name;
        $this->render();
        
    }

    #[On('upload:finished')] 
    public function uploadFinished()
    {   
        $this->validate(['uploaded_file'=>'mimes:jpg,png,jpeg,gif']);
        $file = $this->uploaded_file;
        $type = mime_content_type($file->path());
        $type = explode('/', $type)[0];
        $file_content['file'] = $file; 
        $file_content['type'] = $type; 
        $this->category_file = $file_content;

    }

    public function save()
    {
        $data = $this->validate();
        $category = CategoryService::store($data['name'],$data['category_file'],$this->category->id);
        $this->dispatch('refreshComponent')->to('Category.Index');
        $this->dispatch('close_modal','تم تعديل التصنيف بنجاح');
    }
}
