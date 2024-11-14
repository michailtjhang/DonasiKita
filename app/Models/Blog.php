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
        'title',
        'content'
    ];
}
