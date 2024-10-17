<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\LoaiVanBan;
use App\Models\NhanTheoLVB;
use App\Models\Nhom;
use App\Models\PhongBan;
use App\Models\DonVi;
use App\Models\Phong;
use App\Models\Nganh;
use App\Models\ChuyenNganh;

class LoaiVanBanController extends Controller
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
        $loaivanban = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        return view('manager.loaivanban.list',compact('loaivanban'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        return view('manager.loaivanban.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenLVB' => 'required|unique:loaivanban',
            'MoTaLVB' => 'required',
           
        ],
        [
            'TenLVB.unique' => 'Tên loại văn bản này đã có, vui lòng điền tên khác',
            'TenLVB.required' => 'Tên loại văn bản Phải Có',
            'MoTaLVB.required' => 'Mô tả loại văn bản Phải Có',
           
            
        ]);
        $loaivanban = new LoaiVanBan();
        $loaivanban->TenLVB = $data['TenLVB'];
        $loaivanban->MoTaLVB = $data['MoTaLVB'];
        $loaivanban->TrangThai = 1;
        $loaivanban->save();
        toastr()->success('Thêm loại văn bản Thành Công');
        return redirect()->route('loai-van-ban.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    //noi nhan theo loai van ban
    public function nhan_theo_loaiVB(){
        $loaivanban = LoaiVanBan::orderBy('id_LVB','DESC')->get();
        $nhom = Nhom::orderBy('id','DESC')->get();
        return view('manager.noinhantheoLVB.list' ,compact('loaivanban','nhom'));
    }

    public function createe(){
        $loaivanban = LoaiVanBan::orderBy('id_LVB','DESC')->get();
        $nhom = Nhom::orderBy('id','DESC')->get();
        $phongban = PhongBan::orderBy('id','ASC')->get();
        $donvi = DonVi::orderBy('id','ASC')->get();
        $phong = Phong::orderBy('id','ASC')->get();
        $nganh = Nganh::orderBy('id','ASC')->get();
        $chuyennganh = ChuyenNganh::orderBy('id','ASC')->get();
       
        return view('manager.noinhantheoLVB.create' ,compact('loaivanban','nhom','phongban','donvi','phong','nganh','chuyennganh'));
    }
    public function insert(Request $request)
    {
        
        $data = $request->validate([
           
            'id_LVB' => 'required',
            'id_Gr' => 'required',
            'id_D' => 'required|array', // Kiểm tra id_DV là một mảng
        ],
        [
            'id_Gr.required' => 'Đơn Vị Ban Hành Phải Có',
            'id_LVB.required' => 'Loai Văn Bản Phải Có',
            
        ]);
        $nhan = new NhanTheoLVB();
        $nhan->id_LVB = $data['id_LVB'];
        $nhan->id_Gr = $data['id_Gr'];
      

        
        $nhan->save();
       // Gán nơi đến (nhiều checkbox đã chọn)
        if ($request->has('id_D')) {
            // Gán id_DV từ request vào cột id_Den của bảng pivot
            foreach($request->id_D as $id_D) {
                $nhan->noiden()->attach($id_D); // Cột đúng là id_Den trong bảng noiden
            }
        }
        toastr()->success('Tạo Nơi Nhận Của Loại Văn Bản Thành Công');
        return redirect()->back();

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->session_login();
        $loai = LoaiVanBan::find($id);
        return view('manager.loaivanban.edit',compact('loai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenLVB' => 'required:loaivanban',
            'MoTaLVB' => 'required',
           
        ],
        [
            
            'TenLVB.required' => 'Tên loại văn bản Phải Có',
            'MoTaLVB.required' => 'Mô tả loại văn bản Phải Có',
           
            
        ]);
        $loaivanban = LoaiVanBan::find($id);
        $loaivanban->TenLVB = $data['TenLVB'];
        $loaivanban->MoTaLVB = $data['MoTaLVB'];
        $loaivanban->TrangThai = $request->TrangThai;
        $loaivanban->save();
        toastr()->success('Cập nhật loại văn bản Thành Công');
        return redirect()->route('loai-van-ban.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $loai = LoaiVanBan::find($id);
        $loai->delete();
        toastr()->success('Xóa loại văn bản Thành Công');
        return redirect()->route('loai-van-ban.index');
    }
}
