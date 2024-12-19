<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

use App\Models\Nhom;
use App\Models\TaiKhoan;
use App\Models\ChuKySo;




class ChuKySoController extends Controller
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
        $chukyso = ChuKySo::with('taikhoan')->orderBy('id','DESC')->get();
        $taikhoan = TaiKhoan::with('nhom')->with('chucvu')->orderBy('id_TK','DESC')->get();
        
        return view('manager.chukyso.list', compact('chukyso','taikhoan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        $nhom = Nhom::orderBy('id','ASC')->get();
        return view('manager.chukyso.create', compact('nhom'));
    }
    public function select_ca_nhan(Request $request){
        $data = $request->all();

        // Kiểm tra xem 'action' có tồn tại
        if ($data['action']) {
            $output = '';

            // Nếu action là "donvi"
            if ($data['action'] == "donvi") {
                // Thay thế 'canhan' bằng 'donvi' trong điều kiện truy vấn
                // Giả sử rằng bạn muốn lấy danh sách tài khoản dựa trên 'id_Gr' (được gán giá trị từ 'donvi')
                $select_taikhoan = TaiKhoan::where('id_Gr', $data['donvi'])->orderby('id_TK', 'ASC')->get();
                $output = '<option>-----Chọn Cá Nhân-----</option>';

                // Tạo danh sách các cá nhân
                foreach ($select_taikhoan as $key => $tk) {
                    $output .= '<option value="' . $tk->id_TK . '">' . $tk->HoTen . '</option>';
                }
            }

            // Trả về output để cập nhật trong select box
            return response()->json($output);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $chuky = ChuKySo::all();
        foreach($chuky as $ck){
            if($ck->id_TK == $request->canhan){
                toastr()->warning('Người Dùng Này Đã Được Cấp Chữ Ký Số','Thất Bại');
                return redirect()->route('chu-ky-so.index');
            }
        }
        
        // Tạo khóa RSA (2048 bit)
        $keyPair = RSA::createKey(2048);
         // Khóa công khai và khóa bí mật
         $publicKey = $keyPair->getPublicKey()->toString('PKCS1');
         $privateKey = $keyPair->toString('PKCS1');
         $chukyso = new ChuKySo();
         $chukyso->id_TK = $request->canhan;
         $chukyso->TrangThai = 1;
         $chukyso->NgayKy =  Carbon::now('Asia/Ho_Chi_Minh');
         //khoa cong khai
         $chukyso->public_Key = $publicKey;
         $chukyso->save();
        
         $taikhoan = TaiKhoan::find( $request->canhan);
         $taikhoan->chu_ky_so = 1;
         $taikhoan->save();
         // Lưu khóa bí mật vào file bảo mật hoặc sử dụng mã hóa để lưu trữ
         $encryptedPrivateKey = Crypt::encryptString($privateKey);
         Storage::put('private_keys/'.$request->canhan.'_private.key', $encryptedPrivateKey);
         toastr()->success('Cấp Chữ Ký Số Thành Công','Thành Công');
        return redirect()->route('chu-ky-so.index');
    }

    public function khoa(string $id){
        $chukyso = ChuKySo::find($id);
       
        
        $chukyso->TrangThai = 0;
        $chukyso->save();
        $taikhoan = Taikhoan::find($chukyso->id_TK);
        $taikhoan->chu_ky_so = 0;
        $taikhoan->save();
        toastr()->success('Khóa Người Dùng Thành Công','Thành Công');
        return redirect()->route('chu-ky-so.index');
    }

    public function bo_khoa(string $id){
        $chukyso = ChuKySo::find($id);
        $chukyso->TrangThai = 1;
        $chukyso->save();

        $taikhoan = Taikhoan::find($chukyso->id_TK);
        $taikhoan->chu_ky_so = 1;
        $taikhoan->save();
        toastr()->success('Hủy Khóa Người Dùng Thành Công','Thành Công');
        return redirect()->route('chu-ky-so.index');
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
        return view('manager.chukyso.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->session_login();
        $chukyso = ChuKySo::find($id);
      
        
        // Xóa file chứa khóa bí mật
        $privateKeyPath = 'private_keys/' . $chukyso->id_TK . '_private.key';
        if (Storage::exists($privateKeyPath)) {
            Storage::delete($privateKeyPath);
        }

        // Xóa bản ghi chữ ký số
        $chukyso->delete();
        toastr()->success('Xóa Chữ Ký Số Thành Công');
        return redirect()->route('chu-ky-so.index');
    }
}
