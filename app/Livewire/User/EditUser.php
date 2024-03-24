<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Services\UserService;
use Livewire\Attributes\Validate;
use Livewire\Attributes\On; 
use App\Models\User;

class EditUser extends Component
{
    public User $user;
    public $name;
    public $email;
    public $password;
    public $region;
    public $phone_number;
    public $address_1;
    public $address_2;
    public $points = 0;
    public $user_id;

    protected $messages = [
        'name.required' => 'يرجى ادخال الاسم',
        'email.required' => 'يرجى ادخال البريد الالكتروني للمالك',
        'email.email' => 'يرجي ادخال بريد اللكتروني صحيح',
        'email.unique' => 'هذا البريد اللكتروني متكرر',
        'password.required' => 'يرجى ادخال كلمة المرور للمالك',
    ];

    public function render()
    {
        return view('livewire.user.edit-user');
    }

    #[On('openEditModal')]
    public function openEditModal($user_id)
    {
        $user = User::find($user_id);
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->region = $user->region;
        $this->phone_number = $user->phone_number;
        $this->address_1 = $user->address_1;
        $this->address_2 = $user->address_2;
        $this->points = $user->points;
        $this->user_id = $user->id;
        $this->render();
        
    }

    public function save()
    {
        $data = $this->validate([
            'name' =>'required',
            'email' => 'required|email|unique:users,email,'.$this->user_id,
            'password'=>'',
            'phone_number'=>'',
            'region'=>'',
            'address_1'=>'',
            'address_2'=>'',
            'points'=>''
        ]);
        $user = UserService::store(2,$data['name'],$data['email'],$data['password'],$data['phone_number'],$data['address_1'],$data['address_2'],$data['region'],$data['points'],$this->user_id);
        $this->dispatch('refreshComponent')->to('User.UsersList');
        $this->dispatch('close_modal','تم تعديل العميل بنجاح');
    }
}
