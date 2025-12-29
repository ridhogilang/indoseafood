<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\ProductCategory;
use App\Jobs\SendInquiryNotificationJob;

class HomeController extends Controller
{
    public function index()
    {
        $produk = Product::with('processings')
            ->where('is_active', true)
            ->orderBy('name', 'asc')
            ->limit(7)
            ->get();

        $articles = Article::with('category')
            ->where('is_published', true)
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        return view('home.home', [
            "produk" => $produk,
            "articles" => $articles,
            "title"  => "Indonesia Seafood Export Company | Global Fish Supplier",
            "description" => "IndoSeafood is an Indonesian seafood exporter supplying wild-caught fresh and frozen fish, processed under HACCP standards for global markets.",
            "keywords" => "indonesian seafood exporter, fish supplier indonesia, frozen fish export, fresh seafood indonesia, wild caught fish supplier, seafood export company",
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
            "title" => "Seafood Products from Indonesia | Wild-Caught Fish Export",
            'produk'           => $produk,
            'categories'       => $categories,
            'selectedCategory' => $selectedCategory,
            "description" => "Explore IndoSeafood’s range of wild-caught seafood products from Indonesia, including fresh and frozen fish processed under international standards.",
            "keywords" => "indonesian seafood products, fish export indonesia, frozen fish supplier, fresh seafood indonesia, wild caught fish exporter, seafood catalogue indonesia",
        ]);
    }

    public function about()
    {
        return view('home.about', [
            "title" => "About IndoSeafood | Indonesian Seafood Exporter",
            "description" => "Learn about IndoSeafood, an Indonesian seafood exporter supplying wild-caught fish with certified processing, quality control, and export-ready standards.",
            "keywords" => "about indoseafood, indonesian seafood exporter, seafood export company indonesia, HACCP seafood supplier, fish exporter indonesia",
        ]);
    }

    public function workflow()
    {
        return view('home.workflow', [
            "title" => "Seafood Export Workflow | From Catch to Global Shipping",
            "description" => "Discover IndoSeafood’s seafood export workflow, from wild catching and processing to frozen packing and international shipment.",
            "keywords" => "seafood export process, fish processing workflow, seafood supply chain indonesia, frozen fish shipment, seafood export workflow",
        ]);
    }

    public function quote()
    {
        return view('home.qoute', [
            "title" => "Get a Seafood Export Quote | Indonesian Fish Supplier",
            "description" => "Request a seafood export quotation from IndoSeafood for wild-caught fresh and frozen fish supplied to global markets.",
            "keywords" => "seafood export quote, fish supplier quotation, indonesian seafood exporter quote, frozen fish pricing, seafood rfq indonesia",
        ]);
    }

    public function quote_store(Request $request)
    {
        $validated = $request->validate([
            'company_name'        => 'required|string|max:255',
            'email'               => 'required|email|max:255',
            'whatsapp'            => 'nullable|string|max:50',
            'phone'               => 'nullable|string|max:50',
            'fish_name'           => 'required|string|max:255',
            'qty'                 => 'required|integer',
            'port_of_destination' => 'required|string|max:255',
            'note'                => 'nullable|string',
        ]);

        $validated['status'] = 'new';

        $inquiry = Inquiry::create($validated);

        SendInquiryNotificationJob::dispatch($inquiry);

        return redirect()
            ->back()
            ->with('success', 'Your inquiry has been submitted successfully.');
    }

    public function contact()
    {
        return view('home.contact', [
            "title" => "Contact IndoSeafood | Indonesian Seafood Exporter",
            "description" => "Contact IndoSeafood, an Indonesian seafood exporter supplying wild-caught fresh and frozen fish for international buyers.",
            "keywords" => "contact indonesian seafood exporter, seafood supplier indonesia contact, fish export company indonesia, seafood exporter contact",
        ]);
    }

    public function article()
    {
        $articles = Article::with('category')
            ->where('is_published', true)
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(8);

        return view('home.article', [
            'articles' => $articles,
            "title" => "Seafood Export Insights | Indonesian Fish Industry Articles",
            "description" => "Read articles and insights about Indonesian seafood export, fish processing, global markets, and sustainable wild-caught practices.",
            "keywords" => "seafood export articles, indonesian fish industry, seafood processing insights, fish export market, seafood supplier knowledge",
        ]);
    }

    public function article_show($slug)
    {
        // Ambil artikel berdasarkan slug
        $article = Article::with('category')->where('slug', $slug)->firstOrFail();

        // Format tanggal
        $date = optional($article->created_at)->isoFormat('D MMMM YYYY');

        // prev & next (kalau kamu sudah pakai ini sebelumnya)
        $prev = Article::where('id', '<', $article->id)
            ->orderBy('id', 'desc')
            ->first();

        $next = Article::where('id', '>', $article->id)
            ->orderBy('id', 'asc')
            ->first();

        // CATEGORIES + JUMLAH ARTIKEL
        $categories = ArticleCategory::withCount('articles')
            ->orderBy('name', 'asc')
            ->get();

        // RECENT POSTS (kecuali artikel yang sedang dibaca)
        $recentPosts = Article::where('id', '!=', $article->id)
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();

        return view('home.articleshow', [
            "title" => $article->meta_title,
            "article" => $article,
            "date" => $date,
            "prev" => $prev,
            "next" => $next,
            'categories'   => $categories,
            'recentPosts'  => $recentPosts,
            "description" => $article->meta_description,
            "keywords" => $article->meta_keywords,
        ]);
    }

    public function privacy()
    {
        return view('home.privacy', [
            "title" => "Privacy Policy | IndoSeafood",
            "description" => "Privacy Policy for IndoSeafood, an Indonesian seafood exporter.",
            "keywords" => "privacy policy indonesian seafood exporter, seafood export privacy policy, indonesian fish export privacy",
        ]);
    }

    public function terms()
    {
        return view('home.term', [
            "title" => "Terms and Conditions | IndoSeafood",
            "description" => "Terms and Conditions for IndoSeafood, an Indonesian seafood exporter.",
            "keywords" => "terms and conditions indonesian seafood exporter, seafood export terms, indonesian fish export conditions",
        ]);
    }
}
