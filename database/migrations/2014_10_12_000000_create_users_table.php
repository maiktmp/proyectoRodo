<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('correo');
            $table->string('usuario');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('revision_alumno', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_revision');
            $table->date('fecha_entrega');
            $table->string('comentarios', 1000);
            $table->string('documento_url', 1000);
            $table->timestamps();
        });
        Schema::create('profesor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('correo');
            $table->string('usuario');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('historial_profesor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_revisor');
            $table->integer('no_asesor');
            $table->integer('sancion');
            $table->date('ultima_revision');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('proceso', function (Blueprint $table) {
            $table->increments('id');
            $table->string('opcion_tit');
            $table->string('estado');
            $table->timestamps();
            $table->unsignedInteger('fk_id_alumno');

            $table->foreign('fk_id_alumno')
                ->references('id')
                ->on('alumno');

        });
        Schema::create('revision_asesor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_revision');
            $table->string('comentarios', 1000);
            $table->boolean('postura');
            $table->timestamps();
            $table->unsignedInteger('fk_id_proceso');
            $table->unsignedInteger('fk_id_profesor');

            $table->foreign('fk_id_profesor')
                ->references('id')
                ->on('profesor');
            $table->foreign('fk_id_proceso')
                ->references('id')
                ->on('proceso');

        });
        Schema::create('involucrado', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rol');
            $table->string('enterado');
            $table->timestamps();
            $table->unsignedInteger('fk_id_proceso');
            $table->unsignedInteger('fk_id_profesor');

            $table->foreign('fk_id_profesor')
                ->references('id')
                ->on('profesor');

            $table->foreign('fk_id_proceso')
                ->references('id')
                ->on('proceso');

        });
        Schema::create('revision_revisor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_revision');
            $table->date('fecha_limite');
            $table->date('fecha_entrega');
            $table->string('comentarios', 1000);
            $table->boolean('postura');
            $table->string('documento_url', 1000);

            $table->timestamps();
            $table->unsignedInteger('fk_id_proceso');
            $table->unsignedInteger('fk_id_profesor');

            $table->foreign('fk_id_profesor')
                ->references('id')
                ->on('profesor');

            $table->foreign('fk_id_proceso')
                ->references('id')
                ->on('proceso');

        });
        Schema::create('acciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('accion');
            $table->timestamps();
            $table->unsignedInteger('fk_id_involucrado');

            $table->foreign('fk_id_involucrado')
                ->references('id')
                ->on('involucrado');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acciones');
        Schema::dropIfExists('revision_revisor');
        Schema::dropIfExists('involucrado');
        Schema::dropIfExists('revision_asesor');
        Schema::dropIfExists('proceso');
        Schema::dropIfExists('historial_profesor');
        Schema::dropIfExists('profesor');
        Schema::dropIfExists('revision_alumno');
        Schema::dropIfExists('alumno');
    }
}
