<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Media;
use Illuminate\Support\Str;

class EventRegistrationForm extends Component
{
    use WithFileUploads;

    public $step = 1;
    public $event_id;
    public $name;
    public $email;
    public $phone;
    public $payment_method = 'midtrans';
    public $proof_image;
    public $registration;
    public $events;

    protected $rules = [
        'event_id' => 'required|exists:events,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'payment_method' => 'required|in:midtrans,qris',
        'proof_image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'event_id.required' => 'Pilih event yang ingin diikuti.',
        'event_id.exists' => 'Event tidak ditemukan.',
        'name.required' => 'Nama lengkap wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'phone.required' => 'Nomor telepon wajib diisi.',
        'proof_image.image' => 'File harus berupa gambar.',
        'proof_image.max' => 'Ukuran gambar maksimal 2MB.',
    ];

    public function mount($event = null)
    {
        $this->events = Event::where('published', true)->orderBy('event_date', 'desc')->get();

        if ($event) {
            $found = $this->events->firstWhere('id', $event);
            if ($found) {
                $this->event_id = $found->id;
            }
        }
    }

    public function getSelectedEventProperty()
    {
        if (!$this->event_id) return null;
        return Event::find($this->event_id);
    }

    public function nextStep()
    {
        $rules = [];
        if ($this->step === 1) {
            $rules['event_id'] = 'required|exists:events,id';
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
            $rules['phone'] = 'required|string|max:20';
        } elseif ($this->step === 2) {
            $rules['payment_method'] = 'required|in:midtrans,qris';
            if ($this->payment_method === 'qris') {
                $rules['proof_image'] = 'required|image|max:2048';
            }
        }

        $this->validate($rules);

        if ($this->step === 2) {
            $this->submitRegistration();
            $this->step = 3;
        } else {
            $this->step++;
        }
    }

    public function prevStep()
    {
        $this->step = max(1, $this->step - 1);
    }

    public function updatedPaymentMethod($value)
    {
        if ($value === 'midtrans') {
            $this->proof_image = null;
        }
    }

    public function submitRegistration()
    {
        $this->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:midtrans,qris',
        ]);

        $event = Event::findOrFail($this->event_id);

        $orderId = 'EVT-' . strtoupper(Str::random(8)) . '-' . time();

        $proofPath = null;
        if ($this->payment_method === 'qris' && $this->proof_image) {
            $path = $this->proof_image->store('proofs', 'public');
            $media = Media::create([
                'original_name' => $this->proof_image->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $this->proof_image->getMimeType(),
                'size' => $this->proof_image->getSize(),
            ]);
            $proofPath = $path;
        }

        $paymentStatus = $this->payment_method === 'midtrans' ? 'pending' : 'pending_qris';

        $this->registration = EventRegistration::create([
            'event_id' => $this->event_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'order_id' => $orderId,
            'payment_status' => $paymentStatus,
            'amount' => $event->price,
            'proof_image' => $proofPath,
        ]);

        session()->flash('message', 'Pendaftaran berhasil!');
    }

    public function render()
    {
        return view('livewire.event-registration-form')
            ->layout('layouts.frontend', ['title' => 'Pendaftaran Event']);
    }
}
