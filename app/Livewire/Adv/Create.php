<?php

namespace App\Livewire\Adv;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On; 
use App\Services\AdvService;

class Create extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $text;
    #[Validate('required')]
    public $adv_file;
    public $uploaded_file;

    protected $messages = [
        'text.required' => 'يرجى ادخال النص',
        'uploaded_file' => 'يجب ان يكون الملف المرفوع من نوع (png,jpeg,jpg,gif) ',
        'adv_file.required' => 'يرجى ادخال صورة'
    ];

    public function render()
    {
        return view('livewire.adv.create');
    }
    #[On('updateValueContent')]
    public function updateValueContent($function_param,$content)
    {
        $this->{$function_param} = $content;
    }
    
    public function initQuillEditor($name)
    {
        $this->dispatch('initQuillEditor',$name);
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
        $this->adv_file = $file_content;
    }

    public function save()
    {
        $data = $this->validate();
        $adv = AdvService::store($data['text'],$data['adv_file']);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Adv.Index');
        $this->dispatch('close_modal','تم انشاء الاعلان بنجاح');
        $this->dispatch('clean_editor');
    }
}
