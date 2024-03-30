<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Attributes\On; 

class UsersList extends Component
{
    use WithPagination;

    public $isModalOpen = false;
    public $isModalDelete = true;
    public $isModalEdit = true;
    public $isUpdatePage = false;
    public $page = 1;
    public $perPage = 10;
    public $search = '';
    public $sortDirection = 'DESC';
    public $sortColumn = 'created_at';
    public $confirmDeleteId;

    #[On('refreshComponent')] 
    public function refreshComponent()
    {
        $this->render();
    }

    public function render()
    {
        $columns = [
            ['label' => 'الاسم', 'column' => 'name', 'isData' => true,'hasRelation'=> false],
            ['label' => 'البريد اللكتروني', 'column' => 'email', 'isData' => true,'hasRelation'=> false],
            ['label' => 'رقم التليفون', 'column' => 'phone_number', 'isData' => true,'hasRelation'=> false],
            ['label' => 'المنطقة', 'column' => 'region', 'isData' => true,'hasRelation'=> false],
            ['label' => 'النقط', 'column' => 'points', 'isData' => true,'hasRelation'=> false],
  
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        // $customers = Customer::search($this->search)
        //     ->orderBy($this->sortColumn, $this->sortDirection)
        //     ->paginate($this->perPage, ['*'], 'page');

        // return view('livewire.customers.index', compact('customers', 'columns'));
        $users = User::where('role_id',2)->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage, ['*'], 'page');
        return view('livewire.user.index',compact('users','columns'));
    }
    #[On('remove')]
    public function remove($user_id)
    {
        $user = User::find($user_id);
        $user->delete();
        $this->refreshComponent();

    }
    #[On('edit')]
    public function edit($user_id)
    {
        $this->dispatch('openEditModal', user_id: $user_id)->to('User.EditUser');
        $this->dispatch('openEditUserModal');
    }

    #[On('view')]
    public function view($user_id)
    {
        $this->dispatch('openViewModal', user_id: $user_id)->to('User.View');
        
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
            case 'name':
                return str($data)->words(2);
            default:
                return $data;
        }
    }

}
