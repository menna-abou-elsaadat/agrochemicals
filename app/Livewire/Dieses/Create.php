<?php

namespace App\Livewire\Dieses;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Services\DiesesService;
use Livewire\Attributes\On; 

class Create extends Component
{
    #[Validate('required')]
    public $crop;
    #[Validate('required')]
    public $dieses;
    #[Validate('')]
    public $hse_precuations;
    #[Validate('')]
    public $phi;
    public $product_id;

    protected $messages = [
        'crop.required' => 'يرجى ادخال المحصول',
        'dieses.required' => 'يرجى ادخال المرض',
    ];

    public function mount($id)
    {
        $this->product_id = $id;
    }
    public function initQuillEditor($name)
    {
        $this->dispatch('initQuillEditor',$name);
    }
    #[On('updateValueContent')]
    public function updateValueContent($function_param,$content)
    {
        $this->{$function_param} = $content;
    }
    public function render()
    {
        return view('livewire.dieses.create');
    }

    public function save()
    {
        $data = $this->validate();
        $category = DiesesService::store($this->product_id,$data['crop'],$data['dieses'],$data['hse_precuations'],$data['phi']);
        $this->resetExcept('product_id');
        $this->dispatch('refreshComponent')->to('Dieses.Index');
        $this->dispatch('close_modal','تم انشاء المرض بنجاح');
        $this->dispatch('clean_editor');
    }
}
