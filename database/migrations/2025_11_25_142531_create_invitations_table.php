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
        Schema::create('invitations', function (Blueprint $table) {
            $table->id('id_invitation'); // Primary Key
            $table->string('nama');
            $table->string('email')->nullable();
            $table->integer('jml_hadir')->nullable()->default(0);
            $table->string('code_qr')->unique()->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['belum', 'hadir'])->default('belum');
            $table->timestamps(); // created_at & updated_at otomatis
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
