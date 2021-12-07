<x-admin-layout>
    <x-slot name="style">
        {{-- <link rel="stylesheet" href="{{ asset('css/admin/') }}"> --}}
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('js/admin/category.js') }}" defer></script>
    </x-slot>

    {{-- ------------------- 
            $slot 
        ------------------ --}}
    <div class="_container">
        @if (session('status'))
            <p style="color: #3ee33e">
                {{ session('status') }}
            </p>
        @endif
        @if (!$categories->isEmpty())
        <h1>Categories</h1><br>

        <div style="overflow-x: auto">
            <table style="width: 100%;min-width:450px" class="card">
                <thead>
                    <tr>
                        <td colspan="2">Category({{count($categories)}})</td>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                @foreach ($categories as $category)
                    <tr>
                        <td>
                            <div class="img_container img_cate">
                                <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->title }}">
                            </div>
                        </td>
                        <td>{{ $category->title }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}">
                                <span class="material-icons">edit</span>
                            </a>
                        </td>
                        <td>
                            <span class="material-icons delete" data-remove="{{$category->id}}">delete</span>
                        </td>
                        <form data-form="{{$category->id}}" style="display: none" action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                    </tr>
                @endforeach
            </table>
        </div>
        @else
            <p>No categories created yet <a href="{{ route('admin.categories.create') }}">CREATE</a></p>
        @endif
    </div>
    <x-modal title="Delete Category" ok="DELETE">
        <x-slot name="description">
            Are you sure you want to delete this category?
        </x-slot>
    </x-modal>
    {{-- ------------------- 
            $slot 
        ------------------ --}}
</x-admin-layout>
