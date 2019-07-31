<ul class="nav nav-tabs create-tabs">
    <li class="active"><a data-toggle="tab" href="#recipe_add" class="heading">Add Recipe</a></li>
    <li><a data-toggle="tab" href="#category_add" class="heading">Add Category</a></li>
</ul>

<div class="tab-content">
    <div id="recipe_add" class="tab-pane fade in active" style="opacity: 100">
        <div class="new-recipe p-4">
            @if(count($categories))
                {{ Form::open(['url' => route('recipes.store'), 'name' => 'recipe_store', 'enctype' => 'multipart/form-data', 'id' => 'create_recipe_form', 'class' => 'w-100']) }}
                <div class="form-group title pt-3 w-100">
                    <div>Add Title</div>
                    {{ Form::text('title', old('title'), ['class' => 'form-group color-field w-100', 'id' => 'title_field']) }}
                </div>

                <div class="form-group category pt-2 w-100 flex-column justify-content-start align-items-start">
                    <div>Select Category</div>
                    <select name="recipe_category_id" class="color-field w-100" id="category_field">
                        <option></option>
                        @foreach($categories as $id => $category)
                            <option value="{{ $id }}">{{ $category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group description pt-2 w-100">
                    <div>Add Description</div>
                    {{ Form::text('description', old('description'), ['class' => 'form-group color-field w-100', 'id' => 'description_field']) }}
                </div>

                <div class="form-group">
                    {{ Form::file('thumbnail', ['style' => 'display:none;', 'id' => 'rec_thumbnail']) }}
                    <div class="file-upload flex-row justify-content-start">
                        <button id="choose_rec_file_button" type="button" class="btn btn-light btn-sm btn-shadow btn-text-small p-1">Choose File</button>
                        <span id="rec_chosen_file" style="padding-left: 5px;">No file chosen</span>
                    </div>
                </div>

                <div class="buttons">
                    <button type="button" id="add_recipe" class="btn btn-sm add-category btn-shadow disabled" disabled="disabled">Add</button>
                    <button type="button" class="btn btn-sm btn-shadow" data-dismiss="modal">Cancel</button>
                </div>
                {{ Form::close() }}
            @else
                Please add some categories first.
            @endif
        </div>
    </div>
    <div id="category_add" class="tab-pane fade">
        <div class="new-category p-4">
            {{ Form::open(['url' => route('categories.store'), 'name' => 'category_store', 'enctype' => 'multipart/form-data', 'id' => 'create_cat_form', 'class' => 'w-100']) }}
            <div class="form-group title pt-3 w-100">
                <div>Add Title</div>
                {{ Form::text('title', old('title'), ['class' => 'form-group color-field w-100', 'id' => 'cat_title_field']) }}
            </div>

            <div class="form-group">
                {{ Form::file('thumbnail', ['style' => 'display:none;', 'id' => 'cat_thumbnail']) }}
                <div class="file-upload flex-row justify-content-start">
                    <button id="choose_cat_file_button" type="button" class="btn btn-light btn-sm btn-shadow btn-text-small p-1">Choose File</button>
                    <span id="cat_chosen_file" style="padding-left: 5px;">No file chosen</span>
                </div>
            </div>

            <div class="buttons">
                <button type="submit" id="add_category" class="btn btn-sm add-category btn-shadow disabled" disabled="disabled">Add</button>
                <button type="button" class="btn btn-sm btn-shadow" data-dismiss="modal">Cancel</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
