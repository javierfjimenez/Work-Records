<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('work_records', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description')->nullable();

            // Agregamos un campo priority de tipo ENUM: Restringe los valores a “baja”, “media” o “alta”, evitando datos erroneos.
            $table->enum('priority', ['baja', 'media', 'alta'])->default('media');

            //relación con el model User
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->timestamps();

            // Agrega el índice en created_at para hacer mas eficiente la busqueda por este campo
            $table->index('created_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_records');
    }
};
