<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryValidator;
use App\Library\ThumbnailHandler;
use App\Recipe;
use App\RecipeCategory;

class CategoriesController extends Controller
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

    public function store(CategoryValidator $request)
    {
        $validated = $request->validated();

        /** @var RecipeCategory $category */
        $category = RecipeCategory::create([
            'title' => $validated['title']
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $this->thumbnailHandler->extractDocumentPostData($category->id, $request);
            $request->file('thumbnail')->move(dirname($thumbnail), public_path($thumbnail));
            $category->update(['thumbnail' => $thumbnail]);
        }

        flash()->success('Category added successfully');

        return redirect()->to(route('recipes.index'));
    }
}
