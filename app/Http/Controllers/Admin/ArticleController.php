<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['author', 'category']);

        // cek apakah user sudah menyentuh filter status
        $hasStatusFilter =
            $request->has('draft_articles') ||
            $request->has('published_articles') ||
            $request->has('archived_articles');

        if ($hasStatusFilter) {
            $status = [];

            if ($request->has('draft_articles')) {
                $status[] = 'draft';
            }

            if ($request->has('published_articles')) {
                $status[] = 'published';
            }

            if ($request->has('archived_articles')) {
                $status[] = 'archived';
            }

            // jika ada status dipilih
            if (!empty($status)) {
                $query->whereIn('status', $status);
            } else {
                // semua status di-uncheck → kosongkan hasil
                $query->whereRaw('1 = 0');
            }
        }

        if ($request->filled('category')) {
            $query->where('article_category_id', $request->category);
        }

        $articles = $query
            ->orderByRaw("
            CASE 
                WHEN status = 'draft' THEN 0
                ELSE 1
            END
        ")
            ->orderBy('updated_at', 'desc')
            ->get();

        $categories = ArticleCategory::orderBy('name')->get();

        return view('admin.artikel.list', [
            'title'      => 'Article Management',
            'articles'   => $articles,
            'categories' => $categories,
            'filters'    => $request->all(),
        ]);
    }

    public function new()
    {
        $category = ArticleCategory::all();

        return view('admin.artikel.new', [
            'title' => 'Create New Article',
            'category' => $category
        ]);
    }

    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $category = ArticleCategory::all();

        return view('admin.artikel.edit', [
            'title' => 'Edit Article',
            'article' => $article,
            'category' => $category
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug',
            'article_category_id' => 'nullable|exists:article_categories,id',
            'body' => 'nullable',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ], [
            'thumbnail.image' => 'The thumbnail must be an image file.',
            'thumbnail.mimes' => 'The thumbnail must be a file of type: JPG, JPEG, or PNG.',
            'thumbnail.max'   => 'The thumbnail size may not be greater than 5 MB.',
        ]);

        $isPublish = $request->action === 'publish';

        // ===============================
        // THUMBNAIL (TIDAK DIUBAH)
        // ===============================
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

        // ===============================
        // CREATE ARTICLE (DAPAT ID)
        // ===============================
        $article = Article::create([
            'user_id' => Auth::id(),
            'article_category_id' => $request->article_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'excerpt' => Str::limit(strip_tags($request->body), 160),
            'body' => $request->body,
            'thumbnail' => $thumbnailPath,
            'status' => $isPublish ? 'published' : 'draft',
            'is_published' => $isPublish,
            'published_at' => $isPublish ? now() : null,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        // ==================================================
        // 🔥 LOGIKA GAMBAR DRAFT → ARTIKEL (FIXED)
        // ==================================================
        $body = $request->body ?? '';

        // 1️⃣ Ambil semua SRC gambar dari body
        preg_match_all('/<img[^>]+src="([^">]+)"/i', $body, $matches);
        $usedImages = $matches[1] ?? [];

        // 2️⃣ Ambil filename yang dipakai (BUKAN URL)
        $usedFilenames = collect($usedImages)
            ->map(function ($url) {
                return basename(parse_url($url, PHP_URL_PATH));
            })
            ->filter()
            ->toArray();

        $userDraftFolder = 'articles/draft/' . Auth::id();
        $articleFolder   = 'articles/' . $article->id;

        // Pastikan folder artikel ada
        Storage::disk('public')->makeDirectory($articleFolder);

        // 3️⃣ PINDAHKAN gambar draft yang dipakai ke folder artikel
        foreach ($usedImages as $url) {
            $path = ltrim(parse_url($url, PHP_URL_PATH), '/'); // storage/articles/draft/1/a.png
            $path = str_replace('storage/', '', $path);        // articles/draft/1/a.png

            // Pastikan hanya proses file draft user
            if (!str_starts_with($path, $userDraftFolder)) {
                continue;
            }

            $filename = basename($path);
            $newPath  = $articleFolder . '/' . $filename;

            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->move($path, $newPath);

                // Update URL di body
                $body = str_replace(
                    $url,
                    Storage::url($newPath),
                    $body
                );
            }
        }

        // 4️⃣ UPDATE BODY SETELAH PINDAH
        $article->update(['body' => $body]);

        // 5️⃣ HAPUS SISA GAMBAR DRAFT YANG TIDAK DIPAKAI
        if (Storage::disk('public')->exists($userDraftFolder)) {
            $allDraftImages = Storage::disk('public')->files($userDraftFolder);

            foreach ($allDraftImages as $file) {
                $filename = basename($file);

                if (!in_array($filename, $usedFilenames)) {
                    Storage::disk('public')->delete($file);
                }
            }
        }
        if ($request->auto_draft == 1) {
            return response()->json([
                'success' => true,
                'redirect' => route('article.edit', ['slug' => $article->slug]),
            ]);
        }

        return redirect()
            ->route(
                $isPublish ? 'article.list' : 'article.edit',
                $isPublish ? [] : ['slug' => $article->slug]
            )
            ->with(
                'success',
                $isPublish
                    ? 'Article successfully published.'
                    : 'Article saved as draft.'
            );
    }

    public function uploadImage(Request $request, $articleId = null)
    {
        $request->validate(
            ['upload' => 'required|image|mimes:jpg,jpeg,png|max:5120'],
            [
                'upload.image' => 'File harus berupa gambar.',
                'upload.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
                'upload.max' => 'Ukuran gambar maksimal 5 MB.',
            ]
        );
        $folder = $request->folder ?? ($articleId ? 'articles/' . $articleId : 'articles/draft');
        $file = $request->file('upload');
        $path = $file->store($folder, 'public');
        $url = Storage::url($path);
        return response()->json(['url' => $url]);
    }

    public function deleteImage(Request $request)
    {
        $request->validate([
            'image_path' => 'required|string',
            'folder' => 'nullable|string'
        ]);

        $path = str_replace('/storage/', '', $request->image_path);

        // Jika folder dikirim, pastikan hapus dari folder itu
        if ($request->folder) {
            $path = ltrim($path, '/'); // hapus slash depan kalau ada
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return response()->json(['success' => true]);
    }

    public function update(Request $request, Article $article)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:articles,slug,' . $article->id,
                'article_category_id' => 'nullable|exists:article_categories,id',
                'body' => 'nullable',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string|max:255',
                'meta_keywords' => 'nullable|string|max:255',
                'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ],
            [
                'thumbnail.image' => 'The thumbnail must be an image file.',
                'thumbnail.mimes' => 'The thumbnail must be a file of type: JPG, JPEG, or PNG.',
                'thumbnail.max'   => 'The thumbnail size may not be greater than 5 MB.',
            ]
        );

        $isPublish = $request->action === 'publish';

        // ===============================
        // THUMBNAIL (TIDAK DIUBAH)
        // ===============================
        if ($request->hasFile('thumbnail')) {
            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
            $article->thumbnail = $thumbnailPath;
        }

        // ===============================
        // UPDATE DATA ARTIKEL (TIDAK DIUBAH)
        // ===============================
        $article->update([
            'article_category_id' => $request->article_category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->slug),
            'excerpt' => Str::limit(strip_tags($request->body), 160),
            'body' => $request->body,
            'status' => $isPublish ? 'published' : 'draft',
            'is_published' => $isPublish,
            'published_at' => $isPublish ? now() : null,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        // ==========================================================
        // 🔥 FIX UTAMA: HAPUS GAMBAR YANG TIDAK DIPAKAI (VERSI AMAN)
        // ==========================================================
        $body = $request->body ?? '';

        // Ambil semua src gambar dari body
        preg_match_all('/<img.*?src="(.*?)"/', $body, $matches);
        $usedImages = $matches[1] ?? [];

        // 🔑 Ambil NAMA FILE yang dipakai (BUKAN URL)
        $usedFilenames = collect($usedImages)
            ->map(function ($url) {
                return basename(parse_url($url, PHP_URL_PATH));
            })
            ->filter()
            ->toArray();

        $articleFolder = 'articles/' . $article->id;
        $allImages = Storage::disk('public')->files($articleFolder);

        foreach ($allImages as $file) {
            $filename = basename($file);

            // ❗ HAPUS hanya jika BENAR-BENAR tidak dipakai di body
            if (!in_array($filename, $usedFilenames)) {
                Storage::disk('public')->delete($file);
            }
        }
        // ===================== END FIX ============================

        // ===============================
        // RESPONSE (TIDAK DIUBAH)
        // ===============================
        if ($request->auto_draft == 1 || $request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => route('article.edit', ['slug' => $article->slug]),
            ]);
        }

        return redirect()
            ->route(
                $isPublish ? 'article.list' : 'article.edit',
                $isPublish ? [] : ['slug' => $article->slug]
            )
            ->with(
                'success',
                $isPublish
                    ? 'Article successfully published.'
                    : 'Article saved as draft.'
            );
    }

    public function destroy(Article $article)
    {
        try {

            // 🔥 HAPUS THUMBNAIL (FILE)
            if ($article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            // 🔥 HAPUS SEMUA GAMBAR DALAM BODY (1 FOLDER ID)
            Storage::disk('public')->deleteDirectory('articles/' . $article->id);

            // 🔥 HAPUS DATA ARTIKEL
            $article->delete();

            return response()->json([
                'success' => true,
                'message' => 'Article, thumbnail, and body images deleted successfully.'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete article.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function category()
    {
        $category = ArticleCategory::withCount('articles')->get();

        return view('admin.artikel.kategori', [
            'title' => 'Article Category Management',
            'category' => $category
        ]);
    }

    public function category_destroy(ArticleCategory $category)
    {
        // 🔥 Cek apakah kategori masih dipakai artikel
        if ($category->articles()->count() > 0) {
            return response()->json([
                'success' => false,
                'message' => 'This category is still used by articles and cannot be deleted.'
            ], 422);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully.'
        ]);
    }

    public function store_category(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:article_categories,slug',
            'description' => 'nullable|string',
        ]);

        $category = ArticleCategory::create([
            'name'        => $request->name,
            'slug'        => Str::slug($request->slug),
            'description' => $request->description,
        ]);

        // untuk ajax (modal add category)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully',
                'data'    => $category
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Category created successfully');
    }

    public function category_update(Request $request, ArticleCategory $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => [
                'required',
                'string',
                'max:255',
                Rule::unique('article_categories', 'slug')->ignore($category->id),
            ],
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name'        => $request->name,
            'slug'        => Str::slug($request->slug),
            'description' => $request->description,
        ]);

        // response AJAX (modal edit)
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully',
                'data'    => $category
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Category updated successfully');
    }
}
