<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NeedDonation extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'need_donations';
    protected $fillable = [
        'need_donation_id',
        'donation_id',
        'need_id'
    ];

    public function need()
    {
        return $this->belongsTo(Need::class, 'need_id');
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }
}
