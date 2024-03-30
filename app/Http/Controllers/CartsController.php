<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\pay\zarinpal;
use Illuminate\Http\Request;
use Darryldecode\Cart\Cart;
use SoapClient;

class CartsController extends Controller
{
    public function updateCart(Request $request)
    {
        if ($request->has('increase')) {
            \Cart::update($request->id, array(
                'quantity' => 1,
            ));
        }
        if ($request->has('decrease')) {
            \Cart::update($request->id, array(
                'quantity' => -1,
            ));
        }
        return back();
    }

    public function removeCart($id)
    {
        \Cart::remove($id);
        $product = Product::findOrFail($id);
        $product->users()->detach();
        return back();
    }

    public function removeAllCarts()
    {
        \Cart::clear();
        $user = User::where('id', auth()->user()->id)->first();
        $user->products()->detach();
        return back();
    }

    public function request()
    {
        $MerchantID     = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount         = session()->get('totalPrice');
        $Description     = "تراکنش زرین پال";
        $Email             = "";
        $Mobile         = "";
        $CallbackURL     = url('verify');
        $ZarinGate         = false;
        $SandBox         = true;

        $zp     = new zarinpal();
        $result = $zp->request($MerchantID, $Amount, $Description, $Email, $Mobile, $CallbackURL, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            // Success and redirect to pay
            $zp->redirect($result["StartPay"]);
        } else {
            // error
            echo "خطا در ایجاد تراکنش";
        }
    }

    public function verify()
    {

        $MerchantID     = "xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx";
        $Amount         = session()->get('totalPrice');
        $ZarinGate         = false;
        $SandBox         = true;

        $zp     = new zarinpal();
        $result = $zp->verify($MerchantID, $Amount, $SandBox, $ZarinGate);

        if (isset($result["Status"]) && $result["Status"] == 100) {
            session()->flash('success','پرداخت با موفقيت انجام شد');
            foreach(\Cart::getcontent() as $item){
                Order::create([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$item->id,
                    'price'=>$item->price,
                    'dis_price'=>$item->attributes->dis_price,
                    'quantity'=>$item->quantity
                ]);

            }
            $this->removeAllCarts();
            return redirect(route('cart'));
        } else {
            // error
            echo "پرداخت ناموفق";
        }
    }
}
