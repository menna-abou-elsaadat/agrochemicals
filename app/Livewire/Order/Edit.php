<?php

namespace App\Livewire\Order;

use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Services\OrderService;

class Edit extends Component
{
    use WithFileUploads;

    public Order $order;
    public $order_file;
    public $uploaded_file;
    public $order_status;
    public $payment_status;

    public function render()
    {
        return view('livewire.order.edit');
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
        $this->order_file = $file_content;
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->order = Order::find($id);
        $this->order_status = $this->order->order_status;
        $this->payment_status = $this->order->payment_status;
        $this->render();
    }

    public function save()
    {
        $order = OrderService::edit($this->payment_status,$this->order_status,$this->order_file,$this->order->id);
        $this->dispatch('refreshComponent')->to('Order.Index');
        $this->dispatch('close_modal','تم تعديل الطلب بنجاح');
    }

}
