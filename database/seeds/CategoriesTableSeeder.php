<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Category;

class CategoriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Category::truncate();
		Category::insert(['id' => '3500', 'name' => 'American Indian/Alaska Native Foods', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0300', 'name' => 'Baby Foods', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1800', 'name' => 'Baked Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1300', 'name' => 'Beef Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1400', 'name' => 'Beverages', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0800', 'name' => 'Breakfast Cereals', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '2000', 'name' => 'Cereal Grains and Pasta', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0100', 'name' => 'Dairy and Egg Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '2100', 'name' => 'Fast Foods', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0400', 'name' => 'Fats and Oils', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1500', 'name' => 'Finfish and Shellfish Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0900', 'name' => 'Fruits and Fruit Juices', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1700', 'name' => 'Lamb, Veal, and Game Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1600', 'name' => 'Legumes and Legume Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '2200', 'name' => 'Meals, Entrees, and Side Dishes', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1200', 'name' => 'Nut and Seed Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1000', 'name' => 'Pork Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0500', 'name' => 'Poultry Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '3600', 'name' => 'Restaurant Foods', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0700', 'name' => 'Sausages and Luncheon Meats', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '2500', 'name' => 'Snacks', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '0200', 'name' => 'Spices and Herbs', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1900', 'name' => 'Sweets', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
		Category::insert(['id' => '1100', 'name' => 'Vegetables and Vegetable Products', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
	}

}
