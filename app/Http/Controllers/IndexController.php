<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Category;
use App\Models\Poster;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::where('parent_id', 0)->get();
        $posters = Poster::all();
        $newProducts = Product::orderby('id', 'desc')->limit(7)->get();
        $secondOffers = Product::inRandomOrder()->limit(2)->get();
        $discountProducts = Product::where('dis_price', '!=', null)->get();

        if (auth()->user()) {
            $user = User::findOrFail(auth()->user()->id);
            $basket = $user->products;
        }
        else{
            $basket=null;
        }


        return view('index')->with([
            'categories' => $categories,
            'sliders' => $sliders,
            'newProducts' => $newProducts,
            'posters' => $posters,
            'secondOffers' => $secondOffers,
            'discountProducts' => $discountProducts,
            'basket' => $basket

        ]);
    }

    public function product($slug)
    {
        $categories = Category::where('parent_id', 0)->get();
        $product = Product::where('slug', $slug)->first();
        $similars = Product::where('category_id', $product->category_id)->limit(7)->get();
        $comments=Comment::where([['parent_id',0],['product_id',$product->id]])->get();

        $responses=Comment::where([['product_id',$product->id],['parent_id','!=',0]])->get();

        if (auth()->user()) {
            $user = User::findOrFail(auth()->user()->id);
            $basket = $user->products;
        }
        else{
            $basket=null;
        }

        return view('product')
            ->with('categories', $categories)
            ->with('product', $product)
            ->with('similars', $similars)
            ->with('basket', $basket)
            ->with('comments', $comments)
            ->with('responses', $responses);
    }

    public function showCatProducts($categoryName)
    {
        $categories = Category::where('parent_id', 0)->get();
        $categoryID = Category::where('name', $categoryName)->first();
        $products = Product::where('category_id', $categoryID->id)->get();

        return view('category')
            ->with('products', $products)
            ->with('categories', $categories);
    }

    public function cart()
    {

        $categories = Category::where('parent_id', 0)->get();
        $user=User::findOrFail(auth()->user()->id);
        $basket=$user->products;
        $cartItems = \Cart::getcontent();
        return view('cart')->with(['categories' => $categories,'basket'=>$basket,'cartItems'=>$cartItems]);
    }

    public function search(){
        $products=Product::search()->get();
        $categories = Category::where('parent_id', 0)->get();

        if (auth()->user()) {
            $user = User::findOrFail(auth()->user()->id);
            $basket = $user->products;
        }
        else{
            $basket=null;
        }

        return view('search')->with([
            'products'=>$products,
            'categories'=>$categories,
            'basket'=>$basket
        ]);
    }
}
