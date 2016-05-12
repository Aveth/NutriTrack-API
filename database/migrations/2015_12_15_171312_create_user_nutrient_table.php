<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserNutrientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_nutrients', function($table) {
			$table->engine = 'InnoDB';
            $table->string('user_id', 50);
            $table->string('nutrient_id', 50);
            $table->primary(['user_id', 'nutrient_id']);
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('nutrient_id')->references('id')->on('nutrients');
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
		Schema::drop('user_nutrient');
	}

}
