<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi:
     * 1 kategori punya banyak produk
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'product_category_id');
    }
}
