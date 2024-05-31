<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On; 
use App\Models\CompanyData;
use App\Services\CompanyService;

class Edit extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $value;
    public $company;
    public $id;

    protected $messages = [
        'name.required' => 'يرجى ادخال المحافظة',
        'value.required' => 'يرجى ادخال التفاصيل',
    ];

    public function render()
    {
        return view('livewire.company.edit');
    }

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->company = CompanyData::find($id);
        $this->id = $id;
        $this->name = $this->company->name;
        $this->value = $this->company->value;
        $this->dispatch('initQuillEditor','value'.$this->id);
        $this->render();
        
    }
    #[On('updateEditValueContent')]
    public function updateEditValueContent($value)
    {
        $this->value = $value;
    }

    public function save()
    {
        $data = $this->validate();
        $company = CompanyService::store($data['name'],$data['value'],$this->company->id);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Company.Index');
        $this->dispatch('close_modal','تم تعديل معلمة عن الشركة بنجاح');
        $this->dispatch('clean_editor');
    }
}
