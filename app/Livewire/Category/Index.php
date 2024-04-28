<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\Attributes\On; 
use App\Models\File;
use App\Services\CategoryService;

class Index extends Component
{
    use WithPagination;

    public $pageTitle = 'categories';
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
            ['label' => 'الاسم', 'column' => 'id', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الصورة', 'column' => 'file_id', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $categories = Category::orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');
        return view('livewire.category.index',compact('categories','columns'));
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
                return '<img src="'.$path.'" width="230" alt="image" />';
                }
                return '';
            case 'id':
                $category = Category::find($data);
                return '<a href="'.route('product_index',['category_id'=>$category->id]).'">'.$category->name.'</a>' ; 
            default:
                return $data;
        }
    }

    #[On('edit')]
    public function edit($category_id)
    {
        $this->dispatch('openEditModal', category_id: $category_id)->to('Category.Edit');
        $this->dispatch('openEditCategoryModal');
    }

    #[On('remove')]
    public function remove($category_id)
    {
        CategoryService::delete($category_id);
        $this->refreshComponent();

    }
}
