<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\Contact;
use App\Services\ContactService;
use Livewire\Attributes\On; 
use Livewire\Attributes\Validate;

class Edit extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $value;
    public Contact $contact;

    protected $messages = [
        'name.required' => 'يرجى ادخال المحافظة',
        'value.required' => 'يرجى ادخال القيمة',
    ];

    #[On('openEditModal')]
    public function openEditModal($id)
    {
        $this->contact = Contact::find($id);
        $this->name = $this->contact->name;
        $this->value = $this->contact->value;
        $this->render();
        
    }

    public function save()
    {
        $data = $this->validate();
        $company = ContactService::store($data['name'],$data['value'],$this->contact->id);
        $this->reset();
        $this->dispatch('refreshComponent')->to('Contact.Index');
        $this->dispatch('close_modal','تم تعديل بنجاح');
    }

    public function render()
    {
        return view('livewire.contact.edit');
    }
}
