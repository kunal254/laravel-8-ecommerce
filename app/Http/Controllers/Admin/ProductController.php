<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    
    public function index()
    {
        return view('admin.products.products', [
            'products' => Product::all()
        ]);
    }

   
    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all('id', 'title')
        ]);
    }

   
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|max:50',
            'about' => 'required|max:1000',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'discount' => 'multiple_of:5|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);

        $path = Storage::putFile('products', $validated['image']);

        $product = new Product();
        $category = Category::find($validated['category_id']);

        $product->title = $validated['title'];
        $product->image = $path;
        $product->about = $validated['about'];
        $product->price = $validated['price'];
        $product->stock_quantity = $validated['stock_quantity'];

        $request->whenHas('discount', function ($input) use ($product){
            $product->discount = $input;
        });

        $category->products()->save($product);

        return redirect()->route('admin.products.index')->with('status', 'product added successfully');
    }

    
    // public function show(Product $product)
    

    
    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all('id', 'title')
        ]);
    }

    
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => 'required|image|max:50',
            'about' => 'required|max:1000',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|numeric|min:0',
            'discount' => 'multiple_of:5|min:0',
            'category_id' => 'required|exists:categories,id'
        ]);
        
        $product->title = $validated['title'];

        if($request->has(['image', 'discount'])){
            Storage::delete($product->image);
            $path = Storage::putFile('products', $validated['image']);
            $product->image = $path;

            $product->discount = $validated['discount'];
        }

        $product->about = $validated['about'];
        $product->price = $validated['price'];
        $product->stock_quantity = $validated['stock_quantity'];

        $category = Category::find($validated['category_id']);

        $category->products()->save($product);


        return redirect()->route('admin.products.index')->with('status', 'product updated successfully');
    }

   
    public function destroy(Product $product)
    {
        Storage::delete($product->image);
        $title = $product->title;
        $product->delete();

        return redirect()->route('admin.products.index')->with('status', 'product "'.$title.'" deleted successfully');
    }
}
