<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockProduct extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function block()
    {
        return $this->hasOne(ProductBlock::class, 'id', 'product_block_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function relatedProduct()
    {
        return $this->hasOne(Product::class, 'id', 'related_product_id');
    }
}
