<?php

namespace App\Livewire\DiscountCodes;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\DiscountCode;
use App\Services\DiscountCodesService;

class Create extends Component
{
    #[Validate('required')]
    public $code;
    #[Validate('required|numeric')]
    public $value;

    protected $messages = [
        'code.required' => 'يرجى ادخال الكود',
        'value.required' => 'يرجى ادخال القيمة',
        'value.numeric' => 'يرجى ادخال سعر',
    ];

    public function render()
    {
        return view('livewire.discount-codes.create');
    }

    public function save()
    {
        $data = $this->validate();
        $category = DiscountCodesService::store($data['code'],$data['value']);
        $this->reset();
        $this->dispatch('refreshComponent')->to('DiscountCodes.Index');
        $this->dispatch('close_modal','تم انشاء الكود بنجاح');
    }
}
