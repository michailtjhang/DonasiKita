<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, HasUlids;

    // set key type
    protected $keyType = 'string';
    // set table
    protected $table = 'blogs';
    // set fillable
    protected $fillable = [
        'blog_id',
        'category_id',
        'user_id',
        'title',
        'slug',
        'views',
        'status',
        'content'
    ];

    // set relation to category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // set relation to thumbnail
    public function thumbnail()
    {
        return $this->hasOne(Thumbnail::class, 'blog_id', 'blog_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn ($query, $keyword) =>
            $query->where('title', 'like', '%' . $keyword . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category))
        );
    }
}
