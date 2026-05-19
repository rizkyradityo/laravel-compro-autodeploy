<?php

namespace App\Http\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

#[Layout('layouts.frontend')]
class MemberRegister extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'phone' => 'required|string|max:20',
        'password' => 'required|string|min:8|confirmed',
    ];

    protected $messages = [
        'name.required' => 'Nama lengkap wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'phone.required' => 'Nomor telepon wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'role' => 'user',
        ]);

        auth()->login($user);
        session()->regenerate();

        return redirect()->intended(route('member.dashboard'));
    }

    public function render()
    {
        return view('livewire.member-register');
    }
}
