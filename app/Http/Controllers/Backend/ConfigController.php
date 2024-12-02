<?php

namespace App\Http\Controllers\Backend;

use App\Models\Config;
use Illuminate\Http\Request;
use App\Models\PermissionRole;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ConfigController extends Controller
{
    public function index()
    {
        // Ambil izin berdasarkan role pengguna
        $PermissionRole = PermissionRole::getPermission('Config', Auth::user()->role_id);
        if (empty($PermissionRole)) {
            return back();
        }

        // Ambil data konfigurasi
        $data['configs'] = Config::all(); // Untuk modal editing

        // Ambil izin Edit
        $data['PermissionEdit'] = PermissionRole::getPermission('Edit Config', Auth::user()->role_id);

        // Jika request adalah Ajax untuk DataTables
        if (request()->ajax()) {
            $config = Config::get();
            return DataTables::of($config)
                ->addIndexColumn()
                ->addColumn('action', function ($config) use ($data) {
                    // Tambahkan tombol Edit jika izin Edit ada
                    if (!empty($data['PermissionEdit'])) {
                        return '<button type="button" class="btn btn-sm btn-warning" data-toggle="modal"
                                data-target="#modalUpdate' . $config->id . '" title="Edit">
                                <i class="fas fa-fw fa-edit"></i>
                            </button>';
                    } else {
                        return '';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('Backend.config.index', [
            'page_title' => 'Config Website',
            'data' => $data,
        ]);
    }

    public function update(Request $request, string $id)
    {
        // Validasi input
        $data = $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        // Update konfigurasi
        Config::find($id)->update($data);

        return back()->with('success', 'Config updated successfully');
    }
}
