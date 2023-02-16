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
use DataTables;

class SpjController extends Controller
{

    public function index(Request $request)
    {
        $menu = 'Pengajuan SPJ';
        $spj = SPJ::where('bagian_id', Auth::user()->bagian_id)->get();

        if ($request->ajax()) {
            $data = SPJ::where('bagian_id', Auth::user()->bagian_id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($data) {
                    return  \Carbon\Carbon::createFromFormat('Y-m-d', $data->tanggal)->format('d/m/Y');
                })
                ->addColumn('kegiatan', function ($data) {
                    $link = $data->kegiatan->kode_kegiatan;
                    $link = $link . ' ' . $data->kegiatan->nama_kegiatan;
                    return $link;
                })
                ->addColumn('subkeg', function ($data) {
                    $link = $data->subkegiatan->kode_sub;
                    $link = $link . ' ' . $data->subkegiatan->nama_sub;
                    return $link;
                })
                ->addColumn('rekening', function ($data) {
                    $link = $data->rekening->kode_rekening;
                    $link = $link . ' ' . $data->rekening->nama_rekening;
                    return $link;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 1) {
                        $btn = '<button class="btn btn-primary btn-xs">Belum dikirim</button>';
                    } elseif ($row->status == 2) {
                        $btn = '<button class="btn btn-secondary btn-xs">Menunggu Verifikasi</button>';
                    } elseif ($row->status == 3) {
                        $btn = '<button class="btn btn-success btn-xs">Diterima</button>';
                    } elseif ($row->status == 4) {
                        $btn = '<button class="btn btn-danger btn-xs">Ditolak</button>';
                    } else {
                        $btn = '<button class="btn btn-warning btn-xs">Dikembalikan</button>';
                    }
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Kirim" class="btn btn-primary btn-xs kirim">Kirim</i></a>';
                        $btn = '<center>' . $btn . ' <a href="' . route('spj.edit', $row->id) . '" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a></center>';
                        $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteSpj">&nbsp;<i class="fas fa-trash"></i>&nbsp;</a></center>';
                    } elseif ($row->status == 3) {
                        $btn = '<center><a href="' . route('spj.edit', $row->id) . '" class="btn btn-success btn-xs"><i class="fas fa-download"></i></a></center>';
                    } elseif ($row->status == 5) {
                        $btn = '<center><a href="' . route('spj.edit', $row->id) . '" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i></a></center>';
                        $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteSpj">&nbsp;<i class="fas fa-trash"></i>&nbsp;</a></center>';
                    } else {
                        $btn = '';
                    }

                    return $btn;
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('admin.spj.data', compact('menu', 'spj'));
    }
    public function indexadm(Request $request)
    {
        $data = SPJ::get();
        $menu = 'Data SPJ';
        return view('admin.spj.data-admin', compact('menu', 'data'));
    }

    public function create()
    {
        $menu = 'Pengajuan SPJ';
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
        return response()->json(['success' => 'SPJ Berhasil di Kirim']);
        // return redirect()->route('spj.index')->with('success', 'SPJ Berhasil di Kirim');
    }


    public function destroy(SPJ $spj)
    {
        if ($spj->file) {
            Storage::delete('public/file/' . $spj->file);
        }
        $spj->delete();
        return response()->json(['success' => 'SPJ deleted successfully.']);
        // return redirect()->route('spj.index')->with('success', 'SPJ deleted successfully');
    }
}
