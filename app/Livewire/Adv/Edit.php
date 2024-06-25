<?php

namespace App\Livewire\Adv;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Advertisment;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Services\AdvService;

class Edit extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $text;
    #[Validate('')]
    public $adv_file;
    public $uploaded_file;
    public $id;

    public Advertisment $adv;

    protected $messages = [
        'text.required' => 'يرجى ادخال النص',
        'uploaded_file' => 'يجب ان يكون الملف المرفوع من نوع (png,jpeg,jpg,gif) ',
        'adv_file.required' => 'يرجى ادخال صورة'
    ];

    public function render()
    {
        return view('livewire.adv.edit');
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
        $this->dispatch('initQuillEditor','text'.$this->id);
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->adv = Advertisment::find($id);
        $this->text = $this->adv->text;
        $this->id = $id;

        $this->dispatch('initQuillEditor','text'.$this->id);
        $this->render();
        
    }

    #[On('updateValueContent')]
    public function updateValueContent($function_param,$content)
    {
        $this->{$function_param} = $content;
    }

    public function save()
    {
        $data = $this->validate();
        $adv = AdvService::store($data['text'],$data['adv_file'],$this->adv->id);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Adv.Index');
        $this->dispatch('close_modal','تم تعديل الاعلان بنجاح');
        $this->dispatch('clean_editor');
    }
}
