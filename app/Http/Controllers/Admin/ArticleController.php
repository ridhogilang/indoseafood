<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.artikel.list', [
            'title' => 'Article Management',
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

            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $isPublish = $request->action === 'publish';

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->store('articles', 'public');
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

        if ($request->auto_draft == 1) {
            return response()->json([
                'success' => true,
                'redirect' => route('article.edit', ['slug' => $article->slug]),
            ]);
        }

        return redirect()
            ->route(
                $isPublish ? 'article.index' : 'article.edit',
                $isPublish ? [] : ['slug' => $article->slug]
            )
            ->with(
                'success',
                $isPublish
                    ? 'Article successfully published.'
                    : 'Article saved as draft.'
            );
    }
}
