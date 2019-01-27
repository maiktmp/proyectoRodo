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
        Schema::create('user_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('username');
            $table->string('password');
            $table->string('email');
            $table->rememberToken();
            $table->timestamps();
            $table->unsignedInteger('fk_id_user_type');

            $table->foreign('fk_id_user_type')
                ->references('id')
                ->on('user_type');
        });

        Schema::create('process', function (Blueprint $table) {
            $table->increments('id');
            $table->date('begin_date');
            $table->date('state_date');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('rol', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('state', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('action', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('process_has_state', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('fk_id_state');
            $table->unsignedInteger('fk_id_process');

            $table->foreign('fk_id_state')
                ->references('id')
                ->on('state');
            $table->foreign('fk_id_process')
                ->references('id')
                ->on('process');
        });

        Schema::create('process_has_action', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger('fk_id_action');
            $table->unsignedInteger('fk_id_process');

            $table->foreign('fk_id_action')
                ->references('id')
                ->on('action');
            $table->foreign('fk_id_process')
                ->references('id')
                ->on('process');
        });

        Schema::create('process_has_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->date('delivery_date')->nullable();
            $table->unsignedInteger('fk_id_user');
            $table->unsignedInteger('fk_id_process');
            $table->unsignedInteger('fk_id_rol');

            $table->foreign('fk_id_user')
                ->references('id')
                ->on('user');
            $table->foreign('fk_id_process')
                ->references('id')
                ->on('process');
            $table->foreign('fk_id_rol')
                ->references('id')
                ->on('rol');

        });

        Schema::create('document', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_document');
            $table->string('url', 1000)->nullable();
            $table->boolean('approved')->default(false);
            $table->unsignedInteger('fk_id_status');
            $table->unsignedInteger('fk_id_user');
            $table->timestamps();
            $table->foreign('fk_id_status')
                ->references('id')
                ->on('status');
            $table->foreign('fk_id_user')
                ->references('id')
                ->on('user');
        });

        Schema::create('process_has_document', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comments', 1000);
            $table->timestamps();
            $table->unsignedInteger('fk_id_document');
            $table->unsignedInteger('fk_id_position');
            $table->unsignedInteger('fk_id_process_has_user');

            $table->foreign('fk_id_process_has_user')
                ->references('id')
                ->on('process_has_user');
            $table->foreign('fk_id_document')
                ->references('id')
                ->on('document');
            $table->foreign('fk_id_position')
                ->references('id')
                ->on('position');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_has_document');
        Schema::dropIfExists('document');
        Schema::dropIfExists('process_has_user');
        Schema::dropIfExists('process_has_action');
        Schema::dropIfExists('process_has_state');
        Schema::dropIfExists('status');
        Schema::dropIfExists('position');
        Schema::dropIfExists('action');
        Schema::dropIfExists('state');
        Schema::dropIfExists('rol');
        Schema::dropIfExists('process');
        Schema::dropIfExists('user');
        Schema::dropIfExists('user_type');
    }
}
