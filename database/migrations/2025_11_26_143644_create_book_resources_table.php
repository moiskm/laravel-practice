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
        Schema::create('book_resources', function (Blueprint $table) {
            $table->id();

            // Relación con el libro (Book)
            $table->foreignId('book_id')
                ->constrained('books')
                ->onDelete('cascade');

            // Tipo de recurso: pdf, video, audio, game, etc.
            $table->enum('type', ['pdf', 'video', 'audio', 'game']);

            // Título o nombre del recurso
            $table->string('title');

            // Ruta o URL del archivo
            $table->string('file_path')->nullable();

            // URL externa (por ejemplo, video alojado en otra plataforma)
            $table->string('external_url')->nullable();

            // Duración (para audio/video/juego) en segundos
            $table->integer('duration_seconds')->nullable();

            // Orden de aparición del recurso dentro del libro
            $table->unsignedInteger('display_order')->default(0);

            // Campos opcionales adicionales
            $table->text('description')->nullable();
            $table->json('metadata')->nullable(); // información extra (resolución, tamaño, etc.)

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_resources');
    }
};
