<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use App\Services\CategoryProductService;

class Create extends Component
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
    public $special = 0;
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

    protected $messages = [
        'name.required' => 'يرجى ادخال الاسم',
        'uploaded_file' => 'يجب ان يكون الملف المرفوع من نوع (png,jpeg,jpg,gif) ',
        'category_id.required' => 'يرجي اختيار تصنيف لهذا الصنف',
    ];

    public function render()
    {
        $categories = Category::get();
        return view('livewire.product.create',compact('categories'));
    }
    #[On('updateValueContent')]
    public function updateValueContent($function_param,$content)
    {
        $this->{$function_param} = $content;
    }
    public function initQuillEditor($name)
    {
        $this->dispatch('initQuillEditor',$name);
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
    }

    public function save()
    {
        $data = $this->validate();
        $category_product = CategoryProductService::store($data);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Product.Index');
        $this->dispatch('close_modal','تم انشاء الصنف بنجاح');
        $this->dispatch('clean_editor');
    }
}
