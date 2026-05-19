<?php

namespace App\Http\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.frontend')]
class MemberEditProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $phone;
    public $birthdate;
    public $gender;
    public $address;
    public $city;
    public $province;
    public $photo;
    public $existingPhoto;

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'birthdate' => 'nullable|date',
        'gender' => 'nullable|in:Laki-laki,Perempuan',
        'address' => 'nullable|string|max:500',
        'city' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'photo' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'name.required' => 'Nama lengkap wajib diisi.',
        'phone.required' => 'Nomor telepon wajib diisi.',
        'birthdate.date' => 'Format tanggal lahir tidak valid.',
        'gender.in' => 'Jenis kelamin tidak valid.',
        'photo.image' => 'File harus berupa gambar.',
        'photo.max' => 'Ukuran gambar maksimal 2MB.',
    ];

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->birthdate = $user->birthdate;
        $this->gender = $user->gender;
        $this->address = $user->address;
        $this->city = $user->city;
        $this->province = $user->province;
        $this->existingPhoto = $user->member_photo;
    }

    public function save()
    {
        $this->validate();

        $user = auth()->user();
        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
            'province' => $this->province,
        ];

        if ($this->photo) {
            if ($user->member_photo) {
                Storage::disk('public')->delete($user->member_photo);
            }
            $data['member_photo'] = $this->photo->store('member-photos', 'public');
        }

        $user->update($data);

        $this->existingPhoto = $user->fresh()->member_photo;
        $this->photo = null;

        session()->flash('message', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        $provinces = [
            'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau',
            'Kepulauan Riau', 'Jambi', 'Sumatera Selatan',
            'Kepulauan Bangka Belitung', 'Bengkulu', 'Lampung',
            'DKI Jakarta', 'Jawa Barat', 'Banten', 'Jawa Tengah',
            'DI Yogyakarta', 'Jawa Timur', 'Bali',
            'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
            'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan',
            'Kalimantan Timur', 'Kalimantan Utara',
            'Sulawesi Utara', 'Gorontalo', 'Sulawesi Tengah',
            'Sulawesi Barat', 'Sulawesi Selatan', 'Sulawesi Tenggara',
            'Maluku', 'Maluku Utara',
            'Papua Barat', 'Papua Barat Daya', 'Papua',
            'Papua Selatan', 'Papua Tengah', 'Papua Pegunungan',
        ];

        return view('livewire.member-edit-profile', [
            'provinces' => $provinces,
        ]);
    }
}
