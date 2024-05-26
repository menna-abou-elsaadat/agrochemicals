<?php

namespace App\Livewire\PaymentMethod;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\PaymentMethod;
use App\Services\PaymentMethodService;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'payment_methods';
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
            ['label' => 'الاسم', 'column' => 'name', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الرقم', 'column' => 'number', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $payment_methods = PaymentMethod::orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');
        return view('livewire.payment-method.index',compact('columns','payment_methods'));
    }
    #[On('refreshComponent')] 
    public function refreshComponent()
    {
        $this->render();
    }

    #[On('edit')]
    public function edit($id)
    {
        $this->dispatch('openEditModal', id: $id)->to('PaymentMethod.Edit');
        $this->dispatch('openEditPaymentMethodModal');
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

    #[On('remove')]
    public function remove($id)
    {
        PaymentMethodService::delete($id);
        $this->refreshComponent();

    }

}
