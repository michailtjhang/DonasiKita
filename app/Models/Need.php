<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Need extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'needs';
    protected $fillable = [
        'need_id',
        'title',
        'description',
        'target_amount',
        'current_amount',
        'status'
    ];
}
