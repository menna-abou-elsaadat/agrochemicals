<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Hash;
use Auth;

class LoginForm extends Component
{
    public $title = 'Login';
    public $email;
    public $password;

    public function render()
    {
        return view('livewire.login-form');
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email',$validatedData['email'])->first();
        if ($user && Hash::check($validatedData['password'], $user->password)) {
                Auth::login($user);
                return redirect()->to('/dashboard');
            
            }

        $this->addError('invalid_credentials', 'Invalid credentails, try again');

    }
}
