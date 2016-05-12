<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDishFoodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dish_foods', function($table) {
            $table->engine = 'InnoDB';
            $table->integer('dish_id')->unsigned();
            $table->string('food_id', 50);
            $table->decimal('quantity', 5, 2);
            $table->integer('measure_idx');
            $table->primary(['dish_id', 'food_id']);
			$table->foreign('dish_id')->references('id')->on('dishes');
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
		//
	}

}
