<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\BoPhan;
use App\Models\PhongBan;

class BoPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bophan = BoPhan::with('phongban')->orderBy('id','ASC')->get();
        return view('manager.bophan.list',compact('bophan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phongban = PhongBan::orderBy('id','ASC')->get();
        return view('manager.bophan.create', compact('phongban'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'TenBP' => 'required|unique:bophan',
            'MoTaBP' => 'required',
            'id_PB' => 'required',
        ],
        [
            'TenBP.unique' => 'Tên bộ phận này đã có, vui lòng điền tên khác',
            'TenBP.required' => 'Tên Bộ Phận Phải Có',
            'MoTaBP.required' => 'Mô Tả Bộ Phận Phải Có',
           'id_PB.required' => ' Bộ Phận Này Thuộc Phòng Ban Nào Phải Có',
            
        ]);
        $bophan = new BoPhan();
        $bophan->TenBP = $data['TenBP'];
        $bophan->slug = str::slug($data['TenBP']);
        $bophan->MoTaBP = $data['MoTaBP'];
        $bophan->id_PB = $data['id_PB'];
        $bophan->TrangThai = 1;
        $bophan->save();
        toastr()->success('Thêm Bộ Phận Thành Công');
        return redirect()->route('bo-phan.index');
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
        $bophan = BoPhan::find($id);
        $phongban = PhongBan::orderBy('id','ASC')->get();
        return view('manager.bophan.edit', compact('phongban', 'bophan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenBP' => 'required|unique:bophan',
            'MoTaBP' => 'required',
            'id_PB' => 'required',
        ],
        [
            'TenBP.unique' => 'Tên bộ phận này đã có, vui lòng điền tên khác',
            'TenBP.required' => 'Tên Bộ Phận Phải Có',
            'MoTaBP.required' => 'Mô Tả Bộ Phận Phải Có',
           'id_PB.required' => ' Bộ Phận Này Thuộc Phòng Ban Nào Phải Có',
            
        ]);
        $bophan = BoPhan::find($id);
        $bophan->TenBP = $data['TenBP'];
        $bophan->slug = str::slug($data['TenBP']);
        $bophan->MoTaBP = $data['MoTaBP'];
        $bophan->id_PB = $data['id_PB'];
        $bophan->TrangThai = $request->TrangThai;
        $bophan->save();
        toastr()->success('Cập Nhật Bộ Phận Thành Công');
        return redirect()->route('bo-phan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bophan = BoPhan::find($id);
        $bophan->delete();
        toastr()->success('Xóa Bộ Phận Thành Công');
        return redirect()->route('bo-phan.index');
    }
}
