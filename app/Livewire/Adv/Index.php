<?php

namespace App\Livewire\Adv;

use Livewire\Component;
use App\Models\Advertisment;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\File;
use App\Services\AdvService;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'advs';
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
            ['label' => 'نص', 'column' => 'text', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الصورة', 'column' => 'file_id', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $advs = Advertisment::orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');

        return view('livewire.adv.index',compact('columns','advs'));
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
                $path = url('uploads'.DIRECTORY_SEPARATOR.$file->uuid.DIRECTORY_SEPARATOR.$file->name);
                return '<img src="'.$path.'" width="230" alt="image" />';
            default:
                return $data;
        }
    }

    #[On('edit')]
    public function edit($id)
    {
        $this->dispatch('openEditModal', id: $id)->to('Adv.Edit');
        $this->dispatch('openEditAdvModal');
    }

    #[On('remove')]
    public function remove($id)
    {
        AdvService::delete($id);
        $this->refreshComponent();

    }
}
