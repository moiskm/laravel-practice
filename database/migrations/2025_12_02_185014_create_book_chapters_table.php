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
        Schema::create('book_chapters', function (Blueprint $table) {
            $table->id();
            
            // Relación con el libro (Book)
            $table->foreignId('book_id')
                ->constrained('books')
                ->onDelete('cascade');
            
            // Relación consigo misma para subcapítulos (temas)
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('book_chapters')
                ->onDelete('cascade');
            
            // Título del capítulo o tema
            $table->string('title');
            
            // Descripción opcional
            $table->text('description')->nullable();
            
            // Color personalizado (hexadecimal, ej: #FF5733)
            $table->string('color', 7)->nullable();
            
            // Icono personalizado (nombre de clase de icono o ruta)
            $table->string('icon')->nullable();
            
            // Orden de visualización
            $table->unsignedInteger('order')->default(0);
            
            // Estado activo/inactivo
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
            
            // Índices para mejorar el rendimiento
            $table->index(['book_id', 'parent_id']);
            $table->index('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_chapters');
    }
};
