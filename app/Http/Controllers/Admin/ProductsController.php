<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin/products/index')->with('products', $products);
    }

    public function create()
    {
        $categories=Category::all();
        return view('admin/products/create')->with(['categories'=>$categories]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'category_id'=>['required'],
            'title_fa'=>['required'],
            'title_en'=>['required'],
            'image'=>['required','image','mimes:jpg,png,jpeg,webp'],
            'price'=>['required'],
            'gr'=>['required'],
            'brand'=>['required'],
            'seller'=>['required'],
            'options'=>['required'],
            'body'=>['required'],
        ]);

        Product::create([
            'category_id'=>$request->category_id,
            'user_id'=>auth()->user()->id,
            'title_fa'=>$request->title_fa,
            'title_en'=>$request->title_en,
            'slug'=>$this->slug($request->title_fa),
            'name'=>$request->name,
            'image'=>$request->image->store('products'),
            'price'=>$request->price,
            'gr'=>$request->gr,
            'brand'=>$request->brand,
            'seller'=>$request->seller,
            'options'=>$request->options,
            'body'=>$request->body,
        ]);

        if($request->dis_price){
            $product=new Product();
            $product->dis_price=$request->dis_price;
            $product->dis_percent=$this->calcDiscountPercent($request->price,$request->dis_price);
            $product->save();
        }

        session()->flash('success','محصول شما با موفقيت اضافه گرديد');
        return redirect(route('products.index'));
    }

    public function edit($id){
        $product=Product::findOrFail($id);
        $categories=Category::all();
        return view('admin/products/create')->with([
            'product'=>$product,
            'categories'=>$categories
        ]);
    }

    public function update(Request $request,$id){
        $this->validate($request,[
            'category_id'=>['required'],
            'title_fa'=>['required'],
            'title_en'=>['required'],
            'image'=>['image','mimes:jpg,png,jpeg'],
            'price'=>['required'],
            'gr'=>['required'],
            'brand'=>['required'],
            'seller'=>['required'],
            'options'=>['required'],
            'body'=>['required'],
        ]);

        $product=Product::findOrFail($id);
        $product->update([
            'category_id'=>$request->category_id,
            'user_id'=>auth()->user()->id,
            'title_fa'=>$request->title_fa,
            'title_en'=>$request->title_en,
            'slug'=>$this->slug($request->title_fa),
            'name'=>$request->name,
            'price'=>$request->price,
            'gr'=>$request->gr,
            'brand'=>$request->brand,
            'seller'=>$request->seller,
            'options'=>$request->options,
            'body'=>$request->body,
        ]);

        if($request->dis_price){
            $product->dis_price=$request->dis_price;
            $product->dis_percent=$this->calcDiscountPercent($request->price,$request->dis_price);
            $product->save();
        }

        if($request->hasFile('image')){
            Storage::delete($product->image);
            $product->image=$request->image->store('products');
            $product->save();
        }

        session()->flash('success','محصول شما با موفقيت ويرايش گرديد');
        return redirect(route('products.index'));

    }

    public function destroy($id){
        $product=Product::findOrFail($id);
        Storage::delete($product->image);
        $product->delete();


        session()->flash('success','محصول شما با موفقيت حذف گرديد');
        return redirect(route('products.index'));

    }

    public function slug($title_fa){
        $ex=explode(' ',$title_fa);
        $slug=implode('-',$ex);
        return $slug;
    }

    private function calcDiscountPercent($price,$discountPrice){
        $percent=(1-($discountPrice/$price))*100;
        return $percent;
    }
}
