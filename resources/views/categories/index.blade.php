<div class="categories">
    @if(!empty($categories))
        @foreach($categories as $category)
            <div class="category p-2">
                <img src="{{ asset($category->thumbnail) }}" class="category-image">
                <div class="pl-3">{{ $category->title }}</div>
            </div>
        @endforeach
    @else
        No Categories
    @endif
</div>
