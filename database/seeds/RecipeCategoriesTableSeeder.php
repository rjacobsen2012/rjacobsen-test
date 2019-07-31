<?php

use App\RecipeCategory;
use Illuminate\Database\Seeder;

class RecipeCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('recipe-categories') as $category) {
            RecipeCategory::firstOrCreate(['title' => $category]);
        }
    }
}
