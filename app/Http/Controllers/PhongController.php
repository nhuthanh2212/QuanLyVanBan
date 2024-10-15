<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Phong;
use App\Models\DonVi;

class PhongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phong = Phong::with('DonVi')->orderBy('id','DESC')->get();
        return view('manager.phong.list', compact('phong'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $donvi = DonVi::orderBy('id','ASC')->get();
        return view('manager.phong.create',compact('donvi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenP' => 'required|unique:phong',
            'MoTaP' => 'required',
            'id_DV' => 'required',
        ],
        [
            'TenP.unique' => 'Tên Phòng này đã có, vui lòng điền tên khác',
            'TenP.required' => 'Tên Phòng Phải Có',
            'MoTaP.required' => 'Mô Tả Phòng Phải Có',
           'id_DV.required' => ' Phòng Này Thuộc Đơn Vị Nào Phải Có',
            
        ]);
        $phong = new Phong();
        $phong->TenP = $data['TenP'];
        $phong->slug = str::slug($data['TenP']);
        $phong->MoTaP = $data['MoTaP'];
        $phong->id_DV = $data['id_DV'];
        $phong->TrangThai = 1;
        $phong->save();
        toastr()->success('Thêm Phòng Thành Công');
        return redirect()->route('phong.index');
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
        $phong = Phong::find($id);
        $donvi = DonVi::orderBy('id','ASC')->get();
        return view('manager.phong.edit',compact('donvi','phong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenP' => 'required:Phong',
            'MoTaP' => 'required',
            'id_DV' => 'required',
        ],
        [
           
            'TenP.required' => 'Tên Phòng Phải Có',
            'MoTaP.required' => 'Mô Tả Phòng Phải Có',
           'id_DV.required' => ' Phòng Này Thuộc Bộ Phận Nào Phải Có',
            
        ]);
        $phong = Phong::find($id);
        $phong->TenP = $data['TenP'];
        $phong->slug = str::slug($data['TenP']);
        $phong->MoTaP = $data['MoTaP'];
        $phong->id_DV = $data['id_DV'];
        $phong->TrangThai = $request->TrangThai;
        $phong->save();
        toastr()->success('Cập Nhật Phòng Thành Công');
        return redirect()->route('phong.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phong = Phong::find($id);
        $phong->delete();
        toastr()->success('Xóa Phòng Thành Công');
        return redirect()->route('phong.index');
    }
}
