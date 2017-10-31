<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('regras', function(Blueprint $table)
		{
			$table->increments('id_regras');
            $table->unsignedInteger('id_grupo')->nullable();
            $table->unsignedInteger('id_usuario')->nullable();
            $table->enum('tipo', ['L', 'B'])->default('B');
            $table->string('url', 50);
            $table->string('descricao', 50)->nullable();
            $table->unique(['id_grupo','url']);
            $table->unique(['id_usuario','url']);
            $table->unique(['tipo','url']);
            $table->unique(['id_grupo', 'id_usuario','url']);

            $table->foreign('id_grupo')->references('id_grupo')->on('grupos');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuarios');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){
		Schema::drop('regras');
	}

}
