<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;
use App\Models\Truong;


class KhoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $khoa = Khoa::with('truong')->orderBy('id','ASC')->get();
        return view('manager.khoa.list', compact('khoa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $truong = Truong::orderBy('id','ASC')->get();
        return view('manager.khoa.create',compact('truong'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenKhoa' => 'required|unique:khoa',
            'MoTaKhoa' => 'required',
            'id_Truong' => 'required',
        ],
        [
            'TenKhoa.unique' => 'Tên khoa này đã có, vui lòng điền tên khác',
            'TenKhoa.required' => 'Tên khoa Phải Có',
            'MoTaKhoa.required' => 'Mô tả khoa Phải Có',
            'id_Truong.required' => 'Phải chọn trường cho khoa',
            
        ]);
        $khoa = new Khoa();
        $khoa->TenKhoa = $data['TenKhoa'];
        $khoa->MoTaKhoa = $data['MoTaKhoa'];
        $khoa->TrangThai = 1;
        $khoa->id_Truong = $data['id_Truong'];
        $khoa->save();
        toastr()->success('Thêm Khoa Thành Công');
        return redirect()->route('khoa.index');
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
        $khoa = Khoa::find($id);
        $truong = Truong::orderBy('id','ASC')->get();
        return view('manager.khoa.edit', compact('khoa','truong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenKhoa' => 'required',
            'MoTaKhoa' => 'required',
           
        ],
        [
            
            'TenKhoa.required' => 'Tên khoa Phải Có',
            'MoTaKhoa.required' => 'Mô tả khoa Phải Có',
           
            
        ]);
        $khoa = Khoa::find($id);
        $khoa->TenKhoa = $data['TenKhoa'];
        $khoa->MoTaKhoa = $data['MoTaKhoa'];
        $khoa->TrangThai = $request->TrangThai;
        $khoa->id_Truong = $request->id_Truong;
        $khoa->save();
        toastr()->success('Cập Nhật Khoa Thành Công');
        return redirect()->route('khoa.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khoa = Khoa::find($id);
        $khoa->delete();
        toastr()->success('Xóa Khoa Thành Công');
        return redirect()->route('khoa.index');
    }
}
