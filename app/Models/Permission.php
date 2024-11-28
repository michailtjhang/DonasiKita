<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory, HasUuids;

    public $table = 'permission';

    protected $fillable = [
        'name'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role', 'permission_id', 'role_id');
    }

    // Get Permission 
    static public function getRecords()
    {
        $getPermissions = Permission::select('groupby', DB::raw('MIN(id) as id')) // Mengambil MIN(id) agar urut sesuai nama aslinya
            ->groupBy('groupby')
            ->get();

        $result = array();
        foreach ($getPermissions as $value) {
            $permission = Permission::find($value->id);

            $getPermissionsGroup = Permission::where('groupby', $value->groupby)->get();
            $data = array();
            $data['id'] = $permission->id; 
            $data['name'] = $permission->name; 

            $group = array();
            foreach ($getPermissionsGroup as $groupValue) {
                $dataG = array();
                $dataG['id'] = $groupValue->id; 
                $dataG['name'] = $groupValue->name;
                $group[] = $dataG;
            }

            $data['group'] = $group;
            $result[] = $data;
        }

        return $result;
    }

    // Get Permission Group
    static public function getPermissionsGroup($group)
    {
        return Permission::where('groupby', $group)->get();
    }

    // Get Record
    static public function getRecord($id)
    {
        return Permission::find($id);
    }
}