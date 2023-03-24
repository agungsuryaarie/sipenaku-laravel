<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bagian;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use App\Models\TW;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;

class RkaController extends Controller
{
    public function index()
    {
        $menu = 'Rencana Kerja Anggaran';
        $bagian = Bagian::get();

        return view('admin.rka.data', compact('menu', 'bagian'));
    }

    public function get(Request $request, $id)
    {
        // dd($request);
        if ($request->ajax()) {
            $data = TW::where('subkegiatan_id', $id)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('rekening', function ($data) {
                    $link = $data->rekening_id;
                    return $link;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editRekening"><i class="fas fa-edit"></i></a>';
                    $btn = '<center>' . $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteRekening"><i class="fas fa-trash"></i></a><center>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function fetchKegiatan(Request $request)
    {
        $data['kegiatan'] = Kegiatan::where("bagian_id", $request->bagian_id)
            ->get(["nama_kegiatan", "id"]);

        return response()->json($data);
    }

    public function fetchSubkeg(Request $request)
    {
        $data['subkeg'] = Subkegiatan::where("kegiatan_id", $request->kegiatan_id)
            ->get(["nama_sub", "id"]);

        return response()->json($data);
    }
}
