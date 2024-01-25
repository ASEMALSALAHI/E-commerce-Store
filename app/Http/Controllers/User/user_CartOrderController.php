<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartOrder;
use App\Models\ProductList;

class user_CartOrderController extends Controller
{
    //
    public function addOrder(Request $request)
    {
        $product_id = $request->product_id;
        $productCheck = ProductList::where('id', $product_id)->first();

        $order = new CartOrder();
        $order->product_id = $request->product_id;
        $order->user_id = $request->user_id;
        $order->product_name = $productCheck->title;
        $order->product_code=$productCheck->product_code;
        $order->quantity=$request->quantity;
        $order->unit_price=$request->unit_price;
        $order->total_price=$request->total_price;
        $order->product_image=$request->product_image;
        $order->email=$request->email;
        $order->name = $request->name;
        $order->payment_method = $request->payment_method;
        $order->delivery_address = $request->delivery_address;
        $order->city = $request->city;
        $order->order_status='Pending';
        $order->order_date =date('Y-m-d');
        $order->order_time =date('H:i:s');
      
        $order->save();
        return response()->json([
            'status'=> 201,
             'message'=> 'Confrimed Order',
             ]);
    }


    public function viewOrder($id)
    {
        $order = CartOrder::where('user_id', $id)->get();
        return response()->json( [$order]);
    }


}
