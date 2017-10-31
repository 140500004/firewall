<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id_usuario');
            $table->unsignedInteger('id_grupo');
            $table->string('login', 50)->unique();
            $table->string('nome', 50);
            $table->string('senha', 50);
            $table->enum('status', ['A', 'I'])->default('A');
            $table->foreign('id_grupo')->references('id_grupo')->on('grupos');
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
		Schema::drop('usuarios');
	}

}
