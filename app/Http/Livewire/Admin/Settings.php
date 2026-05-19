<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Settings extends Component
{
    public string $midtrans_server_key = '';
    public string $midtrans_client_key = '';
    public string $midtrans_enabled = '1';
    public string $google_client_id = '';
    public string $google_client_secret = '';
    public string $wa_phone = '';
    public string $site_name = '';
    public string $site_description = '';

    public function mount(): void
    {
        $settings = Setting::getAll();
        $this->midtrans_server_key = $settings['midtrans_server_key'] ?? '';
        $this->midtrans_client_key = $settings['midtrans_client_key'] ?? '';
        $this->midtrans_enabled = $settings['midtrans_enabled'] ?? '1';
        $this->google_client_id = $settings['google_client_id'] ?? '';
        $this->google_client_secret = $settings['google_client_secret'] ?? '';
        $this->wa_phone = $settings['wa_phone'] ?? '6281234567890';
        $this->site_name = $settings['site_name'] ?? 'PAPRA Indonesia';
        $this->site_description = $settings['site_description'] ?? '';
    }

    public function save(): void
    {
        $this->validate([
            'midtrans_server_key' => 'nullable|string|max:255',
            'midtrans_client_key' => 'nullable|string|max:255',
            'midtrans_enabled' => 'required|in:0,1',
            'google_client_id' => 'nullable|string|max:255',
            'google_client_secret' => 'nullable|string|max:255',
            'wa_phone' => 'nullable|string|max:20',
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
        ]);

        Setting::setValue('midtrans_server_key', $this->midtrans_server_key);
        Setting::setValue('midtrans_client_key', $this->midtrans_client_key);
        Setting::setValue('midtrans_enabled', $this->midtrans_enabled);
        Setting::setValue('google_client_id', $this->google_client_id);
        Setting::setValue('google_client_secret', $this->google_client_secret);
        Setting::setValue('wa_phone', $this->wa_phone);
        Setting::setValue('site_name', $this->site_name);
        Setting::setValue('site_description', $this->site_description);

        session()->flash('message', 'Pengaturan berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
}
