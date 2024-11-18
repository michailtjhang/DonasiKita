<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thumbnail extends Model
{
    use HasFactory;
    protected $table = 'thumbnails';
    protected $fillable = [
        'thumbnail_id',
        'blog_id',
        'file_path',
        'type'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
