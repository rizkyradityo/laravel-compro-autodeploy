<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('member_photo')->nullable()->after('phone');
            $table->string('birthdate')->nullable()->after('member_photo');
            $table->string('gender')->nullable()->after('birthdate');
            $table->text('address')->nullable()->after('gender');
            $table->string('city')->nullable()->after('address');
            $table->string('province')->nullable()->after('city');
            $table->string('account_type')->default('manual')->after('province');
            $table->string('google_id')->nullable()->after('account_type');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone', 'member_photo', 'birthdate', 'gender',
                'address', 'city', 'province', 'account_type', 'google_id'
            ]);
        });
    }
};
