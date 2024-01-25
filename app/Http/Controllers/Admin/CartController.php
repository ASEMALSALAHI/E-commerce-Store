<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addtocart (Request $request){

        // if(auth('sanctum')->check())
        // {
        //      $user_id = $request->user_id;
        //      $product_id = $request->product_id;
        //      $product_qty = $request->product_qty;

        //      $productCheck = ProductList::where('id', $product_id)->first();

        //      if($productCheck)
        //      {
        //         if(Cart::where('product_id', $product_id)->where('$user_id', 'user_id')->exists())
        //         {
        //             return response()->json([
        //                 'status'=> 409,
        //                  'message'=>$productCheck->name. 'Already in cart',
        //                  ]);
        //         }
        //         else
        //         {
        //             $cartitem = new Cart();
        //             $cartitem->user_id = $user_id;
        //             $cartitem->product_id = $product_id;
        //             $cartitem->product_qty = $product_qty;
        //             $cartitem->save();
        //             return response()->json([
        //                 'status'=> 201,
        //                  'message'=> 'Added to cart',
        //                  ]);
        //         }
        //      }
        //      else
        //      {
        //         return response()->json([
        //             'status'=> 404,
        //              'message'=> 'Product not found',
        //              ]);
        //      }

        // }
        // else
        // {
        //     return response()->json([
        //         'status'=> 401,
        //          'message'=> 'Login to add to cart',
        //     ]);
        //     }

             $user_id = $request->user_id;
             $product_id = $request->product_id;
             $product_qty = $request->product_qty;

             $productCheck = ProductList::where('id', $product_id)->first();


             if($productCheck)
             {
                if(Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists())
                {
                    return response()->json([
                        'status'=> 409,
                         'message'=>$productCheck->name. 'Already in cart',
                         ]);
                }
                else
                {
                    $cartitem = new Cart();
                    $cartitem->user_id = $user_id;
                    $cartitem->product_id = $product_id;
                    $cartitem->product_qty = $product_qty;
                    $cartitem->save();
                    return response()->json([
                        'status'=> 201,
                         'message'=> 'Added to cart',
                         ]);
                }
             }
             else
             {
                return response()->json([
                    'status'=> 404,
                     'message'=> 'Product not found',
                     ]);
             }





    }


    public function removeFromCart($id)
{


    // حذف جميع العناصر المرتبطة بـ user_id
    Cart::where('user_id', $id)->delete();

    return response()->json([
        'status' => 200,
        'message' => 'All items removed from cart for the user',
    ]);
}



    public function viewcart($id)
    {
        //$product = Cart::find($id);
        //$user_id = $request->user_id;
      //  $cartitems = Cart::where('user_id',$id)->get();
     // $cartitems = Cart::where('user_id', $id)->get();//*

// foreach ($cartitems as $cartitem) {//*
//     $product_id = $cartitem->product_id;//*
//}//*

    // الآن يمكنك استخدام $product_id لإجراء استعلام آخر إذا كان ذلك ضرورياً  $product = ProductList::where('id', $product_id)->first();// *
    // $response = [
    //     'cartItem' => $cartitems,
    //     'productInfo' => $product,
    // ];
    // return response()->json($response);

  //return response()->json( [$product]);//*

       // return response(['user'=>auth('api_user')->user(),'access_token'=>$accessToken]);


        // return response()->json([
        //     'status'=> 200,
        //      'message'=> 'Cart items',
        //      'data'=> $cartitems,
        //      ]);
        // if(auth('sanctum')->check())
        // {
        //     $user_id = auth('sanctum')->user()->id;
        //     $cartitems = Cart::where('user_id', $user_id)->get();
        //     return response()->json([
        //         'status'=> 200,
        //          'message'=> 'Cart items',
        //          'data'=> $cartitems,
        //          ]);
        // }
        // else
        // {
        //     return response()->json([
        //         'status'=> 401,
        //          'message'=> 'Login to view cart Data',
        //     ]);
        //     }
        $cartitems = Cart::where('user_id', $id)->get();
    $productList = [];

    foreach ($cartitems as $cartitem) {
        $product_id = $cartitem->product_id;
        $product = ProductList::where('id', $product_id)->first();

        // تأكد من أن المنتج موجود قبل إضافته إلى المصفوفة
        if ($product) {
            $productList[] = $product;
        }
    }

    return response()->json($productList);
    }


    public function updatequantity( $cart_id, $scope)
    {
        if(auth('sanctum')->check())
        {
            $user_id = auth('sanctum')->user()->id;
            $cartitem = Cart::where('id', $cart_id)->where('user_id', $user_id)->first();


                if($scope == 'inc'){
                    $cartitem->product_qty += 1 ;
                }elseif($scope == 'dec'){
                    $cartitem->product_qty -= 1 ;
                }
                    $cartitem->update();
                    return response()->json([
                        'status'=> 200,
                         'message'=> 'Cart updated',

                         ]);
                }
                else
                {
                    return response()->json([
                        'status'=> 401,
                         'message'=> 'Login to continue',
                         ]);
                }

    }
}


