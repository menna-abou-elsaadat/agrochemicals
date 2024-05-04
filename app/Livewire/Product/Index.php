<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\CategoryProduct;
use App\Models\Category;
use App\Models\File;
use App\Services\CategoryProductService;

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
    public $search_column = '';
    public $confirmDeleteId;
    public $sortDirection = 'DESC';
    public $sortColumn = 'created_at';

    public function render()
    {
        $this->dispatch('passPageTitleToLayout', $this->pageTitle);
        $columns = [
            ['label' => 'التصنيف', 'column' => 'category_id', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الاسم', 'column' => 'name', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الاسم الفرعي', 'column' => 'secondary_name', 'isData' => true,'hasRelation'=> false],
            ['label' => 'سعر البيع', 'column' => 'price', 'isData' => true,'hasRelation'=> false],
            ['label' => 'التكلفة', 'column' => 'cost', 'isData' => true,'hasRelation'=> false],
            ['label' => 'الخصم', 'column' => 'discount', 'isData' => true,'hasRelation'=> false],
            ['label' => 'منتج مخصوص', 'column' => 'special', 'isData' => true,'hasRelation'=> false],
            ['label' => 'صورة', 'column' => 'file_id', 'isData' => true,'hasRelation'=> false],
            ['label' => '', 'column' => 'action', 'isData' => false,'hasRelation'=> false],
        ];

        $products = CategoryProduct::search($this->search_column,$this->search)->orderby($this->sortColumn, $this->sortDirection)->paginate($this->perPage, ['*'], 'page');
        $categories = Category::get();
        return view('livewire.product.index',compact('products','columns','categories'));
    }

    public function changeSearchData($search_column)
    {
        $this->search_column = $search_column;
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
   
    public function mount($category_id=null)
    {
        if (session()->has('page')) {
            $this->page = session('page');
        }
        if ($category_id) {
            $this->search = $category_id;
            $this->search_column = 'category_id';
        }

    }
    public function customFormat($column, $data)
    {
        switch ($column) {
            case 'file_id':
                $file = File::find($data);
                if($file)
                {
                    $path = url('uploads'.DIRECTORY_SEPARATOR.$file->uuid.DIRECTORY_SEPARATOR.$file->name);
                    return '<img src="'.$path.'" width="230" alt="image" />';
                }
                return '';
                
            case 'category_id':
                $category = Category::find($data);
                return $category->name;
                
            case 'special':
                return $data==1?'نعم':'لا';
            default:
                return $data;
        }
    }

    #[On('edit')]
    public function edit($category_product_id)
    {
        $this->dispatch('openEditModal', category_product_id: $category_product_id)->to('Product.Edit');
        $this->dispatch('openEditProductModal');
    }

    #[On('view')]
    public function view($category_product_id)
    {
        $this->dispatch('openViewModal', category_product_id: $category_product_id)->to('Product.View');
        
    }

    #[On('remove')]
    public function remove($category_product_id)
    {
        CategoryProductService::delete($category_product_id);
        $this->refreshComponent();

    }
}
