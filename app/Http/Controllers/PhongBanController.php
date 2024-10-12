<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\PhongBan;

class PhongBanController extends Controller
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
        $phongban = PhongBan::orderBy('id','ASC')->get();
        return view('manager.phongban.list', compact('phongban'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        return view('manager.phongban.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'TenPB' => 'required|unique:phongban',
            'MoTaPB' => 'required',
           
        ],
        [
            'TenPB.unique' => 'Tên phòng ban này đã có, vui lòng điền tên khác',
            'TenPB.required' => 'Tên Phòng Ban Phải Có',
            'MoTaPB.required' => 'Mô tả Phòng Ban Phải Có',
           
            
        ]);
        $phongban = new PhongBan();
        $phongban->TenPB = $data['TenPB'];
        $phongban->slug = Str::slug($data['TenPB']);
        $phongban->MoTaPB = $data['MoTaPB'];
        $phongban->TrangThai = 1;
        $phongban->save();
        toastr()->success('Thêm Phòng Ban Thành Công');
        return redirect()->route('phong-ban.index');
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
        $phongban = PhongBan::find($id);
        return view('manager.phongban.edit', compact('phongban'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenPB' => 'required|unique:phongban',
            'MoTaPB' => 'required',
           
        ],
        [
            'TenPB.unique' => 'Tên phòng ban này đã có, vui lòng điền tên khác',
            'TenPB.required' => 'Tên Phòng Ban Phải Có',
            'MoTaPB.required' => 'Mô tả Phòng Ban Phải Có',
           
            
        ]);
        $phongban = PhongBan::find($id);
        $phongban->TenPB = $data['TenPB'];
        $phongban->slug = Str::slug($data['TenPB']);
        $phongban->MoTaPB = $data['MoTaPB'];
        $phongban->TrangThai = $request->TrangThai;
        $phongban->save();
        toastr()->success('Cập Nhật Phòng Ban Thành Công');
        return redirect()->route('phong-ban.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phongban = PhongBan::find($id);
        $phongban->delete();
        toastr()->success('Xóat Phòng Ban Thành Công');
        return redirect()->route('phong-ban.index');
    }
}
