<?php

namespace App\Http\Controllers;

use App\Models\Subkegiatan;
use Illuminate\Http\Request;

class SubkegiatanController extends Controller
{
    public function index($id)
    {
        return $id;
    }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subkegiatan  $subkegiatan
     * @return \Illuminate\Http\Response
     */
    public function show(Subkegiatan $subkegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subkegiatan  $subkegiatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Subkegiatan $subkegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subkegiatan  $subkegiatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subkegiatan $subkegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subkegiatan  $subkegiatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subkegiatan $subkegiatan)
    {
        //
    }
}
