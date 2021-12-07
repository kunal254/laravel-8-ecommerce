<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        return view('home', [
            'products' => Product::all()->take(8),
            'categories' => Category::all()->take(4)
        ]);
    }

    public function index(Request $request){

        $search_keywords = explode(' ', trim(preg_replace('/\s+/',' ',$request->query('search'))));

        $products = Product::when(! empty($search_keywords), function(Builder $query) use ($search_keywords){
            return $query->where(function(Builder $query) use ($search_keywords){
                foreach ($search_keywords as $keyword) {
                    $query->orWhere('about', 'LIKE', "%{$keyword}%");
                }
            });
        })->when(!empty($request->query('category')), function(Builder $query) use ($request){
            return $query->where('category_id', $request->query('category'));
        })->when(! empty($request->query('sort')), function(Builder $query) use ($request){
            return $query->orderBy('price', $request->query('sort'));
        })->get();


        return view('shop', [
            'search' => $request->query('search'),
            'products' => $products,
            'category' => Category::all(),
            'sort' => $request->query('sort') ?? '',
            'cate' => $request->query('category') ?? ''
        ]);
    }

}
