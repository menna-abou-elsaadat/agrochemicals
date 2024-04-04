<?php

namespace App\Livewire\ShippingFees;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\ShippingFees;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use App\Services\ShippingFeesService;

class Edit extends Component
{
    #[Validate('required')]
    public $governorate;
    #[Validate('required|numeric')]
    public $shipping_cost;
    #[Validate('required|numeric')]
    public $min_free_shipping_cost;
    public $shipping_fees;

    protected $messages = [
        'governorate.required' => 'يرجى ادخال المحافظة',
        'shipping_cost.required' => 'يرجى ادخال التكلفة',
        'shipping_cost.numeric' => 'يرجى ادخال سعر',
        'min_free_shipping_cost.required' => 'يرجى ادخال الحد الادني للحصول على شحن مجاني',
        'min_free_shipping_cost.numeric' => 'يرجى ادخال سعر',
    ];

    public function render()
    {
        return view('livewire.shipping-fees.edit');
    }

    #[On('openEditModal')]
    public function openEditModal($shipping_fee_id)
    {
        $this->shipping_fees = ShippingFees::find($shipping_fee_id);
        $this->governorate = $this->shipping_fees->governorate;
        $this->shipping_cost = $this->shipping_fees->shipping_cost;
        $this->min_free_shipping_cost = $this->shipping_fees->min_free_shipping_cost;
        $this->render();   
    }

    public function save()
    {
        $data = $this->validate();
        $category = ShippingFeesService::store($data['governorate'],$data['shipping_cost'],$data['min_free_shipping_cost'],$this->shipping_fees->id);
        $this->dispatch('refreshComponent')->to('ShippingFees.Index');
        $this->dispatch('close_modal','تم تعديل شحن ');
    }
}
