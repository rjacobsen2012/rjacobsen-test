@extends('layouts.main')

@section('content')
    @guest
        <h1>Not Authorized. Please log in.</h1>
    @else
        <div class="row h-100" id="row-main">
            <div class="col-md-10" id="content pt-4">
                <div class="recipes pt-4">
                    @if(!empty($recipes))
                        @foreach($recipes as $recipe)
                            <div class="card recipe-card">
                                <div class="recipe-card-body">
                                    <div class="title pl-3 pt-3 pb-3">{{ $recipe->title }}</div>
                                    <div class="thumbnail"><img src="{{ asset($recipe->thumbnail) }}" class="card-image"></div>
                                    <div class="description pl-3 pt-3 pb-3">{{ $recipe->description }}</div>
                                    <div class="buttons">
                                        {{ Form::open(['url' => route('recipes.destroy', [$recipe->id]), 'name' => 'delete', 'style' => 'display: none', 'id' => 'recipe' . $recipe->id]) }}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{ Form::close() }}
                                        <a href="{{ route('recipes.show', [ $recipe->id ]) }}" title="View Recipe" class="btn btn-light btn-sm ml-2 mb-2 mt-2 btn-shadow">Read More</a>
                                        <a href="{{ route('recipes.edit', [ $recipe->id ]) }}" title="Edit Recipe" class="btn p-0 ml-2 mt-2"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <a href="#" data-recipe-id="recipe{{ $recipe->id }}" title="Delete Recipe" class="btn p-0 ml-2 mt-2 trash"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        No Recipes
                    @endif
                </div>
            </div>
            <div class="col-md-2 categories-sidebar h-100" id="categories-sidebar">
                <div class="search-holder">
                    {{ Form::text('search', null, ['id' => 'cat_search', 'class' => 'form-control input-sm p-1 mt-2 search-field',  'placeholder' => 'Search']) }}
                    <a href="#" title="Clear Search" class="btn p-0 ml-2 clear-search"><i class="fa fa-times-circle-o fa-lg" style="color: #C1BDC2" aria-hidden="true"></i></a>
                </div>
                <div id="categories_holder"></div>
            </div>
        </div>
    @endif
@endsection
