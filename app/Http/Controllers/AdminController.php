<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\TaiKhoan;


class AdminController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        return view('login.login');
    }

    public function dangnhap(Request $request){
      
        $data = $request->validate([
            'TenDN' => 'required',
            'password' => 'required',
           
        ],
        [
            
            'TenDN.required' => 'Tên Đăng Nhập Phải Có',
            'password.required' => 'Mật Khẩu Đăng Nhập Phải Có',
           
            
        ]);
        $dangnhap = TaiKhoan::where('TenDN', $data['TenDN'])->first();

        if($dangnhap && md5($data['password']) === $dangnhap->password) {
            Auth::login($dangnhap);
            Session::put('name',$dangnhap->HoTen);
            Session::put('id',$dangnhap->id_TK);
            // Nếu đúng mật khẩu MD5
            toastr()->success('Đăng Nhập Thành Công','Thành Công');
            return redirect::to('/home');
        }
        else
        {
            Session::put('message','Tên Đăng Nhập Hoặc Mặt Khẩu Bị Sai Vui Lòng Nhập Lại! ');
            toastr()->error('Đăng Nhập Thất Bại');
            return redirect::to('/login-manager');
        }
        
    }
    public function logout(){
        Session::put('name',null);
        Session::put('id',null);
        toastr()->success('Đăng Xuất Thành Công','Thành Công');
        return redirect('login-manager');
    }

    public function forgot_password(){
        return view('login.forgot_password');
    }

    public function forgot(Request $request){
        $data = $request->validate([
            'TenDN' => 'required',
            'DienThoai' => 'required',
           
        ],
        [
            
            'TenDN.required' => 'Tên Đăng Nhập Phải Có',
            'DienThoai.required' => 'Số Điện Thoại Phải Có',
           
            
        ]);
        
        $forgot = TaiKhoan::where('TenDN',$data['TenDN'])->where('DienThoai',$data['DienThoai'])->first();
        
        if($forgot){
            Session::put('id',$forgot->id_TK);
            toastr()->warning('Vui Lòng Nhập Mật Khẩu Mới','Tài Khoản Hợp Lệ');
            return redirect('/new-password');
        }
        else{
            toastr()->error('Vui Lòng Nhập Lại Tên Đăng Nhập Hoặc Số Điện Thoại','Tài Khoản Không Hợp Lệ');
            return redirect('/forgot-password');
        }

    }
    public function new_password(){
        return view('login.new_password');
    }

    public function password(Request $request){
        $data = $request->validate([
            'password' => 'required',
            'comfirm' => 'required',
           
        ],
        [
            
            'password.required' => 'Mật Khẩu Mới Phải Có',
            'comfirm.required' => 'Xác Nhận Mật Khẩu Phải Có',
           
            
        ]);
       
        if($data['password'] === $data['comfirm']){
            $id = $request->id;
            $taikhoan = TaiKhoan::find($id);
            if ($taikhoan) {
                // Nếu tìm thấy tài khoản, cập nhật mật khẩu
                $taikhoan->password = md5($data['password']);
                $taikhoan->save();
        
                toastr()->success('Tạo Mật Khẩu Mới Thành Công','Thành Công');
                return redirect('/login-manager');
            }
            else{
                toastr()->error('Tài Khoản Không Tồn Tại','Thất Bại ');
                return redirect('/login-manager');
            }
        }
        else{
            toastr()->error('Mật Khẩu Mới Và Xác Nhận Không Đúng Vui Lòng Nhập Lại','Thất Bại');
            return redirect('/login-manager');
        }
    }
    public function index()
    {
        
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
