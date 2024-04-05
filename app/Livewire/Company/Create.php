<?php

namespace App\Livewire\Company;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\CompanyData;
use App\Services\CompanyService;

class Create extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $value;

    protected $messages = [
        'name.required' => 'يرجى ادخال المحافظة',
        'value.required' => 'يرجى ادخال القيمة',
    ];

    public function render()
    {
        return view('livewire.company.create');
    }

    public function save()
    {
        $data = $this->validate();
        $company = CompanyService::store($data['name'],$data['value']);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Company.Index');
        $this->dispatch('close_modal','تم انشاء معلمة عن الشركة بنجاح');
    }
}
