<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Subkegiatan;
use App\Models\Rekening;
use Illuminate\Http\Request;
use DataTables;

class RekeningController extends Controller
{
    public function index(Request $request, $id)
    {
        $menu = 'Daftar Rekening';
        $subkegiatan = Subkegiatan::where('id', $id)->first();
        if ($request->ajax()) {
            $data = Rekening::where('subkegiatan_id', $id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('kode_rekening', function ($data) {
                    $link = $data->kode_rekening;
                    return $link;
                })
                ->addColumn('nama_rekening', function ($data) {
                    $link = $data->nama_rekening;
                    return $link;
                })
                ->addColumn('pagu_rekening', function ($data) {
                    $link = 'Rp. ' . number_format($data->pagu_rekening, 0, ',', '.');
                    return $link;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-xs editRekening"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-xs deleteRekening"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['kode_rekening', 'nama_rekening', 'pagu_rekening', 'action'])
                ->make(true);
        }
        return view('admin.rekening.data', compact('menu', 'id', 'subkegiatan'));
    }


    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'kegiatan_id' => 'required|numeric',
            'subkegiatan_id' => 'required|numeric',
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'pagu_rekening' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $total =  preg_replace('/[^0-9]/', '', $request->pagu_rekening);

        $rekening = new Rekening;
        $rekening->kode_rekening = $request->kode_rekening;
        $rekening->nama_rekening = $request->nama_rekening;
        $rekening->kegiatan_id = $request->kegiatan_id;
        $rekening->subkegiatan_id = $request->subkegiatan_id;
        $rekening->pagu_rekening = $total;
        $rekening->save();

        // Update Kegiatan
        $kegiatan_id = $request->kegiatan_id;
        $get_kegiatan = Kegiatan::where('id', $request->kegiatan_id)->value('pagu_kegiatan');
        $update_kegiatan = Kegiatan::find($kegiatan_id);
        $update_kegiatan->pagu_kegiatan = $total + $get_kegiatan;
        $update_kegiatan->save();

        // Update Sub Kegiatan
        $subkegiatan_id = $request->subkegiatan_id;
        $get_subkegiatan = Subkegiatan::where('id', $request->subkegiatan_id)->value('pagu_sub');
        $update_subkegiatan = Subkegiatan::find($subkegiatan_id);
        $update_subkegiatan->pagu_sub = $total + $get_subkegiatan;
        $update_subkegiatan->save();

        return response()->json(['success' => 'Detail saved successfully.']);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'subkegiatan_id' => 'required|numeric',
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'pagu_rekening' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }
        $get_old_pagu_rekening = Rekening::where('id', $id)->value('pagu_rekening');

        // Kembalikan Kegiatan
        $kegiatan_id = $request->kegiatan_id;
        $get_kegiatan = Kegiatan::where('id', $request->kegiatan_id)->value('pagu_kegiatan');
        $kembalikan_kegiatan = Kegiatan::find($kegiatan_id);
        $kembalikan_kegiatan->pagu_kegiatan =  $get_kegiatan - $get_old_pagu_rekening;
        $kembalikan_kegiatan->save();

        // Kembalikan Sub Kegiatan
        $subkegiatan_id = $request->subkegiatan_id;
        $get_subkegiatan = Subkegiatan::where('id', $request->subkegiatan_id)->value('pagu_sub');
        $kembalikan_subkegiatan = Subkegiatan::find($subkegiatan_id);
        $kembalikan_subkegiatan->pagu_sub =  $get_subkegiatan - $get_old_pagu_rekening;
        $kembalikan_subkegiatan->save();

        //Update Rekening
        $total =  preg_replace('/[^0-9]/', '', $request->pagu_rekening);
        $rekening = Rekening::find($id);
        $rekening->kode_rekening = $request->kode_rekening;
        $rekening->nama_rekening = $request->nama_rekening;
        $rekening->kegiatan_id = $request->kegiatan_id;
        $rekening->subkegiatan_id = $request->subkegiatan_id;
        $rekening->pagu_rekening = $total;
        $rekening->save();

        // Update Kegiatan
        $update_kegiatan = Kegiatan::find($kegiatan_id);
        $get_kegiatan_new = Kegiatan::where('id', $request->kegiatan_id)->value('pagu_kegiatan');
        $update_kegiatan->pagu_kegiatan = $total + $get_kegiatan_new;
        $update_kegiatan->save();

        // Update Sub Kegiatan
        $update_subkegiatan = Subkegiatan::find($subkegiatan_id);
        $get_subkegiatan_new = Subkegiatan::where('id', $request->subkegiatan_id)->value('pagu_sub');
        $update_subkegiatan->pagu_sub = $total + $get_subkegiatan_new;
        $update_subkegiatan->save();

        return response()->json(['success' => 'Detail saved successfully.']);
    }

    public function edit($subkeg_id, $id)
    {
        $rekening = Rekening::find($id);
        return response()->json($rekening);
    }

    public function destroy($id)
    {
        $rekening = Rekening::find($id);
        $get_old_pagu_rekening = Rekening::where('id', $id)->value('pagu_rekening');

        // Kembalikan Kegiatan
        $kegiatan_id = $rekening->kegiatan_id;
        $get_kegiatan = Kegiatan::where('id', $rekening->kegiatan_id)->value('pagu_kegiatan');
        $kembalikan_kegiatan = Kegiatan::find($kegiatan_id);
        $kembalikan_kegiatan->pagu_kegiatan =  $get_kegiatan - $get_old_pagu_rekening;
        $kembalikan_kegiatan->save();

        // Kembalikan Sub Kegiatan
        $subkegiatan_id = $rekening->subkegiatan_id;
        $get_subkegiatan = Subkegiatan::where('id', $rekening->subkegiatan_id)->value('pagu_sub');
        $kembalikan_subkegiatan = Subkegiatan::find($subkegiatan_id);
        $kembalikan_subkegiatan->pagu_sub =  $get_subkegiatan - $get_old_pagu_rekening;
        $kembalikan_subkegiatan->save();

        Rekening::find($id)->delete();

        return response()->json(['success' => 'Rekening deleted successfully.']);
    }
}
