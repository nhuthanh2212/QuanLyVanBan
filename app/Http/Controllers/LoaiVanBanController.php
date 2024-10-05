<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiVanBan;


class LoaiVanBanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loaivanban = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        return view('manager.loaivanban.list',compact('loaivanban'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.loaivanban.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenLVB' => 'required|unique:loaivanban',
            'MoTaLVB' => 'required',
           
        ],
        [
            'TenLVB.unique' => 'Tên loại văn bản này đã có, vui lòng điền tên khác',
            'TenLVB.required' => 'Tên loại văn bản Phải Có',
            'MoTaLVB.required' => 'Mô tả loại văn bản Phải Có',
           
            
        ]);
        $loaivanban = new LoaiVanBan();
        $loaivanban->TenLVB = $data['TenLVB'];
        $loaivanban->MoTaLVB = $data['MoTaLVB'];
        $loaivanban->TrangThai = 1;
        $loaivanban->save();
        toastr()->success('Thêm loại văn bản Thành Công');
        return redirect()->route('loai-van-ban.index');
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
        $loai = LoaiVanBan::find($id);
        return view('manager.loaivanban.edit',compact('loai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenLVB' => 'required:loaivanban',
            'MoTaLVB' => 'required',
           
        ],
        [
            
            'TenLVB.required' => 'Tên loại văn bản Phải Có',
            'MoTaLVB.required' => 'Mô tả loại văn bản Phải Có',
           
            
        ]);
        $loaivanban = LoaiVanBan::find($id);
        $loaivanban->TenLVB = $data['TenLVB'];
        $loaivanban->MoTaLVB = $data['MoTaLVB'];
        $loaivanban->TrangThai = $request->TrangThai;
        $loaivanban->save();
        toastr()->success('Cập nhật loại văn bản Thành Công');
        return redirect()->route('loai-van-ban.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loai = LoaiVanBan::find($id);
        $loai->delete();
        toastr()->success('Xóa loại văn bản Thành Công');
        return redirect()->route('loai-van-ban.index');
    }
}
