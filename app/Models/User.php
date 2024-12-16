<?php

namespace App\Models;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomEmailVerification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'role_id',
        'name',
        'email',
        'password',
        'provider_id',
        'provider_name',
        'access_token',
        'refresh_token',
    ];

    // Ambil data
    static public function getRecords()
    {
        return User::with('role')->orderBy('updated_at', 'desc')->get();
    }

    // Ambil data berdasarkan id
    static public function getSingleRecord($id)
    {
        return User::with('role')->find($id);
    }

    // Ambil data berdasarkan role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function media()
    {
        return $this->hasOne(Media::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Send the email verification notification.
    public function sendEmailVerificationNotification()
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $this->id, 'hash' => sha1($this->email)]
        );

        Mail::to($this->email)->send(new CustomEmailVerification($verificationUrl));
    }
}
