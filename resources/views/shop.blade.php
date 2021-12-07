<x-app-layout>
    <x-slot name="style">
        <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    </x-slot>
    
    <x-slot name="js">
        <script src="{{ asset('js/shop.js') }}" defer></script>
    </x-slot>

    <x-slot name="search">
        {{ $search }}
    </x-slot>
    {{--------------------- 
            $slot 
        --------------------}}
     <section class="_container">
         <aside>
             <div class="close-btn" onclick="t_aside()"><span class=" material-icons">close</span></div>
            <div class="filter">
                <div class="category">
                    <h3>Category</h3>
                    <ul>
                        @foreach ($category as $item)
                            <li style="color:{{$item->id == $cate ? '#3da8f3':''}}" onclick="updateQuery('category', {{$item->id}})">{{ ucfirst($item->title) }}</li>   
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="sort">
                <h3>Sort</h3>
                <ul>
                    <li style="color:{{'ASC' == $sort ? '#3da8f3':''}}" onclick="updateQuery('sort', 'ASC')">Price: LOW to HIGH</li>
                    <li style="color:{{'DESC' == $sort ? '#3da8f3':''}}" onclick="updateQuery('sort', 'DESC')">Price: HIGH to LOW</li>
                </ul>
            </div>
         </aside>
         <main class="_container">
             @if ($products->isNotEmpty())
             <div>
                 <div class="filter-sort">
                     <button>Filter</button>
                     <button>Sort</button>
                 </div>
             </div>
             @endif
            <div class="products-section">
                
                @if ($products->isNotEmpty())
                    <div class="products-container products-grid">
                        @each('components.product', $products, 'product')
                    </div>
                @else
                    <div style="display: grid;place-items:center">
                        <img style="max-width: 100%" src="{{ asset('img/no-product-found.png') }}" alt="">
                    </div>
                @endif
            </div>
         </main>
     </section>
    {{--------------------- 
            $slot 
        --------------------}}
</x-app-layout>
