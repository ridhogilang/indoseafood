<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil kategori by name
        $demersal = ProductCategory::where('name', 'Demersal')->first();
        $pelagic  = ProductCategory::where('name', 'Pelagic')->first();
        $cephalo  = ProductCategory::where('name', 'Cephalophodae')->first();
        $arthro   = ProductCategory::where('name', 'Arthopodae')->first();

        $products = [
            ['Barramundi (Wild Caught)', 'Lates calcarifer', $demersal, 'products/Barramundi.png'],
            ['Red Spot Emperor', 'Lethrinus lentjan', $demersal, 'products/Red Spot Emperor.png'],
            ['Goldband Snapper', 'Pristipomoides multidens', $demersal, 'products/Goldband Snapper.png'],
            ['White Snapper (sea bream)', 'Gymnocranius griseus', $demersal, 'products/White Snapper.png'],
            ['Indian Mackerel', 'Rastrelliger kanagurta', $pelagic, 'products/Indian Mackerel.png'],
            ['Basa (Patin)', 'Pangasius bocourti', $demersal, 'products/Basa.png'],

            ['Coral Trout (Sunuk)', 'Plectropomus leopardus', $demersal, 'products/Coral Trout.png'],
            ['Red Snapper', 'Lutjanus campechanus or Lutjanus bohar', $demersal, 'products/Red Snapper.png'],
            ['Ruby Snapper', 'Etelis carbunculus', $demersal, 'products/Ruby Snapper.png'],
            ['Swordfish', 'Xiphias gladius', $pelagic, 'products/Swordfish.png'],
            ['Red Mullet', 'Mullus barbatus', $demersal, 'products/Red Mullet.png'],
            ['MilkFish', 'Chanos chanos', $demersal, 'products/MilkFish.png'],

            ['Ribbonfish', 'Trichiurus lepturus', $pelagic, 'products/Ribbonfish.png'],
            ['Spanish Mackerel', 'Scomberomorus commerson', $pelagic, 'products/Spanish Mackerel.png'],
            ['Japanese Mackerel', 'Scomber japonicus', $pelagic, 'products/Japanese Mackerel.png'],

            ['Yellowfin Tuna', 'Thunnus albacares', $pelagic, 'products/Yellowfin Tuna.png'],
            ['Big Eye Tuna', 'Thunnus obesus', $pelagic, 'products/Big Eye Tuna.png'],
            ['Skipjack Tuna', 'Katsuwonus pelamis', $pelagic, 'products/Skipjack Tuna.png'],
            ['Baby Tuna', 'Euthynnus affinis', $pelagic, 'products/Baby Tuna.png'],
            ['Rainbow Runner (Sunglir)', 'Elagatis bipinnulata', $pelagic, 'products/Rainbow Runner.png'],

            ['Gold Snapper (Angkui)', 'Johnius carouna', $demersal, 'products/Gold Snapper.png'],
            ['Black Pomfret', 'Parastromateus niger', $demersal, 'products/Black Pomfret.png'],
            ['Flounder (Side Eye) Fish', 'Paralichthys lethostigma', $demersal, 'products/Flounder Fish.png'],
            ['Leatherjacket Fish', 'Aluterus monoceros', $demersal, 'products/Leatherjacket Fish.png'],
        ];

        foreach ($products as [$name, $latin, $category, $image]) {
            Product::firstOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'product_category_id' => $category?->id,
                    'name'                => $name,
                    'latin_name'          => $latin,
                    'description'         => null,
                    'image'               => $image,
                    'is_active'           => true,
                ]
            );
        }
    }
}
