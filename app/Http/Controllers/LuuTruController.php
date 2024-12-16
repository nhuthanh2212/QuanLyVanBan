<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VanBanDen;
use App\Models\TaiKhoan;
use App\Models\LuuTru;

class LuuTruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vanban.luutru.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $luutru = new LuuTru();
        $luutru->id_TK = $request->id_nguoigui;
        $luutru->id_VB = $request->id_vb;
        $luutru->save();
        toastr()->success('Lưu Trữ Văn Bản Thành Công', 'Thành Công');
        return redirect()->back();;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
