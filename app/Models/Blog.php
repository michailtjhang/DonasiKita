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
<<<<<<< HEAD
=======
        'slug',
        'views',
        'status',
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
        'content'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
<<<<<<< HEAD
=======

    public function thumbnail()
    {
        return $this->hasOne(Thumbnail::class, 'blog_id', 'blog_id');
    }
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
}
