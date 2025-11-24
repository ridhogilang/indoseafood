<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Product::with('processings')
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->limit(7)
            ->get();

        return view('home.home', [
            "title"  => "Home",
            "produk" => $produk,
        ]);
    }

    public function produk(Request $request)
    {
        // ambil semua kategori buat dropdown
        $categories = ProductCategory::orderBy('name')->get();

        // kategori yang dipilih di query string ?category=demersal
        $selectedCategory = $request->get('category');

        $query = Product::with('processings')
            ->where('is_active', true);

        // filter berdasarkan kategori (pakai slug)
        if ($selectedCategory) {
            $query->whereHas('category', function ($q) use ($selectedCategory) {
                $q->where('slug', $selectedCategory);
            });
        }

        // pagination 8 item per halaman
        $produk = $query->orderBy('name', 'asc')
            ->paginate(8)
            ->withQueryString(); // biar ?category=... tetap ikut saat pindah halaman

        return view('home.product', [
            'title'            => 'Products',
            'produk'           => $produk,
            'categories'       => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }

    public function about()
    {
        return view('home.about', [
            "title"  => "About Us",
        ]);
    }

    public function workflow()
    {
        return view('home.workflow', [
            "title"  => "Workflow",
        ]);
    }

    public function quote()
    {
        return view('home.qoute', [
            "title"  => "Qoute",
        ]);
    }

    public function quote_store(Request $request)
    {
        $validated = $request->validate([
            'company_name'        => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'whatsapp'            => 'required|string|max:50',
            'phone'               => 'nullable|string|max:50',
            'fish_name'           => 'required|string|max:255',
            'latin_name'          => 'nullable|string|max:255',
            'freezing_method'     => 'nullable|string|max:255',
            'size'                => 'required|string|max:255',
            'qty'                 => 'required|integer',
            'port_of_destination' => 'required|string|max:255',
            'note'                => 'nullable|string',
        ]);

        Inquiry::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Your inquiry has been submitted successfully.');
    }

    public function contact()
    {
        return view('home.contact', [
            "title"  => "Contact Us",
        ]);
    }
}
