<a href="{{ route('product', ['product' => $product->id]) }}" class="product_card">
    <div>
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ ucfirst($product->title) }}">
    </div>
    <h3>{{ ucfirst($product->title) }}</h3>
    <p>{{ "$".$product->price }}</p>
</a>