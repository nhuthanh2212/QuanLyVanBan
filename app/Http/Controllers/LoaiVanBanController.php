<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\LoaiVanBan;

use App\Models\Nhom;
use App\Models\PhongBan;
use App\Models\DonVi;
use App\Models\Phong;
use App\Models\Nganh;
use App\Models\ChuyenNganh;
use App\Models\LVBTheoDVHB;

use App\Models\BH_PB;
use App\Models\BH_P;
use App\Models\BH_DV;
use App\Models\BH_N;
use App\Models\BH_CN;

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
        // Tách chuỗi thành các từ
        $words = explode(' ', $data['TenLVB']);
        // Lấy ký tự đầu tiên của mỗi từ
        $initials = array_map(function($word) {
            return mb_substr($word, 0, 1);
        }, $words);

        $loaivanban = new LoaiVanBan();
        $loaivanban->TenLVB = $data['TenLVB'];
        $loaivanban->MoTaLVB = $data['MoTaLVB'];
        $loaivanban->TrangThai = 1;
        $loaivanban->ky_tu = implode('', $initials);
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
         // Tách chuỗi thành các từ
         $words = explode(' ', $data['TenLVB']);
         // Lấy ký tự đầu tiên của mỗi từ
         $initials = array_map(function($word) {
             return mb_substr($word, 0, 1);
         }, $words);
        $loaivanban = LoaiVanBan::find($id);
        $loaivanban->TenLVB = $data['TenLVB'];
        $loaivanban->MoTaLVB = $data['MoTaLVB'];
        $loaivanban->ky_tu = implode('', $initials);
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

    //noi nhan theo loai van ban
    public function nhan_theo_loaiVB(){
        $loaivanban = LoaiVanBan::where('TrangThai',1)->orderBy('id_LVB','ASC')->get();
        $nhom = Nhom::orderBy('id','DESC')->get();
        $nhan = LVBTheoDVHB::with('nhom')->orderBy('id','DESC')->get();
        
        $bh_pb = BH_PB::orderBy('id','ASC')->get();
        $bh_dv = BH_DV::orderBy('id','ASC')->get();
        $bh_p = BH_p::orderBy('id','ASC')->get();
        $bh_n = BH_N::orderBy('id','ASC')->get();
        $bh_cn = BH_CN::orderBy('id','ASC')->get();
        $phongban = PhongBan::orderBy('id','ASC')->get();
        $donvi = DonVi::orderBy('id','ASC')->get();
        $phong = Phong::orderBy('id','ASC')->get();
        $nganh = Nganh::orderBy('id','ASC')->get();
        $chuyennganh = ChuyenNganh::orderBy('id','ASC')->get();

        
        return view('manager.noinhantheoLVB.list' ,compact('loaivanban','nhom','nhan','bh_pb','bh_dv','bh_p','bh_n','bh_cn','phongban','donvi','phong','nganh','chuyennganh'));
    }

    public function createe(){
        $loaivanban = LoaiVanBan::where('TrangThai', 1)->orderBy('id_LVB','ASC')->get();
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
        $nhantheolvb = LVBTheoDVHB::orderBy('id','ASC')->get();

        if($request->has('id_pb') || $request->has('id_dv') || $request->has('id_p') || $request->has('id_n') || $request->has('id_cn')){
            foreach($nhantheolvb as $nhantheo){
                if($nhantheo->id_LVB == $data['id_LVB'] && $nhantheo->id_Gr == $data['id_Gr']){
                    toastr()->warning('Loại Văn Bản Thuộc Đơn Vị Ban Hành Này Đã Được Tạo Nơi Nhận Rồi Vui Lòng Chọn Lại!','Thất Bại');
                    return redirect()->back();
                }
               
            }
            $nhan = new LVBTheoDVHB();
            $nhan->id_LVB = $data['id_LVB'];
            $nhan->id_Gr = $data['id_Gr'];
        

            
            $nhan->save();
        }
        else{
            toastr()->error('Tạo Nợi Nhận Không Thành Công, Chưa Chọn Nơi Nhận. Vui Lòng Chọn Nơi Nhận!','Thất Bại');
            return redirect()->back();
        }
        
       // Gán nơi đến (nhiều checkbox đã chọn)
       if ($request->has('id_pb')) {
        // Gán id_DV từ request vào cột id_Den của bảng pivot
            foreach($request->id_pb as $id_pb) {
                $nhan->nhantheolvb()->attach($id_pb); // Cột đúng là id_Den trong bảng noiden
            }
        }
        // Attach 'id_dv' to nhantheolvb table
        if ($request->has('id_dv')) {
            foreach($request->id_dv as $id_dv) {
                $nhan->nhandonvitheolvb()->attach($id_dv); // Cột đúng là id_Den trong bảng noiden
            }
        }
        
        if ($request->has('id_p')) {
            foreach($request->id_p as $id_p) {
                $nhan->nhanphongtheolvb()->attach($id_p); // Cột đúng là id_Den trong bảng noiden
            }
        }
        
        if ($request->has('id_n')) {
            foreach($request->id_n as $id_n) {
                $nhan->nhannganhtheolvb()->attach($id_n); // Cột đúng là id_Den trong bảng noiden
            }
        }
        
        if ($request->has('id_cn')) {
            foreach($request->id_cn as $id_cn) {
                $nhan->nhanchuyennganhtheolvb()->attach($id_cn); // Cột đúng là id_Den trong bảng noiden
            }
        }
        toastr()->success('Tạo Nơi Nhận Của Loại Văn Bản Theo Nơi Ban Hành Thành Công','Thành Công');
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
        $nhan = LVBTheoDVHB::with('nhom')->find($id);
        $nhanpb = BH_PB::where('id_BH_LVB',$nhan->id)->pluck('id_PB')->toArray();
        $nhandv = BH_DV::where('id_BH_LVB',$nhan->id)->pluck('id_DV')->toArray();
        $nhanp = BH_P::where('id_BH_LVB',$nhan->id)->pluck('id_P')->toArray();
        $nhannganh = BH_N::where('id_BH_LVB',$nhan->id)->pluck('id_N')->toArray();
        $nhanchuyennganh = BH_CN::where('id_BH_LVB',$nhan->id)->pluck('id_CN')->toArray();
        // dd($noinhan);
     

        return view('manager.noinhantheoLVB.edit', compact(
            'loaivanban', 'nhom', 'phongban', 'donvi', 'phong', 'nganh', 'chuyennganh', 
            'nhan', 'nhanpb','nhandv','nhanp','nhannganh','nhanchuyennganh'
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
        if ($request->has('id_pb')) {
            $nhan->nhantheolvb()->sync($request->id_pb); // Sync the array of phongban slugs
        } else {
            // If no checkboxes are selected, detach all related phongban
            $nhan->nhantheolvb()->sync([]); // Detach all relationships
        }
    
        // Repeat for other relationships as needed (donvi, phong, nganh, chuyennganh)
        if ($request->has('id_dv')) {
            $nhan->nhandonvitheolvb()->sync($request->id_dv);
        } else {
            $nhan->nhandonvitheolvb()->sync([]);
        }
    
        if ($request->has('id_p')) {
            $nhan->nhanphongtheolvb()->sync($request->id_p);
        } else {
            $nhan->nhanphongtheolvb()->sync([]);
        }
    
        if ($request->has('id_n')) {
            $nhan->nhannganhtheolvb()->sync($request->id_n);
        } else {
            $nhan->nhannganhtheolvb()->sync([]);
        }
    
        if ($request->has('id_cn')) {
            $nhan->nhanchuyennganhtheolvb()->sync($request->id_cn);
        } else {
            $nhan->nhanchuyennganhtheolvb()->sync([]);
        }

        toastr()->success('Cập Nhật Nơi Nhận Của Loại Văn Bản Theo Nơi Ban Hành Thành Công','Thành Công');
        return redirect()->to('manager/noi-nhan-loai-van-ban');
    }

    public function delete(string $id){
        $noinhan = LVBTheoDVHB::find($id);
        $noinhan->nhantheolvb()->detach();  // Bảng liên quan với Phongban
        $noinhan->nhandonvitheolvb()->detach(); // Bảng liên quan với DonVi
        $noinhan->nhanphongtheolvb()->detach(); // Bảng liên quan với Phong
        $noinhan->nhannganhtheolvb()->detach(); // Bảng liên quan với Nganh
        $noinhan->nhanchuyennganhtheolvb()->detach(); // Bảng liên quan với ChuyenNganh
        $noinhan->delete();
        toastr()->success('Xóa Nơi Nhận Của Loại Văn Bản Theo Nơi Ban Hành Thành Công','Thành Công');
        return redirect()->to('manager/noi-nhan-loai-van-ban');
    }
}
