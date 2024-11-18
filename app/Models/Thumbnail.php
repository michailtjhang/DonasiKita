<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Concerns\HasUlids;
=======
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thumbnail extends Model
{
<<<<<<< HEAD
    use HasFactory, HasUlids;

    protected $keyType = 'string';
=======
    use HasFactory;
>>>>>>> aa2915288201a3f410ab797e4264ee177c5d6d51
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
