<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $fillable = [
        'user_id',
        'cloudinary_public_id',
        'cloudinary_url',
        'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
