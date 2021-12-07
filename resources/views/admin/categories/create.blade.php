<x-admin-layout>
    <x-slot name="style">
        {{-- <link rel="stylesheet" href="{{ asset('css/admin/') }}"> --}}
    </x-slot>

    {{--------------------- 
            $slot 
        --------------------}}
        <div class="_container">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <p style="color: red">{{ $error }}</p>
                @endforeach
            @endif
            <h2>Create a new category</h2>
            <form class="card" action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                Category Name: <input type="text" name="title" value="{{ old('title') }}" required placeholder="Category name"><br><br>
                Choose Img: <br><br>
                <input type="file" name="image" required><br><br>
                <input type="submit" value="create category">
            </form>
        </div>
    {{--------------------- 
            $slot 
        --------------------}}
</x-admin-layout>