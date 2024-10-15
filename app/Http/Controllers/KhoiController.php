<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Khoi;

class KhoiController extends Controller
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
        $khoi = Khoi::orderBy('id','ASC')->get();
        return view('manager.khoi.list', compact('khoi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        return view('manager.khoi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'TenK' => 'required|unique:khoi',
            'MoTaK' => 'required',
           
        ],
        [
            'TenK.unique' => 'Tên Khối này đã có, vui lòng điền tên khác',
            'TenK.required' => 'Tên Khối Phải Có',
            'MoTaK.required' => 'Mô tả Khối Phải Có',
           
            
        ]);
        $khoi = new Khoi();
        $khoi->TenK = $data['TenK'];
        $khoi->slug = Str::slug($data['TenK']);
        $khoi->MoTaK = $data['MoTaK'];
        $khoi->TrangThai = 1;
        $khoi->save();
        toastr()->success('Thêm Khối Thành Công');
        return redirect()->route('khoi.index');
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
        $khoi = Khoi::find($id);
        return view('manager.khoi.edit', compact('khoi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenK' => 'required:khoi',
            'MoTaK' => 'required',
           
        ],
        [
           
            'TenK.required' => 'Tên Khối Phải Có',
            'MoTaK.required' => 'Mô tả Khối Phải Có',
           
            
        ]);
        $khoi = Khoi::find($id);
        $khoi->TenK = $data['TenK'];
        $khoi->slug = Str::slug($data['TenK']);
        $khoi->MoTaK = $data['MoTaK'];
        $khoi->TrangThai = $request->TrangThai;
        $khoi->save();
        toastr()->success('Cập Nhật Khối Thành Công');
        return redirect()->route('khoi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $khoi = Khoi::find($id);
        $khoi->delete();
        toastr()->success('Xóa Khối Thành Công');
        return redirect()->route('khoi.index');
    }
}
