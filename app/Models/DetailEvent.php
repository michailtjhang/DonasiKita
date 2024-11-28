<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailEvent extends Model
{
    use HasFactory;
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
    
    protected $table = 'detail_events';

    protected $fillable = [
        'event_id',
        'start',
        'end',
        'capacity_participants',
        'description_participants',
        'capacity_volunteers',
        'description_volunteers',
        'requires_volunteers',
    ];
}
