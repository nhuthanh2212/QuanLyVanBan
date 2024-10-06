<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToChuc;

class ToChucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tochuc = ToChuc::orderBy('id','ASC')->get();
        return view('manager.tochuc.list', compact('tochuc'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.tochuc.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenTC' => 'required|unique:tochuc',
            'MoTaTC' => 'required',
           
        ],
        [
            'TenTC.unique' => 'Tên phòng này đã có, vui lòng điền tên khác',
            'TenTC.required' => 'Tên phòng Phải Có',
            'MoTaTC.required' => 'Mô tả phòng Phải Có',
           
            
        ]);
        $tochuc = new ToChuc();
        $tochuc->TenTC = $data['TenTC'];
        $tochuc->MoTaTC = $data['MoTaTC'];
        $tochuc->TrangThai = 1;
        $tochuc->save();
        toastr()->success('Thêm Phòng Thành Công');
        return redirect()->route('to-chuc.index');
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
        $tochuc = ToChuc::find($id);
        return view('manager.tochuc.edit', compact('tochuc'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenTC' => 'required',
            'MoTaTC' => 'required',
           
        ],
        [
            
            'TenTC.required' => 'Tên phòng Phải Có',
            'MoTaTC.required' => 'Mô tả phòng Phải Có',
           
            
        ]);
        $tochuc = ToChuc::find($id);
        $tochuc->TenTC = $data['TenTC'];
        $tochuc->MoTaTC = $data['MoTaTC'];
        $tochuc->TrangThai = $request->TrangThai;
        $tochuc->save();
        toastr()->success('Cập Nhật Phòng Thành Công');
        return redirect()->route('to-chuc.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tochuc = ToChuc::find($id);
        $tochuc->delete();
        toastr()->success('Xóa Phòng Thành Công');
        return redirect()->route('to-chuc.index');
    }
}
