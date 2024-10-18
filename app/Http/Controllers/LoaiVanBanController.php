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
use App\Models\LVBTheoDVHB;

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
        $nhan = LVBTheoDVHB::find(8);
        return view('manager.noinhantheoLVB.list' ,compact('loaivanban','nhom','nhan'));
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
            
        ],
        [
            'id_Gr.required' => 'Đơn Vị Ban Hành Phải Có',
            'id_LVB.required' => 'Loai Văn Bản Phải Có',
            
        ]);
        $nhan = new LVBTheoDVHB();
        $nhan->id_LVB = $data['id_LVB'];
        $nhan->id_Gr = $data['id_Gr'];
      

        
        $nhan->save();
       // Gán nơi đến (nhiều checkbox đã chọn)
       if ($request->has('slug_pb')) {
        // Gán id_DV từ request vào cột id_Den của bảng pivot
            foreach($request->slug_pb as $slug_pb) {
                $nhan->nhantheolvb()->attach($slug_pb); // Cột đúng là id_Den trong bảng noiden
            }
        }
        // Attach 'id_dv' to nhantheolvb table
        if ($request->has('slug_dv')) {
            foreach($request->slug_dv as $slug_dv) {
                $nhan->nhandonvitheolvb()->attach($slug_dv); // Cột đúng là id_Den trong bảng noiden
            }
        }
        
        if ($request->has('slug_p')) {
            foreach($request->slug_p as $slug_p) {
                $nhan->nhanphongtheolvb()->attach($slug_p); // Cột đúng là id_Den trong bảng noiden
            }
        }
        
        if ($request->has('slug_n')) {
            foreach($request->slug_n as $slug_n) {
                $nhan->nhannganhtheolvb()->attach($slug_n); // Cột đúng là id_Den trong bảng noiden
            }
        }
        
        if ($request->has('slug_cn')) {
            foreach($request->slug_cn as $slug_cn) {
                $nhan->nhanchuyennganhtheolvb()->attach($slug_cn); // Cột đúng là id_Den trong bảng noiden
            }
        }
        toastr()->success('Tạo Nơi Nhận Của Loại Văn Bản Theo Nơi Ban Hành Thành Công');
        return redirect()->to('manager/noi-nhan-loai-van-ban');

    }
    /**
     * Show the form for editing the specified resource.
     */

     public function edite(String $id){
        // Retrieve associated records
        $loaivanban = LoaiVanBan::orderBy('id_LVB', 'DESC')->get();
        $nhom = Nhom::orderBy('id', 'DESC')->get();
        $phongban = PhongBan::orderBy('id', 'ASC')->get();
        $donvi = DonVi::orderBy('id', 'ASC')->get();
        $phong = Phong::orderBy('id', 'ASC')->get();
        $nganh = Nganh::orderBy('id', 'ASC')->get();
        $chuyennganh = ChuyenNganh::orderBy('id', 'ASC')->get();
        
        // Find the specific LVBTheoDVHB record
        $nhan = LVBTheoDVHB::find($id);
        $noinhan = NhanTheoLVB::where('id_BH_LVB',$nhan->id)->pluck('noi_nhan')->toArray();
        // dd($noinhan);
     

        return view('manager.noinhantheoLVB.edit', compact(
            'loaivanban', 'nhom', 'phongban', 'donvi', 'phong', 'nganh', 'chuyennganh', 
            'nhan', 'noinhan'
        ));
    }
    public function updatee(Request $request, string $id){
        $data = $request->validate([
           
            'id_LVB' => 'required',
            'id_Gr' => 'required',
            
        ],
        [
            'id_Gr.required' => 'Đơn Vị Ban Hành Phải Có',
            'id_LVB.required' => 'Loai Văn Bản Phải Có',
            
        ]);
        $nhan = LVBTheoDVHB::find($id);
        $nhan->id_LVB = $data['id_LVB'];
        $nhan->id_Gr = $data['id_Gr'];
      

        
        $nhan->save();
        $data = $request->all();
        $noinhan = NhanTheoLVB::where('id_BH_LVB', $nhan->id)->get();
        foreach ($noinhan as $noi) {
            $found = false; // Cờ để kiểm tra xem có bản ghi nào khớp không
        
            
                foreach ($data as $slug_pb) {
                    if ($slug_pb == $noi->noi_nhan) {
                        $found = true; // Tìm thấy bản ghi khớp, ngừng kiểm tra
                        break;
                    }
                }
        
                // Nếu không tìm thấy bản ghi khớp, xóa bản ghi này
                if (!$found) {
                    NhanTheoLVB::where('id', $noi->id)->delete(); // Xóa bản ghi cụ thể theo id
                }
            
        }

        toastr()->success('Cập Nhật Nơi Nhận Của Loại Văn Bản Theo Nơi Ban Hành Thành Công');
        return redirect()->to('manager/noi-nhan-loai-van-ban');
    }

   
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
