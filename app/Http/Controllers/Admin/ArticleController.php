<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['author', 'category'])
            ->orderByRaw("
                CASE 
                    WHEN status = 'draft' THEN 0 
                    ELSE 1 
                END
            ")
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.artikel.list', [
            'title' => 'Article Management',
            'articles' => $articles
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

    public function category()
    {
        $category = ArticleCategory::withCount('articles')->get();

        return view('admin.artikel.kategori', [
            'title' => 'Article Category Management',
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
        ]);

        $isPublish = $request->action === 'publish';

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
        }

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

        // ===== LOGIKA GAMBAR DRAFT PER USER =====
        $body = $request->body ?? '';

        preg_match_all('/<img.*?src="(.*?)"/', $body, $matches);
        $usedImages = $matches[1] ?? [];

        $userDraftFolder = 'articles/draft/' . Auth::id();
        $articleFolder = 'articles/' . $article->id;

        // Hapus draft milik user yang tidak dipakai
        $allUserDraftImages = Storage::disk('public')->files($userDraftFolder);
        foreach ($allUserDraftImages as $file) {
            $url = Storage::url($file);
            if (!in_array($url, $usedImages)) {
                Storage::disk('public')->delete($file);
            }
        }

        // Buat folder artikel jika belum ada
        if (!Storage::disk('public')->exists($articleFolder)) {
            Storage::disk('public')->makeDirectory($articleFolder);
        }

        // Pindahkan gambar draft milik user yang dipakai ke folder artikel
        foreach ($usedImages as $url) {
            $path = str_replace('/storage/', '', $url);
            $filename = basename($path);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->move($path, $articleFolder . '/' . $filename);
                // update body
                $body = str_replace($url, Storage::url($articleFolder . '/' . $filename), $body);
            }
        }

        // Update body artikel
        $article->update(['body' => $body]);
        // ========================================

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
        $request->validate(['upload' => 'required|image|mimes:jpg,jpeg,png|max:5120']);

        // Tentukan folder
        // <-- ini harus membaca folder dari request, bukan cuma draft global
        $folder = $request->folder ?? ($articleId ? 'articles/' . $articleId : 'articles/draft');

        $file = $request->file('upload');
        $path = $file->store($folder, 'public');

        $url = Storage::url($path);

        return response()->json([
            'url' => $url
        ]);
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
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $article->id,
            'article_category_id' => 'nullable|exists:article_categories,id',
            'body' => 'nullable',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $isPublish = $request->action === 'publish';

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama jika ada
            if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
                Storage::disk('public')->delete($article->thumbnail);
            }
            $thumbnailPath = $request->file('thumbnail')->store('articles', 'public');
            $article->thumbnail = $thumbnailPath;
        }

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

        // ===== HAPUS GAMBAR YANG DIHAPUS USER =====
        $body = $request->body ?? '';
        preg_match_all('/<img.*?src="(.*?)"/', $body, $matches);
        $usedImages = $matches[1] ?? [];

        $articleFolder = 'articles/' . $article->id;
        $allImages = Storage::disk('public')->files($articleFolder);

        foreach ($allImages as $file) {
            $url = Storage::url($file);
            if (!in_array($url, $usedImages)) {
                Storage::disk('public')->delete($file);
            }
        }

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
                Storage::disk('public')->delete('articles/' . $article->thumbnail);
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
}
