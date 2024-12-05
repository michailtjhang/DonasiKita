<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $fillable = [
        'cloudinary_public_id',
        'cloudinary_url',
        'type'
    ];
}
