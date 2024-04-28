<?php

namespace App\Livewire\DiscountCodes;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\DiscountCode;
use App\Services\DiscountCodesService;
use Livewire\Attributes\On; 


class Edit extends Component
{
    #[Validate('required')]
    public $code;
    #[Validate('required|numeric')]
    public $value;
    public DiscountCode $discount_code;

    protected $messages = [
        'code.required' => 'يرجى ادخال الكود',
        'value.required' => 'يرجى ادخال القيمة',
        'value.numeric' => 'يرجى ادخال سعر',
    ];


    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->discount_code = DiscountCode::find($id);
        $this->code = $this->discount_code->code;
        $this->value = $this->discount_code->value;
        $this->render();  
    }

    public function render()
    {
        return view('livewire.discount-codes.edit');
    }

    public function save()
    {
        $data = $this->validate();
        $discount_code = DiscountCodesService::store($data['code'],$data['value'],$this->discount_code->id);
        $this->reset();
        $this->dispatch('refreshComponent')->to('DiscountCodes.Index');
        $this->dispatch('close_modal','تم انشاء الكود بنجاح');
    }
}
