<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\ProductDetails;

class user_ProductDetailsController extends Controller
{
    //

    public function productdetails($id)
    {



        $productdetails = productDetails::where('product_id', $id)->get();




        if (!$productdetails) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json( [$productdetails]);
    }

    public function AllProductdetails()
    {
        $productdetails = productDetails::all();
        return response()->json([
            'data' => $productdetails,
        ], 200);
    }

    public function getfulldetails()
    {
       

        $productDetails = ProductDetails::with('productList')->get();

        $mergedData = $productDetails->map(function ($item) {
            return  [
                'idpd' => $item->id,
                'product_id' => $item->product_id,
                'image_one' => $item->image_one,
                'image_two' => $item->image_two,
                'image_three' => $item->image_three,
                'image_four' => $item->image_four,
                'short_description' => $item->short_description,
                'color' => $item->color,
                'size' => $item->size,
                'long_description' => $item->long_description,


                    'idpl' => $item->productList->id,
                    'title' => $item->productList->title,
                    'price' => $item->productList->price,
                    'special_price' => $item->productList->special_price,
                    'image' => $item->productList->image,
                    'category' => $item->productList->category,
                    'subcategory' => $item->productList->subcategory,
                    'remark' => $item->productList->remark,
                    'brand' => $item->productList->brand,
                    'star' => $item->productList->star,
                    'product_code' => $item->productList->product_code,

            ];
        });

        return response()->json(['data' => $mergedData]);


    }




}
