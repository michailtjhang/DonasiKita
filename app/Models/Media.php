<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'media';
    protected $fillable = [
        'media_id',
        'blog_id',
        'file_path',
        'type'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }
}
