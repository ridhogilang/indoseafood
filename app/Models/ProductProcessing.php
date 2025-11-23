<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProcessing extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'freezing_method',
        'size',
        'notes',
    ];

    // dropdown list processing berdasarkan katalog PDF
    public const PROCESSING_NAMES = [
        'Whole',
        'GG',
        'WGG',
        'WGGS',
        'Fillet',
        'Fillet Skin On',
        'Fillet Skinless',
        'Fillet Premium',
        'Portion Skin On Boneless',
        'Portion Skinless',
        'Portion Folded',
        'Butterfly',
        'Steak',
        'Cooked',
        'Pre-cooked',
        'Saku',
        'Parcel',
        'Loin CO treated or Natural',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
