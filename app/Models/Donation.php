<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donation extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'donations';
    protected $fillable = [
        'donation_id',
        'user_id',
        'need_id',
        'email',
        'name',
        'amount',
        'payment_method',
        'status'
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
