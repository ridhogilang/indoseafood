<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'thumbnail',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    // Relasi: setiap artikel punya 1 kategori
    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    // Slug otomatis dari title
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if (!isset($this->attributes['slug']) || empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    // Excerpt otomatis jika belum diisi
    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = $value;

        if (!isset($this->attributes['excerpt']) || empty($this->attributes['excerpt'])) {
            $this->attributes['excerpt'] = Str::limit(strip_tags($value), 160);
        }
    }
}
