<?php

namespace App\Livewire\Order;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\Order;
use App\Models\User;
use App\Models\File;
use App\Services\OrderService;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'orders';
    public $isModalOpen = false;
    public $isModalDelete = true;
    public $isModalEdit = true;
    public $isUpdatePage = false;
    public $page = 1;
    public $perPage = 10;
    public $search = '';
    public $confirmDeleteId;
    public $sortDirection = 'ASC';
    public $sortColumn = 'created_at';

    public function render()
    {
        $this->dispatch('passPageTitleToLayout', $this->pageTitle);
        $columns = [
            ['label' => 'اسم المستخدم', 'column' => 'user_id', 'isData' => true,'hasRelation'=> false],
            ['label' => 'السعر النهائي', 'column' => 'final_price', 'isData' => true,'hasRelation'=> false],
            ['label' => 'حالة الدفع', 'column' => 'payment_status', 'isData' => true,'hasRelation'=> false],
            ['label' => 'حالة الطلب', 'column' => 'order_status', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الفاتورة', 'column' => 'file_id', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $orders = Order::orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');

        return view('livewire.order.index',compact('orders','columns'));
    }
    #[On('refreshComponent')] 
    public function refreshComponent()
    {
        $this->render();
    }
    public function doSort($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = ($this->sortDirection === 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';
    }

    public function updatingPage($page)
    {
        $this->page = $page ?: 1;
        
    }
    /**
     * Save the current page to the session.
     *
     * @return void
     */
    public function updatedPage()
    {
        session(['page' => $this->page]);
    }

    /**
     * Initialize component with stored page or default values.
     *
     * @return void
     */
   
    public function mount()
    {
        if (session()->has('page')) {
            $this->page = session('page');
        }
    }
    public function customFormat($column, $data)
    {
        switch ($column) {
            case 'file_id':
                $file = File::find($data);
                if ($file) {
                    $path = url('uploads'.DIRECTORY_SEPARATOR.$file->uuid.DIRECTORY_SEPARATOR.$file->name);
                return '<img src="'.$path.'" width="150" alt="image" />';
                }
                return '';
            case 'user_id':
                $user = User::find($data);
                return $user->name;
            default:
                return $data;
        }
    }
     #[On('edit')]
    public function edit($id)
    {
        $this->dispatch('openEditModal', id: $id)->to('Order.Edit');
        $this->dispatch('openEditOrderModal');
    }

    #[On('view')]
    public function view($id)
    {
        $this->dispatch('openViewModal', id: $id)->to('Order.View');
        
    }

    #[On('remove')]
    public function remove($id)
    {
        OrderService::remove($id);
        $this->refreshComponent();

    }
}
