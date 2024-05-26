<?php

namespace App\Livewire\ShippingFees;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\ShippingFees;
use App\Services\ShippingFeesService;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'shipping_fees';
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
            ['label' => 'الاسم', 'column' => 'governorate', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الرقم', 'column' => 'shipping_cost', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الرقم', 'column' => 'min_free_shipping_cost', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $shipping_fees = ShippingFees::orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');

        return view('livewire.shipping-fees.index',compact('columns','shipping_fees'));
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
            
            default:
                return $data;
        }
    }
    #[On('edit')]
    public function edit($shipping_fee_id)
    {
        $this->dispatch('openEditModal', shipping_fee_id: $shipping_fee_id)->to('ShippingFees.Edit');
        $this->dispatch('openEditShippingFeesModal');
    }

    #[On('remove')]
    public function remove($shipping_fee_id)
    {
        ShippingFeesService::remove($shipping_fee_id);
        $this->refreshComponent();

    }
}
