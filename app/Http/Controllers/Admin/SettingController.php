<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use DataTables;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu = 'Setting Jadwal';
        $setting = Setting::first();
        return view('admin.setting.data', compact('setting', 'menu'));
    }
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'judul' => 'required',
            'tglm' => 'required',
            'jamm' => 'required',
            'tgls' => 'required',
            'jams' => 'required',
        ]);
        Setting::create(
            [
                'judul' => $request->judul,
                'tgl_mulai' => $request->tglm,
                'jam_mulai' => $request->jamm,
                'tgl_selesai' => $request->tgls,
                'jam_selesai' => $request->jams,
            ]
        );
        //redirect to index
        return redirect()->route('setting.index')->with(['status' => 'Data Berhasil Disimpan!']);
    }
    public function update(Request $request, Setting $set)
    {
        $set->update(
            [
                'judul' => $request->judul,
                'tgl_mulai' => $request->tglm,
                'jam_mulai' => $request->jamm,
                'tgl_selesai' => $request->tgls,
                'jam_selesai' => $request->jams,
            ]
        );
        //redirect to index
        return redirect()->route('setting.index')->with(['status' => 'Data Berhasil Diupdate!']);
    }
}
