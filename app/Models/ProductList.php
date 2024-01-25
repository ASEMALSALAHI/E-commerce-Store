<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductList extends Model
{
    use HasFactory;
    protected $guarded=[];
    //my
    public function productDetails()
    {
        return $this->hasMany(ProductDetails::class, 'id', 'product_id');
    }
}
