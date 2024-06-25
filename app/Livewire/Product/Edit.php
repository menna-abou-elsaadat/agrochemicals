<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Services\CategoryProductService;
use App\Models\CategoryProduct;

class Edit extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $category_id;
    #[Validate('')]
    public $secondary_name;
    #[Validate('')]
    public $description;
    #[Validate('')]
    public $price = 0;
    #[Validate('')]
    public $cost = 0;
    #[Validate('')]
    public $discount = 0;
    #[Validate('')]
    public $special;
    #[Validate('')]
    public $stock = 0;
    #[Validate('')]
    public $active_material;
    #[Validate('')]
    public $origin_country;
    #[Validate('')]
    public $properties;
    #[Validate('')]
    public $recommended_doses;
    #[Validate('')]
    public $hse_precuations;
    #[Validate('')]
    public $other_data;
    #[Validate('')]
    public $product_file;
    public $uploaded_file;
    public CategoryProduct $product;
    public $id;

    protected $messages = [
        'name.required' => 'يرجى ادخال الاسم',
        'uploaded_file' => 'يجب ان يكون الملف المرفوع من نوع (png,jpeg,jpg,gif) ',
        'category_id.required' => 'يرجي اختيار تصنيف لهذا الصنف',
    ];

    public function render()
    {
        $categories = Category::get();
        return view('livewire.product.edit',compact('categories'));
    }

    #[On('upload:finished')] 
    public function uploadFinished()
    {   
        $this->validate(['uploaded_file'=>'mimes:jpg,png,jpeg,gif']);
        $file = $this->uploaded_file;
        $type = mime_content_type($file->path());
        $type = explode('/', $type)[0];
        $file_content['file'] = $file; 
        $file_content['type'] = $type; 
        $this->product_file = $file_content;
        $this->dispatch('initQuillEditor','description'.$this->id);
        $this->dispatch('initQuillEditor','other_data'.$this->id);
        $this->dispatch('initQuillEditor','hse_precuations'.$this->id);
        $this->dispatch('initQuillEditor','recommended_doses'.$this->id);
        $this->dispatch('initQuillEditor','properties'.$this->id);
    }

    #[On('openEditModal')]
    public function openEditModal($category_product_id)
    {
        $this->product = CategoryProduct::find($category_product_id);
        $this->name = $this->product->name;
        $this->secondary_name = $this->product->secondary_name;
        $this->price = $this->product->price;
        $this->cost = $this->product->cost;
        $this->discount = $this->product->discount;
        $this->special = $this->product->special;
        $this->stock = $this->product->stock;
        $this->active_material = $this->product->active_material;
        $this->properties = $this->product->properties;
        $this->origin_country = $this->product->origin_country;
        $this->recommended_doses = $this->product->recommended_doses;
        $this->hse_precuations = $this->product->hse_precuations;
        $this->other_data = $this->product->other_data;
        $this->category_id = $this->product->category_id;
        $this->description = $this->product->description;
        $this->id = $category_product_id;

        $this->dispatch('initQuillEditor','description'.$this->id);
        $this->dispatch('initQuillEditor','other_data'.$this->id);
        $this->dispatch('initQuillEditor','hse_precuations'.$this->id);
        $this->dispatch('initQuillEditor','recommended_doses'.$this->id);
        $this->dispatch('initQuillEditor','properties'.$this->id);

        $this->render();
        
    }

    #[On('updateValueContent')]
    public function updateValueContent($function_param,$content)
    {
        $this->{$function_param} = $content;
    }

    public function save()
    {
        $data = $this->validate();
        $category_product = CategoryProductService::store($data,$this->product->id);
        $this->dispatch('refreshComponent')->to('Product.Index');
        $this->dispatch('close_modal','تم تعديل الصنف بنجاح');
        $this->dispatch('clean_editor');
    }
}
