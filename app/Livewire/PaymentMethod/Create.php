<?php

namespace App\Livewire\PaymentMethod;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Services\PaymentMethodService;

class Create extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $number;

    protected $messages = [
        'name.required' => 'يرجى ادخال الاسم',
        'number.required' => 'يرجى ادخال الرقم',
    ];

    public function render()
    {
        return view('livewire.payment-method.create');
    }

    public function save()
    {
        $data = $this->validate();
        $category = PaymentMethodService::store($data['name'],$data['number']);
        $this->reset();
        $this->dispatch('refreshComponent')->to('PaymentMethod.Index');
        $this->dispatch('close_modal','تم انشاء طريقة الدفع بنجاح');
    }
}
