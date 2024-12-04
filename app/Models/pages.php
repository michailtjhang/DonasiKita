<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pages extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'pages';
    protected $fillable = [
        'name',
        'content',
    ];
}
