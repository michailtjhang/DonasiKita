<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thumbnail extends Model
{
    use HasFactory;
    protected $table = 'thumbnails';
    protected $fillable = [
        'blog_id',
        'event_id',
        'need_id',
        'category_id',
        'file_path',
        'type'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function need()
    {
        return $this->belongsTo(Need::class, 'need_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
