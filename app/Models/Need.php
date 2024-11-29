<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Need extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $casts = [
        'days_left' => 'date',
    ];
    protected $table = 'needs';
    protected $fillable = [
        'need_id',
        'title',
        'slug',
        'towards',
        'description',
        'description_need',
        'target_amount',
        'current_amount',
        'status',
        'days_left',
    ];

    public function donation()
    {
        return $this->hasMany(Donation::class, 'need_id');
    }

    public function thumbnail()
    {
        return $this->hasOne(Thumbnail::class, 'need_id', 'need_id');
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when(
            $filters['keyword'] ?? false,
            fn ($query, $keyword) =>
            $query->where('title', 'like', '%' . $keyword . '%')
        );
    }
}
