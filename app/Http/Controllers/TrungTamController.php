<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\TrungTam;

class TrungTamController extends Controller
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
        $trungtam = TrungTam::orderBy('id','ASC')->get();
        return view('manager.trungtam.list',compact('trungtam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        return view('manager.trungtam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenTT' => 'required|unique:trungtam',
            'MoTaTT' => 'required',
           
        ],
        [
            'TenTT.unique' => 'Tên trung tâm này đã có, vui lòng điền tên khác',
            'TenTT.required' => 'Tên trung tâm Phải Có',
            'MoTaTT.required' => 'Mô tả trung tâm Phải Có',
           
            
        ]);
        $trungtam = new TrungTam();
        $trungtam->TenTT = $data['TenTT'];
        $trungtam->MoTaTT = $data['MoTaTT'];
        $trungtam->TrangThai = 1;
        $trungtam->save();
        toastr()->success('Thêm Trung Tâm Thành Công');
        return redirect()->route('trung-tam.index');
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
        $trungtam = TrungTam::find($id);
        return view('manager.trungtam.edit', compact('trungtam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenTT' => 'required',
            'MoTaTT' => 'required',
           
        ],
        [
            
            'MoTaTT.required' => 'Mô tả trung tâm Phải Có',
           
            
        ]);
        $trungtam = TrungTam::find($id);
        $trungtam->TenTT = $data['TenTT'];
        $trungtam->MoTaTT = $data['MoTaTT'];
        $trungtam->TrangThai = $request->TrangThai;
        $trungtam->save();
        toastr()->success('Cập Nhật Trung Tâm Thành Công');
        return redirect()->route('trung-tam.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trungtam = TrungTam::find($id);
        $trungtam->delete();
        toastr()->success('Xóa Trung Tâm Thành Công');
        return redirect()->route('trung-tam.index');
    }
}
