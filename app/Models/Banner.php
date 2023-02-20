<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Utils\Save;

class Banner extends Model
{
    use HasFactory;
    use Save;
    protected $guarded = [];

    public function producto(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
