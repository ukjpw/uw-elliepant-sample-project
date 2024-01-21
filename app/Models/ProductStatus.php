<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;

    public function product_status()
    {
        return $this->belongsTo('App\Models\ProductS', 'product_status_id');
    }

}
