<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMealItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('meal_items', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id', true);
            $table->integer('meal_id')->unsigned();
            $table->string('food_id', 50);
            $table->decimal('quantity', 5, 2);
            $table->integer('measure_idx');
            $table->timestamps();
            $table->foreign('meal_id')->references('id')->on('meals');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('meal_items');
	}

}
