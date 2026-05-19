<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Donation;
use Illuminate\Support\Str;

class DonationForm extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $amount;
    public $message;
    public $payment_method = 'midtrans';
    public $proof_image;
    public $step = 1;
    public $success = false;
    public $order_id;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'phone' => 'required|min:8',
        'amount' => 'required|numeric|min:1000',
        'message' => 'nullable|max:500',
        'payment_method' => 'required|in:midtrans,qris',
        'proof_image' => 'nullable|image|max:5120',
    ];

    protected $messages = [
        'name.required' => 'Nama lengkap wajib diisi.',
        'name.min' => 'Nama minimal 3 karakter.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'phone.required' => 'Nomor telepon wajib diisi.',
        'phone.min' => 'Nomor telepon minimal 8 karakter.',
        'amount.required' => 'Jumlah donasi wajib diisi.',
        'amount.numeric' => 'Jumlah donasi harus berupa angka.',
        'amount.min' => 'Minimal donasi Rp 1.000.',
        'message.max' => 'Pesan maksimal 500 karakter.',
        'proof_image.image' => 'File harus berupa gambar.',
        'proof_image.max' => 'Ukuran gambar maksimal 5MB.',
    ];

    public function setAmount($value)
    {
        $this->amount = $value;
    }

    public function updatedPaymentMethod($value)
    {
        if ($value === 'midtrans') {
            $this->proof_image = null;
        }
    }

    public function submit()
    {
        $this->validate();

        $order_id = 'DON-' . strtoupper(Str::random(10));

        $donation = Donation::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'amount' => $this->amount,
            'message' => $this->message ?? '',
            'order_id' => $order_id,
            'payment_status' => $this->payment_method === 'midtrans' ? 'pending' : 'pending_qris',
        ]);

        if ($this->payment_method === 'qris' && $this->proof_image) {
            $path = $this->proof_image->store('proofs', 'public');
            $donation->update(['proof_image' => $path]);
        }

        $this->order_id = $order_id;
        $this->success = true;
        $this->step = 3;
    }

    public function render()
    {
        return view('livewire.donation-form')
            ->layout('layouts.frontend', ['title' => 'Donasi']);
    }
}
