<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->timestamps();
        });

        $defaults = [
            'midtrans_server_key' => '',
            'midtrans_client_key' => '',
            'midtrans_enabled' => '1',
            'google_client_id' => '',
            'google_client_secret' => '',
            'wa_phone' => '6281234567890',
            'wa_placeholder' => '1',
            'site_name' => 'PAPRA Indonesia',
            'site_description' => 'Perkumpulan Penggerak Aksi Pengendalian Resistansi Antimikroba',
        ];

        foreach ($defaults as $key => $value) {
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
