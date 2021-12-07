<x-admin-layout>
    <x-slot name="style">
        {{-- <link rel="stylesheet" href="{{ asset('css/admin/') }}"> --}}
    </x-slot>
    <x-slot name="js">
        <script src="{{ asset('js/admin/product.js') }}" defer></script>
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
        @if (!$products->isEmpty())
        <h1>Products</h1><br>
        <div style="overflow-x: auto">
            <table style="width: 100%;min-width:650px" class="card">
                <thead>
                    <tr>
                        <td></td>
                        <td>Product({{count($products)}})</td>
                        <td>Price</td>
                        <td>Stock quantity</td>
                        <td>Discount</td>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <div class="img_container">
                                <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}">
                            </div>
                        </td>
                        <td>{{ ucfirst($product->title) }}</td>
                        <td>{{ '$'.$product->price }}</td>
                        <td>{{ $product->stock_quantity.' UNIT' }}</td>
                        <td>{{ $product->discount.'%' }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}">
                                <span class="material-icons">edit</span>
                            </a>
                        </td>
                        <td>
                            <span class="material-icons delete" data-remove="{{$product->id}}">delete</span>
                        </td>
                        <form data-form="{{$product->id}}" style="display: none" action="{{ route('admin.products.destroy', ['product' => $product->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                        </form>
                    </tr>
                @endforeach
            </table>
        </div>
        @else
            <p>No products avialable in stock <a href="{{ route('admin.products.create') }}">CREATE</a></p>
        @endif
    </div>
    <x-modal title="Delete product" ok="DELETE">
        <x-slot name="description">
            Are you sure you want to delete this product?
        </x-slot>
    </x-modal>
    {{-- ------------------- 
            $slot 
        ------------------ --}}
</x-admin-layout>
