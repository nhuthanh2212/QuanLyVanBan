<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\PhongBan;
use App\Models\Ban;
class BanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ban = Ban::with('phongban')->orderBy('id','DESC')->get();
        return view('manager.bannganh.list', compact('ban'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $phongban = PhongBan::orderBy('id','ASC')->get();
        return view('manager.bannganh.create', compact('phongban'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenB' => 'required|unique:ban',
            'MoTaB' => 'required',
            'id_PB' => 'required',
        ],
        [
            'TenB.unique' => 'Tên Ban Ngành này đã có, vui lòng điền tên khác',
            'TenB.required' => 'Tên Ban Ngành Phải Có',
            'MoTaB.required' => 'Mô Tả Ban Ngành Phải Có',
           'id_PB.required' => ' Ban Này Thuộc Phòng Ban Nào Phải Có',
            
        ]);
        $ban = new Ban();
        $ban->TenB = $data['TenB'];
        $ban->slug = str::slug($data['TenB']);
        $ban->MoTaB = $data['MoTaB'];
        $ban->id_PB = $data['id_PB'];
        $ban->TrangThai = 1;
        $ban->save();
        toastr()->success('Thêm Ban Ngành Thành Công');
        return redirect()->route('ban.index');
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
        $phongban = PhongBan::orderBy('id','ASC')->get();
        $ban = Ban::find($id);
        return view('manager.bannganh.edit', compact('phongban','ban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenB' => 'required:ban',
            'MoTaB' => 'required',
            'id_PB' => 'required',
        ],
        [
            
            'TenB.required' => 'Tên Ban Ngành Phải Có',
            'MoTaB.required' => 'Mô Tả Ban Ngành Phải Có',
           'id_PB.required' => ' Ban Này Thuộc Phòng Ban Nào Phải Có',
            
        ]);
        $ban = Ban::find($id);
        $ban->TenB = $data['TenB'];
        $ban->slug = str::slug($data['TenB']);
        $ban->MoTaB = $data['MoTaB'];
        $ban->id_PB = $data['id_PB'];
        $ban->TrangThai = $request->TrangThai;
        $ban->save();
        toastr()->success('Cập Nhật Ban Ngành Thành Công');
        return redirect()->route('ban.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ban = Ban::find($id);
        $ban->delete();
        toastr()->success('Xóa Ban Ngành Thành Công');
        return redirect()->route('ban.index');
    }
}
