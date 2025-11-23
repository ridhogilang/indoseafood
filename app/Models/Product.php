<?php

namespace App\Models;

use App\Models\ProductProcessing;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_category_id',
        'name',
        'latin_name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }

    public function processings()
    {
        // 1 produk punya banyak processing
        return $this->hasMany(ProductProcessing::class);
    }
}
