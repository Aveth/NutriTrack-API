<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Nutrient;

class NutrientsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Nutrient::truncate();
		Nutrient::insert(['id' => '203', 'name' => 'Protein', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '204', 'name' => 'Total Fat', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '205', 'name' => 'Carbohydrate', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '208', 'name' => 'Energy', 'unit' => 'kcal', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '255', 'name' => 'Water', 'unit' => 'g', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '262', 'name' => 'Caffeine', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '269', 'name' => 'Sugar', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '291', 'name' => 'Dietary Fiber', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '301', 'name' => 'Calcium', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '303', 'name' => 'Iron', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '304', 'name' => 'Magnesium', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '305', 'name' => 'Phosphorus', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '306', 'name' => 'Potassium', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '307', 'name' => 'Sodium', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '309', 'name' => 'Zinc', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '318', 'name' => 'Vitamin A (IU)', 'unit' => 'IU', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '320', 'name' => 'Vitamin A (RAE)', 'unit' => 'µg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '323', 'name' => 'Vitamin E', 'unit' => 'g', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '324', 'name' => 'Vitamin D', 'unit' => 'IU', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '328', 'name' => 'Vitamin D (D2 + D3)', 'unit' => 'µg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '401', 'name' => 'Vitamin C', 'unit' => 'mg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '404', 'name' => 'Thiamin', 'unit' => 'mg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '405', 'name' => 'Riboflavin', 'unit' => 'mg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '406', 'name' => 'Niacin', 'unit' => 'mg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '415', 'name' => 'Vitamin B6', 'unit' => 'mg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '418', 'name' => 'Vitamin B12', 'unit' => 'µg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '430', 'name' => 'Vitamin K', 'unit' => 'µg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '435', 'name' => 'Folate', 'unit' => 'µg', 'is_active' => false, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '601', 'name' => 'Cholesterol', 'unit' => 'mg', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '605', 'name' => 'Trans Fat', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '606', 'name' => 'Saturated Fat', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '645', 'name' => 'Monounsaturated Fat', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Nutrient::insert(['id' => '646', 'name' => 'Polyunsaturated Fat', 'unit' => 'g', 'is_active' => true, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
	}

}
