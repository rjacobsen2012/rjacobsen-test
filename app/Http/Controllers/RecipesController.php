<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeValidator;
use App\Library\ThumbnailHandler;
use App\Recipe;
use App\RecipeCategory;
use Exception;
use File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class RecipesController extends Controller
{
    /** @var ThumbnailHandler  */
    protected $thumbnailHandler;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->thumbnailHandler = app(ThumbnailHandler::class);
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $recipes = Recipe::all();
        $recipeCategories = RecipeCategory::all();

        return view('recipes.index', compact('recipes', 'recipeCategories'));
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * @param RecipeValidator $request
     * @param Recipe $recipe
     * @return RedirectResponse
     */
    public function update(RecipeValidator $request, Recipe $recipe)
    {
        $validated = $request->validated();
        $thumbnail = $request->get('current_thumbnail');

        if ($request->hasFile('thumbnail')) {
            if ($oldThumbnail = $recipe->thumbnail) {
                File::delete($oldThumbnail);
            }

            $thumbnail = $this->thumbnailHandler->extractDocumentPostData($recipe->id, $request);
            $request->file('thumbnail')->move(dirname($thumbnail), public_path($thumbnail));
        }

        $recipe->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'thumbnail' => $thumbnail
        ]);

        flash()->success('Recipe updated successfully');

        return back();
    }

    public function store(RecipeValidator $request)
    {
        $validated = $request->validated();

        /** @var Recipe $recipe */
        $recipe = Recipe::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'recipe_category_id' => $validated['recipe_category_id']
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $this->thumbnailHandler->extractDocumentPostData($recipe->id, $request);
            $request->file('thumbnail')->move(dirname($thumbnail), public_path($thumbnail));
            $recipe->update(['thumbnail' => $thumbnail]);
        }

        flash()->success('Recipe added successfully');

        return redirect()->to(route('recipes.index'));
    }

    /**
     * @param Recipe $recipe
     * @return RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect(route('recipes.index'));
    }
}
