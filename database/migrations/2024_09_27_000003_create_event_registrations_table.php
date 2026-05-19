<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('order_id')->unique();
            $table->string('snap_token')->default('');
            $table->string('payment_status')->default('pending');
            $table->decimal('amount', 15, 2)->default(0);
            $table->string('proof_image')->default('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
