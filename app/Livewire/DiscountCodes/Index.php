<?php

namespace App\Livewire\DiscountCodes;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\DiscountCode;
use App\Services\DiscountCodesService;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'discount_codes';
    public $isModalOpen = false;
    public $isModalDelete = true;
    public $isModalEdit = true;
    public $isUpdatePage = false;
    public $page = 1;
    public $perPage = 10;
    public $search = '';
    public $confirmDeleteId;
    public $sortDirection = 'DESC';
    public $sortColumn = 'created_at';

    public function render()
    {
        $this->dispatch('passPageTitleToLayout', $this->pageTitle);
        $columns = [
            ['label' => 'الكود', 'column' => 'code', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الخصم', 'column' => 'value', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $codes = DiscountCode::orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');

        return view('livewire.discount-codes.index',compact('columns','codes'));
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
    public function edit($id)
    {
        $this->dispatch('openEditModal', id: $id)->to('DiscountCodes.Edit');
        $this->dispatch('openEditDiscountCodesModal');
    }

    #[On('remove')]
    public function remove($id)
    {
        DiscountCodesService::remove($id);
        $this->refreshComponent();

    }
}
