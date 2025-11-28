<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
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

        $articles = Article::with('category')
            ->orderBy('created_at', 'desc')
            ->take(7)
            ->get();

        return view('home.home', [
            "title"  => "Home",
            "produk" => $produk,
            "articles" => $articles,
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

    public function article()
    {
        $articles = Article::with('category')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(8); // 8 artikel per halaman

        return view('home.article', [
            "title"  => "Article",
            'articles' => $articles,

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
            "title" => $article->title,
            "article" => $article,
            "date" => $date,
            "prev" => $prev,
            "next" => $next,
            'categories'   => $categories,
            'recentPosts'  => $recentPosts,
        ]);
    }
}
