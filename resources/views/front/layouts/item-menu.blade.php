<ul class="sub-categories">
    <li>
        <a href="#" class="link back d-flex align-items-center gap-2">{{$current->name}}</a>
    </li>
    @foreach($categories as $category)
        @if($category->subProductCategories->count() > 0)
            <li>
                <a href="{{ route('front.page.show', $category->slug) }}" class="link parent">{{$category->name}}</a>
                @include('front.layouts.item-menu', ['categories' => $category->subProductCategories,  'current' => $category])
            </li>
        @else
            <li><a href="{{ route('front.page.show', $category->slug) }}" class="link">{{$category->name}}</a></li>
        @endif
    @endforeach
</ul>
