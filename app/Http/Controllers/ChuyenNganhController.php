<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Models\Nganh;
use App\Models\ChuyenNganh;

class ChuyenNganhController extends Controller
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
        $chuyennganh = ChuyenNganh::orderBy('id','DESC')->get();
        return view('manager.chuyennganh.list', compact('chuyennganh'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        $nganh = Nganh::where('TrangThai', 1)->orderBy('id','ASC')->get();
        return view('manager.chuyennganh.create', compact('nganh'));
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
            'TenCN.unique' => 'Tên Chuyên Ngành này đã có, vui lòng điền tên khác',
            'TenCN.required' => 'Tên Chuyên Ngành Phải Có',
            'MoTaCN.required' => 'Mô Tả Chuyên Ngành Phải Có',
           'id_N.required' => ' Chuyên Ngành Này Thuộc Phòng Nào Phải Có',
            
        ]);
        $chuyennganh = new ChuyenNganh();
        $chuyennganh->TenCN = $data['TenCN'];
        $chuyennganh->slug = str::slug($data['TenCN']);
        $chuyennganh->MoTaCN = $data['MoTaCN'];
        $chuyennganh->id_N = $data['id_N'];
        $chuyennganh->TrangThai = 1;
        $chuyennganh->save();
        toastr()->success('Thêm Chuyên Ngành Thành Công','Thành Công');
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
        $this->session_login();
        $chuyennganh = ChuyenNganh::find($id);
        $nganh = Nganh::where('TrangThai', 1)->orderBy('id','ASC')->get();
        return view('manager.chuyennganh.edit', compact('chuyennganh','nganh'));
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
           'id_N.required' => ' Chuyên Ngành Này Thuộc Phòng Nào Phải Có',
            
        ]);
        $chuyennganh = ChuyenNganh::find($id);
        $chuyennganh->TenCN = $data['TenCN'];
        $chuyennganh->slug = str::slug($data['TenCN']);
        $chuyennganh->MoTaCN = $data['MoTaCN'];
        $chuyennganh->id_N = $data['id_N'];
        $chuyennganh->TrangThai = $request->TrangThai;
        $chuyennganh->save();
        toastr()->success('Cập Nhật Chuyên Ngành Thành Công','Thành Công');
        return redirect()->route('chuyen-nganh.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->session_login();
        $chuyennganh = ChuyenNganh::find($id);
        $chuyennganh->delete();
        toastr()->success('Xóa Chuyên Chuyên Ngành Thành Công','Thành Công');
        return redirect()->route('chuyen-nganh.index');
    }
}
