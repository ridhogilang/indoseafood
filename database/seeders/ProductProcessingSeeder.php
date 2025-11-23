<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\ProductProcessing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductProcessingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Map nama produk => list processing dari katalog PDF
        $data = [

            'Barramundi (Wild Caught)' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
                'Fillet Skinless',
                'Portion Skin On Boneless',
                'Portion Skinless',
                'Butterfly',
            ],

            'Red Spot Emperor' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
                'Fillet Skinless',
            ],

            'Goldband Snapper' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
            ],

            'White Snapper (Sea Bream)' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
            ],

            'Indian Mackerel' => [
                // Di PDF tertulis "Whole GG" → kita pecah jadi 2
                'Whole',
                'GG',
            ],

            'Basa (Patin)' => [
                'Whole',
                'WGGS',
                'Fillet Skinless',
                'Fillet Premium',
                'Portion Folded',
            ],

            'Coral Trout (Sunuk)' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
            ],

            'Red Snapper' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
                'Fillet Skinless',
            ],

            'Ruby Snapper' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
            ],

            'Swordfish' => [
                'Whole',
                'WGG',
                'Fillet',
                'Steak',
            ],

            'Red Mullet' => [
                'Whole',
                'WGGS',
            ],

            'Milkfish' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
                'Cooked',
            ],

            'Ribbonfish' => [
                'Whole',
                'WGG',
                'Fillet Skin On',
            ],

            'Spanish Mackerel' => [
                'Whole',
                'WGGS',
                'Fillet',
                'Butterfly',
                'Pre-cooked',
            ],

            'Japanese Mackerel' => [
                'Whole',
                'GG', // "Whole GG" → Whole + GG
            ],

            'Yellowfin Tuna' => [
                'WGG',
                'Fillet Skin On',
                'Fillet Skinless',
                'Saku',
                'Steak',
                'Parcel',
                'Loin CO treated or Natural',
            ],

            'Big Eye Tuna' => [
                'WGG',
                'Fillet Skin On',
                'Fillet Skinless',
                'Saku',
                'Steak',
                'Parcel',
                'Loin CO treated or Natural',
            ],

            'Skipjack Tuna' => [
                'Whole',
                'GG',
                'Fillet',
                'Butterfly',
                'Pre-cooked',
            ],

            'Baby Tuna' => [
                'Whole',
                'GG',
                'Fillet',
                'Butterfly',
                'Pre-cooked',
            ],

            'Rainbow Runner (Sunglir)' => [
                'Whole',
                'GG', // "Whole GG"
            ],

            'Gold Snapper (Angkui)' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
                'Fillet Skinless',
            ],

            'Black Pomfret' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
            ],

            'Flounder (Side Eye) Fish' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
            ],

            'Leatherjacket Fish' => [
                'Whole',
                'WGGS',
                'Fillet Skin On',
            ],
        ];

        foreach ($data as $productName => $processings) {
            $product = Product::where('name', $productName)->first();

            if (! $product) {
                // Kalau ada typo / belum ke-seed produknya, skip
                continue;
            }

            foreach ($processings as $name) {
                ProductProcessing::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'name'       => $name,
                    ],
                    [
                        'freezing_method' => null,
                        'size'            => null,
                        'notes'           => null,
                    ]
                );
            }
        }
    }
}
