<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Ejecutar la migración.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // La columna id como clave primaria
            $table->string('title'); // El título del trabajo
            $table->text('description'); // Descripción del trabajo
            $table->string('location'); // Ubicación del trabajo
            $table->string('company_name'); // Nombre de la empresa
            $table->string('salary')->nullable(); // Salario, puede ser nulo
            $table->enum('status', ['open', 'closed', 'pending']); // Estado del trabajo (ej: abierto, cerrado, pendiente)
            $table->string('image')->nullable(); // Columna para almacenar la ruta de la imagen
            $table->string('numero_whatsapp')->nullable(); // Columna para almacenar el número de WhatsApp
            $table->timestamps(); // Las columnas created_at y updated_at

            // Añadir el campo user_id como una clave foránea que se relaciona con la tabla de usuarios
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Deshacer la migración.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
