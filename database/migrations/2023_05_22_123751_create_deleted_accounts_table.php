<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deleted_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('is_admin');
            $table->string('email');
            $table->string('avatar', 100);
            $table->integer('status');
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->string('remember_token');
            $table->string('created_user_date');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deleted_accounts');
    }
};
