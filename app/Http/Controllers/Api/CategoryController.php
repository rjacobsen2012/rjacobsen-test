<?php

namespace App\Http\Controllers\Api;

use App\Library\ThumbnailHandler;
use App\Recipe;
use App\RecipeCategory;
use File;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
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
        $this->thumbnailHandler = app(ThumbnailHandler::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $term
     * @return Factory|View
     */
    public function index($term = null)
    {
        $categories = $term ?
            RecipeCategory::where('title', 'like', "%{$term}%")->get() :
            RecipeCategory::all();

        return view('categories.index', compact('categories'));
    }
}
