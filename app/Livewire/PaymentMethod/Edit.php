<?php

namespace App\Livewire\PaymentMethod;

use Livewire\Component;
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $number;
    public PaymentMethod $payment_method;

    protected $messages = [
        'name.required' => 'يرجى ادخال الاسم',
        'number.required' => 'يرجى ادخال الرقم',
    ];

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->payment_method = PaymentMethod::find($id);
        $this->name = $this->payment_method->name;
        $this->number = $this->payment_method->number;
        $this->render();
        
    }

    public function render()
    {
        return view('livewire.payment-method.edit');
    }

    public function save()
    {
        $data = $this->validate();
        $category = PaymentMethodService::store($data['name'],$data['number'],$this->payment_method->id);
        $this->reset();
        $this->dispatch('refreshComponent')->to('PaymentMethod.Index');
        $this->dispatch('close_modal','تم تعديل طريقة الدفع بنجاح');
    }
}
