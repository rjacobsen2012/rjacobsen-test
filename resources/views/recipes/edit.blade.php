@extends('layouts.main')

@section('content')
    @guest
        <h1>Not Authorized. Please log in.</h1>
    @else
        <div class="row h-100" id="row-main">
            <div class="col-md-10" id="content pt-4">
                <div class="recipe pt-4">
                    {{ Form::open(['url' => route('recipes.destroy', [$recipe->id]), 'name' => 'delete', 'style' => 'display: none', 'id' => 'recipe' . $recipe->id]) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::close() }}
                    {{ Form::open(['url' => route('recipes.update', [$recipe->id]), 'name' => 'update', 'enctype' => 'multipart/form-data']) }}
                    @csrf
                    @method('PUT')
                    {{ Form::hidden('recipe_category_id', $recipe->recipe_category_id) }}
                    {{ Form::hidden('current_thumbnail', $recipe->thumbnail) }}
                    <div class="form-group">
                        {{ Form::text('title', old('title', $recipe->title), ['class' => 'form-control', 'placeholder' => 'Title']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::text('description', old('description', $recipe->description), ['class' => 'form-control', 'placeholder' => 'Description']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::file('thumbnail', ['style' => 'display:none;']) }}
                        <div class="file-upload flex-row justify-content-start">
                            <button id="choose_file_button" type="button" class="btn btn-light btn-sm btn-shadow">Choose File...</button>
                            @if ($recipe->thumbnail)
                                <span id="chosen_file" style="padding-left: 5px;">{{ basename($recipe->thumbnail_download) }}</span>
                            @else
                                <span id="chosen_file" style="padding-left: 5px;">No file chosen</span>
                            @endif
                        </div>
                        @if($recipe->thumbnail)
                            <div>
                                <img src="/{{ $recipe->thumbnail_download }}">
                            </div>
                        @endif
                    </div>
                    <div class="buttons">
                        <a href="{{ route('recipes.index') }}" title="All Recipes" class="btn btn-light btn-sm ml-2 mb-2 mt-2 btn-shadow">All Recipes</a>
                        <a href="{{ route('recipes.show', [$recipe->id]) }}" title="Show Recipe" class="btn p-0 ml-2"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        {{ Form::button('<i class="fa fa-floppy-o" aria-hidden="true"></i>', [
                            'type' => 'submit',
                            'style' => 'background:transparent; border:none',
                            'title' => 'Save Changes',
                            'class' => 'btn p-0 ml-2'
                        ]) }}
                        <button type="button" data-recipe-id="recipe{{ $recipe->id }}" title="Delete Recipe" class="btn p-0 ml-2 trash"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </div>
                    {{ Form::close() }}
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
