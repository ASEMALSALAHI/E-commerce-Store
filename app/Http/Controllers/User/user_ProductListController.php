<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProductList;
use Illuminate\Http\Request;

class user_ProductListController extends Controller
{
    public function AllProductList()
    {
        $products = ProductList::all();
        return response()->json([
            'data' => $products,
        ], 200);
    }
    public function getproduct($id)
    {

        $product = ProductList::find($id);


        if (!$product) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json( [$product]);
    }

}
