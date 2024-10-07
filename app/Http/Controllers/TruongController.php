<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Truong;

class TruongController extends Controller
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
        $truong = Truong::orderBy('id','ASC')->get();
        return view('manager.truong.list', compact('truong'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        return view('manager.truong.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenTruong' => 'required|unique:truong',
            'MoTaTruong' => 'required',
           
        ],
        [
            'TenTruong.unique' => 'Tên truòng này đã có, vui lòng điền tên khác',
            'TenTruong.required' => 'Tên trường Phải Có',
            'MoTaTruong.required' => 'Mô tả trường Phải Có',
           
            
        ]);
        $truong = new Truong();
        $truong->TenTruong = $data['TenTruong'];
        $truong->MoTaTruong = $data['MoTaTruong'];
        $truong->TrangThai = 1;
        $truong->save();
        toastr()->success('Thêm Truòng Thành Công');
        return redirect()->route('truong.index');
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
        $truong = Truong::find($id);
        return view('manager.truong.edit', compact('truong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenTruong' => 'required',
            'MoTaTruong' => 'required',
           
        ],
        [
            
            'TenTruong.required' => 'Tên trường Phải Có',
            'MoTaTruong.required' => 'Mô tả trường Phải Có',
           
            
        ]);
        $truong =  Truong::find($id);
        $truong->TenTruong = $data['TenTruong'];
        $truong->MoTaTruong = $data['MoTaTruong'];
        $truong->TrangThai = $request->TrangThai;
        $truong->save();
        toastr()->success('Cập Nhật Truòng Thành Công');
        return redirect()->route('truong.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $truong = Truong::find($id);
        $truong->delete();
        toastr()->success('Xóa Truòng Thành Công');
        return redirect()->route('truong.index');
    }
}
