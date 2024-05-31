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
        $this->name = $this->company->name;
        $this->value = $this->company->value;
        $this->render();
        
    }
    #[On('updateValueContent')]
    public function updateValueContent($content)
    {
        $this->value = $content;
    }
    #[On('initQuillEditor')]
    public function initQuillEditor()
    {
        $this->dispatch('initQuillEditor');
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
