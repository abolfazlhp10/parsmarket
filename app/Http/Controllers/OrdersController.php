<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index(){
        $orders=Order::all();
        return view('admin/orders/index')->with('orders',$orders);
    }

    public function destroy($id){
        $order=Order::findOrFail($id);
        $order->delete();

        session()->flash('success','سفارش مورد نظر حذف شد');
        return redirect(route('orders.index'));
    }
}
