<?php

namespace App\Livewire\ShippingFees;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\ShippingFees;
use App\Services\ShippingFeesService;

class Create extends Component
{
    #[Validate('required')]
    public $governorate;
    #[Validate('required|numeric')]
    public $shipping_cost;
    #[Validate('required|numeric')]
    public $min_free_shipping_cost;

    protected $messages = [
        'governorate.required' => 'يرجى ادخال المحافظة',
        'shipping_cost.required' => 'يرجى ادخال التكلفة',
        'shipping_cost.numeric' => 'يرجى ادخال سعر',
        'min_free_shipping_cost.required' => 'يرجى ادخال الحد الادني للحصول على شحن مجاني',
        'min_free_shipping_cost.numeric' => 'يرجى ادخال سعر',
    ];

    public function render()
    {
        return view('livewire.shipping-fees.create');
    }

    public function save()
    {
        $data = $this->validate();
        $category = ShippingFeesService::store($data['governorate'],$data['shipping_cost'],$data['min_free_shipping_cost']);
        $this->reset();
        $this->dispatch('refreshComponent')->to('ShippingFees.Index');
        $this->dispatch('close_modal','تم انشاء شحن بنجاح');
    }
}
