<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionRole extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    protected $table = 'permission_role';
    protected $fillable = [
        'permission_id',
        'role_id',
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Insert or Update
    static function InsertUpdateRecord($permission_ids, $role_id)
    {
        PermissionRole::where('role_id', $role_id)->delete();
        foreach ($permission_ids as $key => $permission_id) {
            $data = [
                'permission_id' => $permission_id,
                'role_id' => $role_id
            ];
            PermissionRole::updateOrCreate($data);
        }
    }

    // Get Permission by id
    static function getRolePermission($id)
    {
        return PermissionRole::where('role_id', $id)->pluck('permission_id')->all();
    }

    // Get Permission by Role and Slug
    static function getPermission($slug, $role_id)
    {
        return PermissionRole::with('permission')
            ->where('role_id', $role_id)
            ->whereHas('permission', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })
            ->count();
    }
}