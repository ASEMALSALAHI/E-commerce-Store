<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use App\Models\ProductList;

class user_ReviewController extends Controller
{
    public function addreview (Request $request){
        if(ProductReview::where('product_id', $request->product_id)->where('user_id', $request->user_id)->exists())
                {
                    return response()->json([
                    'status'=> 409,
                     'message'=> 'Already Reviewed',
                     ]);

                }else{
                    $productCheck = ProductList::where('id', $request->product_id)->first();
        $review = new ProductReview();
         $review->user_id = $request->user_id;
         $review->product_id = $request->product_id;
         $review->product_name = $productCheck->title;
         $review->reviewer_rating = $request->reviewer_rating;
         $review->reviewer_comments = $request->reviewer_comments;
         $review->reviewer_name = $request->name;


         $review->save();
         return response()->json(['status'=> 201, 'message'=> 'Your message has been sent',]);


                }





    }
    public function chekreview (Request $request){
        if(ProductReview::where('product_id', $request->product_id)->where('user_id', $request->user_id)->exists())
                {
                    return response()->json([
                        'status'=> 200,

                         ]);
                }else{
                    return response()->json([
                        'status'=> 201,

                         ]);


                }
 
    }
    //
}
