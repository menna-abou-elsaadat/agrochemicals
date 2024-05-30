<?php

namespace App\Livewire\Dieses;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Services\DiesesService;

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
    public function render()
    {
        return view('livewire.dieses.create');
    }

    public function save()
    {
        $data = $this->validate();
        $category = DiesesService::store($this->product_id,$data['crop'],$data['dieses'],$data['hse_precuations'],$data['phi']);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Dieses.Index');
        $this->dispatch('close_modal','تم انشاء المرض بنجاح');
    }
}
