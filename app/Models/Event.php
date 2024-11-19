<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'events';

    protected $fillable = [
        'event_id',
        'title',
        'description',
        'date',
        'location',
        'capacity',
        'status'
    ];

    public function thumbnails()
    {
        return $this->hasMany(Thumbnail::class, 'event_id');
    }
}
