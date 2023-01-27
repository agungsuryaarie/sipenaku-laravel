<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;
use DataTables;

class BagianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
    //     $menu = 'Bagian';
    //     if ($request->ajax()) {

    //         $data = Bagian::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    //     return view('admin.bagian.data', compact('menu'));
    // }

    public function index()
    {
        $menu = 'Bagian';
        if (request()->ajax()) {
            $data = Bagian::latest()->get();
            return datatables()->of($data)
                ->addColumn('action', 'admin.bagian.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.bagian.data', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'nama_bagian' => 'required|string|max:255',
        ]);

        //create post
        Bagian::create([
            'nama_bagian' => $request->nama_bagian,
        ]);

        //redirect to index
        return redirect()->route('bagian.data')->with(['status' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function show(Bagian $bagian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function edit(Bagian $bagian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bagian $bagian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bagian  $bagian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bagian $bagian)
    {
        //
    }
}
