<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TemporaryDonations extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'temporary_donations';
    protected $fillable = [
        'temp_id',
        'user_id',
        'need_id',
        'email',
        'name',
        'amount',
        'description_item',
        'bank',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function need()
    {
        return $this->belongsTo(Need::class, 'need_id');
    }
}
