<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;

class BascketsController extends Controller
{
    public function store($proid)
    {
        $product = Product::findOrFail($proid);
        $product->users()->attach(auth()->user()->id);

        \Cart::add([
            'id' => $product->id,
            'name' => $product->title_fa,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => [
                'dis_price' => $product->dis_price,
                'dis_percent' => $product->dis_percent,
                'gr' => $product->gr,
                'seller' => $product->seller,
                'slug' => $product->slug,
                'image' => $product->image,
            ]
        ]);




        session()->flash('success', 'محصول مورد نظر شما با موفقیت به سبد خرید اضافه شد');
        return back();
    }
}
