<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\PhucVu;

class PhucVuController extends Controller
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
        $phucvu = PhucVu::orderBy('id','ASC')->get();
        return view('manager.phucvu.list',compact('phucvu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        return view('manager.phucvu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenPPV' => 'required|unique:phucvu',
            'MoTaPPV' => 'required',
           
        ],
        [
            'TenPPV.unique' => 'Tên phòng này đã có, vui lòng điền tên khác',
            'TenPPV.required' => 'Tên phòng Phải Có',
            'MoTaPPV.required' => 'Mô tả phòng Phải Có',
           
            
        ]);
        $phucvu = new PhucVu();
        $phucvu->TenPPV = $data['TenPPV'];
        $phucvu->MoTaPPV = $data['MoTaPPV'];
        $phucvu->TrangThai = 1;
        $phucvu->save();
        toastr()->success('Thêm Phòng Thành Công');
        return redirect()->route('phuc-vu.index');
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
        $phucvu = PhucVu::find($id);
        return view('manager.phucvu.edit', compact('phucvu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenPPV' => 'required:phucvu',
            'MoTaPPV' => 'required',
           
        ],
        [

            'TenPPV.required' => 'Tên phòng Phải Có',
            'MoTaPPV.required' => 'Mô tả phòng Phải Có',
           
            
        ]);
        $phucvu = PhucVu::find($id);
        $phucvu->TenPPV = $data['TenPPV'];
        $phucvu->MoTaPPV = $data['MoTaPPV'];
        $phucvu->TrangThai = $request->TrangThai;
        $phucvu->save();
        toastr()->success('Cập Nhật Phòng Thành Công');
        return redirect()->route('phuc-vu.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $phucvu = PhucVu::find($id);
        $phucvu->delete();
        toastr()->success('Xóa Phòng Thành Công');
        return redirect()->route('phuc-vu.index');
    }
}
