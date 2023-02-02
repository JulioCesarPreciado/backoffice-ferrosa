<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Utils\Save;

class ProductDiscount extends Model
{
    use HasFactory;
    use Save;
    protected $table = "product_discounts";
    protected $guarded =[];

    public function producto(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
