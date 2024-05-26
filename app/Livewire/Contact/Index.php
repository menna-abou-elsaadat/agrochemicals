<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\Contact;
use App\Services\ContactService;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'company';
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
            ['label' => 'القيمة', 'column' => 'value', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $contacts = Contact::orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');

        return view('livewire.contact.index',compact('columns','contacts'));
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
        $this->dispatch('openEditModal', id: $id)->to('Contact.Edit');
        $this->dispatch('openEditContactModal');
    }
}
