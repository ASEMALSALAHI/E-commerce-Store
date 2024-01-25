<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
    protected $guarded=[];

    ///my
    public function productList()
    {
        return $this->belongsTo(ProductList::class, 'product_id', 'id');
    }
}
