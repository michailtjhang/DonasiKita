<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'events';

    protected $fillable = [
        'event_id',
        'category_id',
        'title',
        'slug',
        'description',
        'organizer',
        'user_id',
        'status'
    ];

    public function thumbnail()
    {
        return $this->hasOne(Thumbnail::class, 'event_id', 'event_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function location()
    {
        return $this->hasOne(Locations::class, 'event_id', 'event_id');
    }

    public function detailEvent()
    {
        return $this->hasOne(DetailEvent::class, 'event_id', 'event_id');
    }

    public function eventRegistration() 
    {
        return $this->hasMany(EventRegistration::class, 'event_id', 'event_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn ($query, $keyword) =>
            $query->where('title', 'like', '%' . $keyword . '%')
        );

        $query->when(
            $filters['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category))
        );
    }
}
