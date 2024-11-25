<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasUlids;

    protected $keyType = 'string';
    protected $table = 'role';

    protected $fillable = [
        'name',
    ];

    // Relationship with User
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Relationship with Permission
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    // Ambil data
    static public function getRecords()
    {
        return Role::get();
    }

    // Ambil data berdasarkan id
    static public function getRecord($id)
    {
        return Role::find($id);
    }
}