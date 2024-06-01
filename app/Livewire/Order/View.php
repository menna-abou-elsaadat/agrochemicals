<?php

namespace App\Livewire\Order;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Order;

class View extends Component
{
    public Order $order;

    public function render()
    {
        return view('livewire.order.view');
    }
    #[On('openViewModal')]
    public function openViewModal($id)
    {
        $this->order = Order::find($id);
        $this->render();
        $this->dispatch('openViewOrderModal');
    }
}
