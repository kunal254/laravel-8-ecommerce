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
            <h2>Create a new product</h2>
            <form class="card" action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <fieldset style="max-width: 200px">
                    <legend>Category</legend>
                    <select name="category_id" required>
                        @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option selected value="{{$category->id}}">{{ ucfirst($category->title) }}</option>
                                @continue
                            @endif
                            <option value="{{$category->id}}">{{ ucfirst($category->title) }}</option>
                        @endforeach
                    </select>
                </fieldset><br>

                Product Name: <input type="text" name="title" value="{{ old('title') }}" required placeholder="Product name"><br><br>

                Choose Img: <br><br>
                <input type="file" name="image" required><br><br>

                Product info: <input type="text" name="about" value="{{ old('about') }}" required placeholder="Product info"><br><br>

                Product price: <input type="number" name="price" min="0" value="{{ old('price') }}" required><br><br>

                Product stock quantity: <input type="number" min="0" name="stock_quantity" value="{{ old('stock_quantity') }}" required><br><br>

                Product discount: <input type="number" min="0" value="{{ old('discount') }}" name="discount" step="5"><br><br>

                <input type="submit" value="Create product">
            </form>
        </div>
    {{--------------------- 
            $slot 
        --------------------}}
</x-admin-layout>