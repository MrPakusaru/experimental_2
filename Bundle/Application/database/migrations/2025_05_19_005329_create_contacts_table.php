<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exp_contacts', function (Blueprint $table) {
            $table->id();
            $table->string('SURNAME', length: 50)->charset('utf8mb4')->nullable();
            $table->string('NAME', length: 50)->charset('utf8mb4')->nullable(false);
            $table->string('LAST_NAME', length: 50)->charset('utf8mb4')->nullable();
            $table->string('EMAIL', length: 50)->charset('utf8mb4')->nullable();
            $table->string('PHONE', length: 20)->nullable();
            $table->date('BIRTH_DATE')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
