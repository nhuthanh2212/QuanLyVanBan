<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HanhChinh;

class HanhChinhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hanhchinh = HanhChinh::orderBy('id','ASC')->get();
        return view('manager.hanhchinh.list', compact('hanhchinh'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.hanhchinh.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenP' => 'required|unique:hanhchinh',
            'MoTaP' => 'required',
           
        ],
        [
            'TenP.unique' => 'Tên phòng này đã có, vui lòng điền tên khác',
            'TenP.required' => 'Tên phòng Phải Có',
            'MoTaP.required' => 'Mô tả phòng Phải Có',
           
            
        ]);
        $hanhchinh = new HanhChinh();
        $hanhchinh->TenP = $data['TenP'];
        $hanhchinh->MoTaP = $data['MoTaP'];
        $hanhchinh->TrangThai = 1;
        $hanhchinh->save();
        toastr()->success('Thêm Phòng Thành Công');
        return redirect()->route('hanh-chinh.index');
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
        $hanhchinh = HanhChinh::find($id);
        return view('manager.hanhchinh.edit', compact('hanhchinh'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenP' => 'required:hanhchinh',
            'MoTaP' => 'required',
           
        ],
        [
            
            'TenP.required' => 'Tên phòng Phải Có',
            'MoTaP.required' => 'Mô tả phòng Phải Có',
           
            
        ]);
        $hanhchinh = HanhChinh::find($id);
        $hanhchinh->TenP = $data['TenP'];
        $hanhchinh->MoTaP = $data['MoTaP'];
        $hanhchinh->TrangThai = $request->TrangThai;
        $hanhchinh->save();
        toastr()->success('Cập Nhật Phòng Thành Công');
        return redirect()->route('hanh-chinh.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hanhchinh = HanhChinh::find($id);
        $hanhchinh->delete();
        toastr()->success('Xóa Phòng Thành Công');
        return redirect()->route('hanh-chinh.index');
    }
}
