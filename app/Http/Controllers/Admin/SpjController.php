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
            $data = SPJ::where('bagian_id', Auth::user()->bagian_id)->where('status', 1)->orWhere('status', 2)->orWhere('status', 5)->get();
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
                        $btn = '<center><span class="badge badge-primary badge-xs">Belum dikirim</span></center>';
                    } elseif ($row->status == 2) {
                        $btn = '<center><span class="badge badge-info badge-xs">Menunggu Verifikasi</span></center>';
                    } elseif ($row->status == 3) {
                        $btn = '<center><span class="badge badge-success badge-xs">Diterima</span></center>';
                    } elseif ($row->status == 4) {
                        $btn = '<center><span class="badge badge-danger badge-xs text-white">Ditolak</span></center>';
                    } else {
                        $btn = '<center><span class="badge badge-warning badge-xs text-white">Dikembalikan</span></center>';
                    }
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    if ($row->status == 1) {
                        $btn = '<center>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item kirim" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Kirim">Kirim</i></a>
                                <a class="dropdown-item" href="' . route('spj.edit', $row->id) . '">Edit</a>
                                <a class="dropdown-item deleteSpj" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete">Delete</a>
                            </div>
                        </div>
                    </center>';
                    } elseif ($row->status == 2) {
                        $btn = '<center><i>no action</i></center>';
                    } elseif ($row->status == 4) {
                        $btn = '<center>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item deleteSpj" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete">Delete</a>
                            </div>
                        </div>
                    </center>';
                    } elseif ($row->status == 5) {
                        $btn = '<center>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" href="' . route('spj.edit', $row->id) . '">Edit</a>
                                <a class="dropdown-item deleteSpj" href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete">Delete</a>
                            </div>
                        </div>
                    </center>';
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
        return response()->json(['success' => 'SPJ Berhasil dikirim']);
    }

    public function destroy(SPJ $spj)
    {
        if ($spj->file) {
            Storage::delete('public/file/' . $spj->file);
        }
        $spj->delete();
        return response()->json(['success' => 'SPJ deleted successfully.']);
    }

    public function verifikasi(Request $request)
    {
        $menu = 'Verifikasi SPJ';
        if ($request->ajax()) {
            $data = SPJ::where('status', 2)->get();
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
                ->addColumn('action', function ($row) {

                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Terima" class="btn btn-success btn-xs terima">Terima</a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Kembalikan" class="btn btn-primary btn-xs kembalikan">Kembalikan</a></center>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Tolak" class="btn btn-danger btn-xs tolak">Tolak</a></center>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.spj.verifikasi', compact('menu'));
    }

    public function terima($id)
    {
        $spj = SPJ::find($id);
        $spj->update(['status' => '3']);
        $kwitansi = $spj->kwitansi;

        // Update Rekening
        $pagu_rekening = Rekening::where('id', $spj->rekening_id)->value('pagu_rekening');
        $kurangkan_rekening = Rekening::find($spj->rekening_id);
        $kurangkan_rekening->sisa_rekening = $pagu_rekening - $kwitansi;
        $kurangkan_rekening->save();

        return response()->json(['success' => 'SPJ Berhasil diterima']);
    }

    public function diterima(Request $request)
    {
        $menu = 'SPJ Diterima';
        if ($request->ajax()) {
            $user = Auth::user()->bagian_id;
            if (Auth::user()->level == 1) {
                $data = SPJ::where('status', 3)->get();
            } else {
                $data = SPJ::where('status', 3)->where('bagian_id', $user)->get();
            }
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
                ->addColumn('action', function ($row) {
                    $btn = '<center><a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Lihat" class="btn btn-success btn-xs lihat"><i class="fas fa-eye"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        if (Auth::user()->level == 1) {
            return view('admin.spj.diterima', compact('menu'));
        } else {
            return view('admin.spj.diterimausr', compact('menu'));
        }
    }
    public function ditolak(Request $request)
    {
        $menu = 'SPJ Ditolak';
        if ($request->ajax()) {
            $user = Auth::user()->bagian_id;
            if (Auth::user()->level == 1) {
                $data = SPJ::where('status', 4)->get();
            } else {
                $data = SPJ::where('status', 4)->where('bagian_id', $user)->get();
            }
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
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Lihat" class="btn btn-success btn-xs lihat"><i class="fas fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        if (Auth::user()->level == 1) {
            return view('admin.spj.ditolak', compact('menu'));
        } else {
            return view('admin.spj.ditolakusr', compact('menu'));
        }
    }
    public function edit()
    {
        echo "Belum ada aksi";
    }

    public function kembalikan(SPJ $spj)
    {
        $spj->update(['status' => '5']);
        return response()->json(['success' => 'SPJ Berhasil dikembalikan']);
    }

    public function tolak(SPJ $spj)
    {
        $spj->update(['status' => '4']);
        return response()->json(['success' => 'SPJ Berhasil ditolak']);
    }
}
