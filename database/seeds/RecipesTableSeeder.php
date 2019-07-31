<?php

use App\Recipe;
use App\RecipeCategory;
use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('recipes') as $recipeData) {
            /** @var RecipeCategory $category */
            $category = RecipeCategory::where('title', $recipeData['category'])->first();

            if ($category && !$this->getExisting($recipeData, $category)) {
                $category->recipes()->create([
                    'title' => $recipeData['title'],
                    'description' => $recipeData['description']
                ]);
            }
        }
    }

    /**
     * @param array $recipeData
     * @param RecipeCategory $category
     * @return Recipe
     */
    public function getExisting(array $recipeData, RecipeCategory $category)
    {
        return Recipe::where([
            'title' => $recipeData['title'],
            'description' => $recipeData['description'],
            'recipe_category_id' => $category->id
        ])->first();
    }
}
