<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlider;


class user_SliderController extends Controller
{
    public function AllHomeSlider()
    {
        $products = HomeSlider::all();
        return response()->json([
            'data' => $products,
        ], 200);
    }

    //
}
