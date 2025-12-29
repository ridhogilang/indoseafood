<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Product Management';
        $product = Product::with('category')->get();
        $categories = ProductCategory::all();

        return view('admin.product.list', [
            'title' => $title,
            'products' => $product,
            'categories' => $categories
        ]);
    }

    public function category()
    {
        $title = 'Product Category Management';
        $category = ProductCategory::withCount('products')->get();

        return view('admin.product.category', [
            'title' => $title,
            'categories' => $category
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'product_category_id' => 'nullable|exists:product_categories,id',
                'name'        => 'required|string|max:255',
                'latin_name'  => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ],
            [
                'image.image' => 'The file must be an image.',
                'image.mimes' => 'Image format must be JPG, JPEG, or PNG.',
                'image.max'   => 'Maximum image size is 5 MB.',
            ]
        );

        // SLUG dari name
        $slug = Str::slug($request->name);

        // pastikan slug unik
        $originalSlug = $slug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        // upload image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')
                ->store('products', 'public');
        }

        Product::create([
            'product_category_id' => $request->product_category_id,
            'name'        => $request->name,
            'latin_name'  => $request->latin_name,
            'slug'        => $slug,
            'description' => $request->description,
            'image'       => $imagePath,
            'is_active'   => true,
        ]);

        return redirect()
            ->route('product.list')
            ->with('success', 'Product added successfully');
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'latin_name' => 'required|string',
            'description' => 'nullable|string',
            'product_category_id' => 'required|exists:product_categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120'
        ], [
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Image format must be JPG, JPEG, or PNG.',
            'image.max'   => 'Maximum image size is 5 MB.',
        ]);

        // 🔥 Update slug HANYA jika name berubah
        if ($data['name'] !== $product->name) {
            $data['slug'] = Str::slug($data['name']);

            // opsional: jaga slug tetap unik
            $originalSlug = $data['slug'];
            $count = 1;
            while (
                Product::where('slug', $data['slug'])
                ->where('id', '!=', $product->id)
                ->exists()
            ) {
                $data['slug'] = $originalSlug . '-' . $count++;
            }
        }

        // 🔥 Handle image
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return back()->with('success', 'Product has been successfully updated');
    }

    public function toggleActive(Request $request, Product $product)
    {
        $request->validate([
            'is_active' => 'required|boolean'
        ]);

        $product->update([
            'is_active' => $request->is_active
        ]);

        return response()->json([
            'success' => true,
            'message' => $request->is_active
                ? 'Product successfully activated'
                : 'Product successfully deactivated'
        ]);
    }

    public function changeCategory(Request $request, Product $product)
    {
        $request->validate([
            'product_category_id' => 'required|exists:product_categories,id'
        ]);

        $product->update([
            'product_category_id' => $request->product_category_id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product category successfully changed'
        ]);
    }

    public function destroy(Product $product)
    {
        try {

            // HAPUS FILE GAMBAR JIKA ADA
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // HAPUS DATA PRODUK
            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product successfully deleted'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the product'
            ], 500);
        }
    }

    public function storeCategory(Request $request)
    {
        // VALIDASI
        $request->validate([
            'name' => 'required|string|max:255|unique:product_categories,name'
        ]);

        // GENERATE SLUG DARI NAME
        $slug = Str::slug($request->name);

        // ANTISIPASI SLUG DUPLIKAT
        $originalSlug = $slug;
        $counter = 1;

        while (ProductCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // SIMPAN KE DB
        ProductCategory::create([
            'name' => $request->name,
            'slug' => $slug
        ]);

        return back()->with('success', 'Product category added successfully');
    }

    public function updateCategory(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $productCategory->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Product category updated successfully.');
    }

    public function destroyCategory(ProductCategory $productCategory)
    {
        // cek apakah category masih dipakai product
        if ($productCategory->products()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'This category cannot be deleted because it is still used by products.'
            ], 422);
        }

        $productCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product category deleted successfully.'
        ]);
    }
}
