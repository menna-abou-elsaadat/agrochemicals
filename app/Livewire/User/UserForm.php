<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Services\UserService;
use Livewire\Attributes\Validate; 

class UserForm extends Component
{
    #[Validate('required')] 
    public $name;
    #[Validate('required|email|unique:users,email')] 
    public $email;
    #[Validate('required')] 
    public $password;
    #[Validate('')] 
    public $region;
    #[Validate('')] 
    public $phone_number;
    #[Validate('')] 
    public $address_1;
    #[Validate('')] 
    public $address_2;
    #[Validate('')]
    public $points = 0;

    protected $messages = [
        'name.required' => 'يرجى ادخال الاسم',
        'email.required' => 'يرجى ادخال البريد الالكتروني للمالك',
        'email.email' => 'يرجي ادخال بريد اللكتروني صحيح',
        'email.unique' => 'هذا البريد اللكتروني متكرر',
        'password.required' => 'يرجى ادخال كلمة المرور للمالك',
    ];

    public function save()
    {
        $data = $this->validate();
        $user = UserService::store(2,$data['name'],$data['email'],$data['password'],$data['phone_number'],$data['address_1'],$data['address_2'],$data['region'],$data['points']);
        $this->dispatch('refreshComponent')->to('User.UsersList');
        $this->dispatch('close_modal','تم انشاء العميل بنجاح');
    }

    public function render()
    {
        return view('livewire.user.form');
    }
}
