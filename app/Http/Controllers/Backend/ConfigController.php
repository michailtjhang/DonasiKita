<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        return view('Backend.config.index', [
            'page_title' => 'Config Website',
            'data' => Config::paginate(5),
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