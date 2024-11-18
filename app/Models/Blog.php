<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'blogs';
    protected $fillable = [
        'blog_id',
        'category_id',
        'title',
        'slug',
        'views',
        'status',
        'content'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function thumbnail()
    {
        return $this->hasOne(Thumbnail::class, 'blog_id', 'blog_id');
    }
}
