<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    //protected $with = ['product'];



    public function ProductList()
    {
        return $this->belongsTo(ProductList::class, 'product_id', 'id');
    }
}
