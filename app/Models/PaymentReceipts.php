<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentReceipts extends Model
{
    use HasFactory;
    protected $table = 'payment_receipts';
    protected $fillable = [
        'donation_id',
        'cloudinary_public_id',
        'cloudinary_url',
        'uploaded_at',
    ];

    public function donation()
    {
        return $this->belongsTo(Donation::class, 'donation_id');
    }
}
