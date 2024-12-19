<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use App\Models\Nganh;
use App\Models\Phong;

class NganhController extends Controller
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
        $nganh = Nganh::with('phong')->orderBy('id','DESC')->get();
        return view('manager.nganh.list', compact('nganh'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        $phong = Phong::where('TrangThai',1)->orderBy('id','ASC')->get();
        return view('manager.nganh.create',compact('phong'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenN' => 'required|unique:nganh',
            'MoTaN' => 'required',
            'id_P' => 'required',
        ],
        [
            'TenN.unique' => 'Tên ngành này đã có, vui lòng điền tên khác',
            'TenN.required' => 'Tên Ngành Phải Có',
            'MoTaN.required' => 'Mô Tả Ngành Phải Có',
           'id_P.required' => ' Ngành Này Thuộc Phòng Nào Phải Có',
            
        ]);
        $nganh = new Nganh();
        $nganh->TenN = $data['TenN'];
        $nganh->slug = str::slug($data['TenN']);
        $nganh->MoTaN = $data['MoTaN'];
        $nganh->id_P = $data['id_P'];
        $nganh->TrangThai = 1;
        $nganh->save();
        toastr()->success('Thêm Ngành Thành Công','Thành Công');
        return redirect()->route('nganh.index');
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
        $phong = Phong::where('TrangThai',1)->orderBy('id','ASC')->get();
        $nganh = Nganh::find($id);
        return view('manager.nganh.edit',compact('nganh','phong'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenN' => 'required:nganh',
            'MoTaN' => 'required',
            'id_P' => 'required',
        ],
        [
           
            'TenN.required' => 'Tên Ngành Phải Có',
            'MoTaN.required' => 'Mô Tả Ngành Phải Có',
           'id_P.required' => ' Ngành Này Thuộc Phòng Nào Phải Có',
            
        ]);
        $nganh =  Nganh::find($id);
        $nganh->TenN = $data['TenN'];
        $nganh->slug = str::slug($data['TenN']);
        $nganh->MoTaN = $data['MoTaN'];
        $nganh->id_P = $data['id_P'];
        $nganh->TrangThai = $request->TrangThai;
        $nganh->save();
        toastr()->success('Cập Nhật Ngành Thành Công','Thành Công');
        return redirect()->route('nganh.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->session_login();
        $nganh = Nganh::find($id);
        $nganh->delete();
        toastr()->success('Xóa Ngành Thành Công','Thành Công');
        return redirect()->route('nganh.index');
    }
}
