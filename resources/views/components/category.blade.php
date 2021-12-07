<a href="{{ route('shop', ['category' => $cate->id]) }}" class="category" style="background-image: url('{{ asset('storage/'.$cate->image) }}')">
    <div class="screen"></div>
    <h3>{{ ucfirst($cate->title) }}</h3>
</a>