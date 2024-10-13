<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Nganh;
use App\Models\ChuyenNganh;

class ChuyenNganhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chuyennganh = ChuyenNganh::with('nganh')->orderBy('id','DESC')->get();
        return view('manager.chuyennganh.list', compact('chuyennganh'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nganh = Nganh::orderBy('id','ASC')->get();
        return view('manager.chuyennganh.create',compact('nganh'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenCN' => 'required|unique:chuyennganh',
            'MoTaCN' => 'required',
            'id_N' => 'required',
        ],
        [
            'TenCN.unique' => 'Tên chuyên ngành này đã có, vui lòng điền tên khác',
            'TenCN.required' => 'Tên Chuyên Ngành Phải Có',
            'MoTaCN.required' => 'Mô Tả Chuyên Ngành Phải Có',
           'id_N.required' => 'Chuyên Ngành Này Thuộc Ngành Nào Phải Có',
            
        ]);
        $chuyennganh = new ChuyenNganh();
        $chuyennganh->TenCN = $data['TenCN'];
        $chuyennganh->slug = str::slug($data['TenCN']);
        $chuyennganh->MoTaCN = $data['MoTaCN'];
        $chuyennganh->id_N = $data['id_N'];
        $chuyennganh->TrangThai = 1;
        $chuyennganh->save();
        toastr()->success('Thêm Chuyên Ngành Thành Công');
        return redirect()->route('chuyen-nganh.index');
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
        $nganh = Nganh::orderBy('id','ASC')->get();
        $chuyennganh = ChuyenNganh::find($id);
        return view('manager.chuyennganh.edit',compact('nganh','chuyennganh'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenCN' => 'required:chuyennganh',
            'MoTaCN' => 'required',
            'id_N' => 'required',
        ],
        [
           
            'TenCN.required' => 'Tên Chuyên Ngành Phải Có',
            'MoTaCN.required' => 'Mô Tả Chuyên Ngành Phải Có',
           'id_N.required' => 'Chuyên Ngành Này Thuộc Ngành Nào Phải Có',
            
        ]);
        $chuyennganh =  ChuyenNganh::find($id);
        $chuyennganh->TenCN = $data['TenCN'];
        $chuyennganh->slug = str::slug($data['TenCN']);
        $chuyennganh->MoTaCN = $data['MoTaCN'];
        $chuyennganh->id_N = $data['id_N'];
        $chuyennganh->TrangThai = $request->TrangThai;
        $chuyennganh->save();
        toastr()->success('Cập Nhật Chuyên Ngành Thành Công');
        return redirect()->route('chuyen-nganh.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chuyennganh = ChuyenNganh::find($id);
        $chuyennganh->delete();
        toastr()->success('Xóa Chuyên Ngành Thành Công');
        return redirect()->route('chuyen-nganh.index');
    }
}
