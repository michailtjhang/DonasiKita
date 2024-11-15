<?php

namespace App\Http\Controllers\Backend;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    public function index()
    {
        $PermissionRole = PermissionRole::getPermission('Config', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            abort(404);
        }

        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Config', Auth::user()->role_id);

        $data['config'] = Config::paginate(5);
        
        return view('Backend.config.index', [
            'page_title' => 'Config Website',
            'data' => $data,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        Config::find($data['id'])->update($data);

        return back()->with('success', 'Config updated successfully');
    }
}