<?php

namespace App\Livewire\Dieses;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Dieses;
use App\Services\DiesesService;
use App\Models\CategoryProduct;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    #[Validate('required')]
    public $crop;
    #[Validate('required')]
    public $dieses;
    #[Validate('')]
    public $hse_precuations;
    #[Validate('')]
    public $phi;
    public $dieses_record;

    protected $messages = [
        'crop.required' => 'يرجى ادخال المحصول',
        'dieses.required' => 'يرجى ادخال المرض',
    ];

    public function render()
    {
        return view('livewire.dieses.edit');
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->dieses_record = Dieses::find($id);
        $this->crop = $this->dieses_record->crop;
        $this->dieses = $this->dieses_record->dieses;
        $this->hse_precuations = $this->dieses_record->hse_precuations;
        $this->phi = $this->dieses_record->phi;
        $this->render();
        
    }

    public function save()
    {
        $data = $this->validate();
        $category = DiesesService::store($this->dieses_record->category_product_id,$data['crop'],$data['dieses'],$data['hse_precuations'],$data['phi'],$this->dieses_record->id);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Dieses.Index');
        $this->dispatch('close_modal','تم تعديل المرض بنجاح');
    }
}
