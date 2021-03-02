<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->string('estado_proyecto')->nullable();
            $table->foreignId('supervisor_proyecto')->nullable()->constrained('users')->nullable();
            $table->foreignId('interventor_proyecto')->nullable()->constrained('users')->nullable();
            $table->foreignId('contratista_proyecto')->nullable()->constrained('users')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proyectos', function (Blueprint $table) {
            //
        });
    }
}
