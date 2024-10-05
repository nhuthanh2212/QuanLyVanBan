<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonViCapCao;

class DonViCapCaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donvi = DonViCapCao::orderBy('id_DV','ASC')->get();
        return view('manager.donvicapcao.list' , compact('donvi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.donvicapcao.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenDV' => 'required|unique:donvicapcao',
            'MoTaDV' => 'required',
           
        ],
        [
            'TenDV.unique' => 'Tên đon vị này đã có, vui lòng điền tên khác',
            'TenDV.required' => 'Tên đơn vị Phải Có',
            'MoTaDV.required' => 'Mô tả đon vị Phải Có',
           
            
        ]);
        $donvi = new DonViCapCao();
        $donvi->TenDV = $data['TenDV'];
        $donvi->MoTaDV = $data['MoTaDV'];
        $donvi->TrangThai = 1;
        $donvi->save();
        toastr()->success('Thêm Đơn Vị Cấp Cao Thành Công');
        return redirect()->route('don-vi-cap-cao.index');
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
        $donvi = DonViCapCao::find($id);
        return view('manager.donvicapcao.edit',compact('donvi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenDV' => 'required:donvicapcao',
            'MoTaDV' => 'required',
           
        ],
        [
            
            'TenDV.required' => 'Tên Đơn Vị Phải Có',
            'MoTaDV.required' => 'Mô Tả Đơn Vị Phải Có',
           
            
        ]);
        $donvi = DonViCapCao::find($id);
        $donvi->TenDV = $data['TenDV'];
        $donvi->MoTaDV = $data['MoTaDV'];
        $donvi->TrangThai = $request->TrangThai;
        $donvi->save();
        toastr()->success('Cập nhật đơn vị cấp cao Thành Công');
        return redirect()->route('don-vi-cap-cao.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $donvi = DonViCapCao::find($id);
        $donvi->delete();
        toastr()->success('Xóa đơn vị cấp cao Thành Công');
        return redirect()->route('don-vi-cap-cao.index');
    }
}
