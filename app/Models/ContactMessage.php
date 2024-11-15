<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory, HasUlids;
    protected $keyType = 'string';
    protected $table = 'contact_messages';
    protected $fillable = [
        'message_id',
        'user_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
