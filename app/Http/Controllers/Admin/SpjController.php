<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Rekening;
use Illuminate\Http\Request;
use App\Models\SPJ;
use App\Models\Subkegiatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SpjController extends Controller
{

    public function index(Request $request)
    {
        $menu = 'SPJ';
        $spj = SPJ::where('bagian_id', Auth::user()->bagian_id)->get();
        return view('admin.spj.data', compact('menu', 'spj'));
    }
    public function indexadm(Request $request)
    {
        $menu = 'Data SPJ';
        return view('admin.spj.data-admin', compact('menu'));
    }

    public function create()
    {
        $menu = 'Tambah SPJ';
        $kegiatan = Kegiatan::where('bagian_id', Auth::user()->bagian_id)->get();
        return view('admin.spj.create', compact('menu', 'kegiatan'));
    }

    public function getSubkeg(Request $request)
    {
        $data['subkeg'] = Subkegiatan::where("kegiatan_id", $request->kegiatan_id)->get(["nama_sub", "id"]);
        return response()->json($data);
    }

    public function getRekening(Request $request)
    {
        $data['rekening'] = Rekening::where("subkegiatan_id", $request->subkeg_id)->get(["nama_rekening", "id"]);
        return response()->json($data);
    }

    public function store(Request $request)
    {

        // $request->validate([
        //     'bagian_id' => 'required',
        //     'kegiatan_id' => 'required',
        //     'subkegiatan_id' => 'required',
        //     'rekening_id' => 'required',
        //     'uraian' => 'required',
        //     'kwitansi' => 'required',
        //     'nama_penerima' => 'required',
        //     'alamat_penerima' => 'required',
        //     'jenis_spm' => 'required',
        // ]);

        $fileName = time() . '.' . $request->file->extension();
        $request->file->storeAs('public/file', $fileName);

        if ($request->tanggal == '') {
            $tanggal = Carbon::now()->format('Y-m-d');
        } else {
            $tanggal = $request->tanggal;
        }

        SPJ::create([
            'tanggal' => $tanggal,
            'bagian_id' => Auth::user()->bagian_id,
            'kegiatan_id' => $request->kegiatan_id,
            'subkegiatan_id' => $request->subkegiatan_id,
            'rekening_id' => $request->rekening_id,
            'uraian' => $request->uraian,
            'kwitansi' => $request->kwitansi,
            'nama_penerima' => $request->nama_penerima,
            'alamat_penerima' => $request->alamat_penerima,
            'jenis_spm' => $request->jenis_spm,
            'file' => $fileName,
            'status' => '1',
        ]);

        return redirect()->route('spj.index')->with('success', 'SPJ Berhasil di Tambah');
    }

    public function kirim(SPJ $spj)
    {
        $spj->update(['status' => '2']);
        return redirect()->route('spj.index')->with('success', 'SPJ Berhasil di Kirim');
    }


    public function destroy(SPJ $spj)
    {
        if ($spj->file) {
            Storage::delete('public/file/' . $spj->file);
        }

        $spj->delete();

        return redirect()->route('spj.index')->with('success', 'SPJ deleted successfully');
    }
}
