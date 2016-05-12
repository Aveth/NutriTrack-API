<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutrientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nutrients', function($table) {
			$table->engine = 'InnoDB';
            $table->string('id', 50)->primary();
            $table->string('name')->index();
            $table->string('unit', 5);
			$table->boolean('is_active');
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
		Schema::drop('nutrients');  
	}

}
