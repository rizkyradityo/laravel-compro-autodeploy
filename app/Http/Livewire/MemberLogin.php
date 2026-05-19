<?php

namespace App\Http\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.frontend')]
class MemberLogin extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    protected $rules = [
        'email' => 'required|string',
        'password' => 'required|string',
    ];

    protected $messages = [
        'email.required' => 'Email wajib diisi.',
        'password.required' => 'Password wajib diisi.',
    ];

    public function login()
    {
        $this->validate();

        $field = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (auth()->attempt([$field => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended(route('member.dashboard'));
        }

        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.member-login');
    }
}
