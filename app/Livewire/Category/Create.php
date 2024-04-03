<?php

namespace App\Livewire\Category;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 
use App\Services\CategoryService;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $category_file;
    public $uploaded_file;

    protected $messages = [
        'name.required' => 'يرجى ادخال الاسم',
        'uploaded_file' => 'يجب ان يكون الملف المرفوع من نوع (png,jpeg,jpg,gif) ',
        'category_file.required' => 'يرجى ادخال صورة'
    ];
    public function render()
    {
        return view('livewire.category.create');
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
        $category = CategoryService::store($data['name'],$data['category_file']);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Category.Index');
        $this->dispatch('close_modal','تم انشاء التصنيف بنجاح');
    }
}
