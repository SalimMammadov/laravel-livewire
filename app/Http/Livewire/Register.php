<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{

    public $form = [
        'name' => "",
        'email' => "",
        'password' => "",
        'password_confirmation' => ""
    ];

    public function submit()
    {
        $this->validate([
            'form.email' => 'required|email',
            'form.name' => 'required',
            'form.password' => 'required|confirmed'
        ]);
        $user = new User;
        $user->email = $this->form['email'];
        $user->name = $this->form['name'];
        $user->password = Hash::make($this->form['password']);
        $user->save();
        return redirect()->to('/login');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
