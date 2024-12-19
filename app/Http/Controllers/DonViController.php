<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Models\DonVi;
use App\Models\PhongBan;

class DonViController extends Controller
{
    public function session_login(){
        $id = Session::get('id');
        if($id){
            return redirect::to('/home');
        }
        else{
            return redirect::to('/login-manager')->send();
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->session_login();
        $donvi = DonVi::with('phongban')->orderBy('id','ASC')->get();
        return view('manager.donvi.list',compact('donvi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        $phongban = PhongBan::where('TrangThai',1)->orderBy('id','ASC')->get();
        return view('manager.donvi.create', compact('phongban'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'TenDV' => 'required|unique:donvi',
            'MoTaDV' => 'required',
            'id_PB' => 'required',
        ],
        [
            'TenDV.unique' => 'Tên Đơn Vị này đã có, vui lòng điền tên khác',
            'TenDV.required' => 'Tên Đơn Vị Phải Có',
            'MoTaDV.required' => 'Mô Tả Đơn Vị Phải Có',
           'id_PB.required' => ' Đơn Vị Này Thuộc Phòng Ban Nào Phải Có',
            
        ]);
        $donvi = new DonVi();
        $donvi->TenDV = $data['TenDV'];
        $donvi->slug = str::slug($data['TenDV']);
        $donvi->MoTaDV = $data['MoTaDV'];
        $donvi->id_PB = $data['id_PB'];
        $donvi->TrangThai = 1;
        $donvi->save();
        toastr()->success('Thêm Đơn Vị Thành Công','Thành Công');
        return redirect()->route('don-vi.index');
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
        $this->session_login();
        $donvi = DonVi::find($id);
        $phongban = PhongBan::where('TrangThai',1)->orderBy('id','ASC')->get();
        return view('manager.donvi.edit', compact('phongban', 'donvi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenDV' => 'required:donvi',
            'MoTaDV' => 'required',
            'id_PB' => 'required',
        ],
        [
           
            'TenDV.required' => 'Tên Đơn Vị Phải Có',
            'MoTaDV.required' => 'Mô Tả Đơn Vị Phải Có',
           'id_PB.required' => ' Đơn Vị Này Thuộc Phòng Ban Nào Phải Có',
            
        ]);
        $donvi = DonVi::find($id);
        $donvi->TenDV = $data['TenDV'];
        $donvi->slug = str::slug($data['TenDV']);
        $donvi->MoTaDV = $data['MoTaDV'];
        $donvi->id_PB = $data['id_PB'];
        $donvi->TrangThai = $request->TrangThai;
        $donvi->save();
        toastr()->success('Cập Nhật Đơn Vị Thành Công','Thành Công');
        return redirect()->route('don-vi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->session_login();
        $donvi = DonVi::find($id);
        $donvi->delete();
        toastr()->success('Xóa Đơn Vị Thành Công','Thành Công');
        return redirect()->route('don-vi.index');
    }
}
