<?php

namespace App\Livewire\Dieses;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\Dieses;
use App\Services\DiesesService;
use App\Models\CategoryProduct; 

use Livewire\Component;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'products';
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
    public $product_id;

    public function render()
    {
        $this->dispatch('passPageTitleToLayout', $this->pageTitle);
        $columns = [
            ['label' => 'المرض', 'column' => 'dieses', 'isData' => true,'hasRelation'=> false],
            ['label' => 'معدل الاستخدام', 'column' => 'hse_precuations', 'isData' => true,'hasRelation'=> false],
            ['label' => 'فترة ما قبل الحصاد', 'column' => 'phi', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $dieses = Dieses::where('category_product_id',$this->product_id)->orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');
        $product = CategoryProduct::find($this->product_id);
        return view('livewire.dieses.index',compact('columns','dieses','product'));
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
   
    public function mount($id)
    {
        $this->product_id = $id;
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
        $this->dispatch('openEditModal', id: $id)->to('Dieses.Edit');
        $this->dispatch('openEditDiesesModal');
    }

    #[On('remove')]
    public function remove($id)
    {
        DiesesService::remove($id);
        $this->refreshComponent();

    }


}
