<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_documento')->nullable();
            $table->string('ruta_documento')->nullable();
            $table->foreignId('proyecto_id')->nullable()->constrained('proyectos')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullable();
            $table->foreignId('updayed_by')->nullable()->constrained('users')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
