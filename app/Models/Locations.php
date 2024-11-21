<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Locations extends Model
{
    use HasFactory;
    protected $table = 'locations';
    protected $fillable = [
        'event_id',
        'name_location',
        'latitude',
        'longitude',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
