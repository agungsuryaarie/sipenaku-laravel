<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AppSettingController extends Controller
{

    public function index()
    {
        $menu = 'Setting Aplikasi';
        $appsetting = AppSetting::first();

        return view('admin.app-setting.data', compact('menu', 'appsetting'));
    }

    public function edit(Request $request, AppSetting $appsetting)
    {
        $menu = 'Edit Setting Aplikasi';
        $appsetting = AppSetting::first();
        return view('admin.app-setting.edit', compact('menu', 'appsetting'));
    }

    public function update(Request $request, AppSetting $appsetting)
    {
        //Translate Bahasa Indonesia
        $message = array(
            'foto.images' => 'File harus image.',
            'foto.mimes' => 'Foto harus jpeg,png,jpg.',
            'foto,max' => 'File maksimal 1MB.',
        );
        //validate form
        $this->validate($request, [
            'nama_aplikasi' => 'required|string|max:255',
            'keterangan_aplikasi' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:1024',
        ], $message);
        //check if image & logo is uploaded
        if ($request->hasFile('gambar')) {
            // upload new image and new logo
            $img = $request->file('gambar');
            $img->storeAs('public/logo', $img->hashName());
            // delete old image and old logo
            Storage::delete('public/logo/' . $appsetting->gambar);
            // update sambutan with img & logo
            $appsetting->update([
                'nama_aplikasi' => $request->nama_aplikasi,
                'keterangan_aplikasi' => $request->keterangan_aplikasi,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'gambar' => $img->hashName(),
            ]);
        } else {
            //update sambutan without image img & logo
            $appsetting->update([
                'nama_aplikasi' => $request->nama_aplikasi,
                'keterangan_aplikasi' => $request->keterangan_aplikasi,
                'visi' => $request->visi,
                'misi' => $request->misi,
            ]);
        }
        //redirect to index
        return redirect()->route('appsetting.index')->with(['status' => 'Data Berhasil Diubah!']);
    }
}
