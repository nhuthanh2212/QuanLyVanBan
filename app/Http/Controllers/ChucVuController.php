<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChucVu;

class ChucVuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chucvu = ChucVu::orderBy('id','ASC')->get();
        return view('manager.chucvu.list', compact('chucvu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.chucvu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenCV' => 'required|unique:chucvu',
            'MoTaCV' => 'required',
           
        ],
        [
            'TenCV.unique' => 'Tên chức vụ này đã có, vui lòng điền tên khác',
            'TenCV.required' => 'Tên chức vụ Phải Có',
            'MoTaCV.required' => 'Mô tả chức vụ Phải Có',
           
            
        ]);
        $chucvu = new ChucVu();
        $chucvu->TenCV = $data['TenCV'];
        $chucvu->MoTaCV = $data['MoTaCV'];
        $chucvu->TrangThai = 1;
        $chucvu->save();
        toastr()->success('Thêm Chức Vụ Thành Công');
        return redirect()->route('chuc-vu.index');
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
        $chucvu = ChucVu::find($id);
        return view('manager.chucvu.edit', compact('chucvu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenCV' => 'required',
            'MoTaCV' => 'required',
           
        ],
        [
            
            'TenCV.required' => 'Tên chức vụ Phải Có',
            'MoTaCV.required' => 'Mô tả chức vụ Phải Có',
           
            
        ]);
        $chucvu = ChucVu::find($id);
        $chucvu->TenCV = $data['TenCV'];
        $chucvu->MoTaCV = $data['MoTaCV'];
        $chucvu->TrangThai = $request->TrangThai;
        $chucvu->save();
        toastr()->success('Cập Nhật Chức Vụ Thành Công');
        return redirect()->route('chuc-vu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chucvu = ChucVu::find($id);
        $chucvu->delete();
        toastr()->success('Xóa Chức Vụ Thành Công');
        return redirect()->route('chuc-vu.index');
    }
}
