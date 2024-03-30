<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On; 

class View extends Component
{
    public User $user; 

    #[On('openViewModal')]
    public function openViewModal($user_id)
    {
        $this->user = User::find($user_id);
        $this->render();
        $this->dispatch('openViewUserModal');
    }
    public function render()
    {
        return view('livewire.user.view');
    }
}
