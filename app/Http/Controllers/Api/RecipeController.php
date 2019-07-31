<?php

namespace App\Http\Controllers\Api;

use App\Library\ThumbnailHandler;
use App\Recipe;
use App\RecipeCategory;
use File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class RecipeController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = RecipeCategory::all()->pluck('title', 'id')->toArray();
        return view('recipes.create', compact('categories'));
    }
}
