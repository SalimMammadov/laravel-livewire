<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{

    public $form = [
        'email' => "",
        'password' => "",
    ];

    public function render()
    {
        return view('livewire.login');
    }

    public function submit()
    {
        $this->validate([
            'form.email' => 'required|email',
            'form.password' => 'required'
        ]);
        $user = Auth::attempt($this->form);
        if ($user)
            return redirect()->to('/');
        else
            return session()->flash('error', 'Sehvdir');
    }
}
