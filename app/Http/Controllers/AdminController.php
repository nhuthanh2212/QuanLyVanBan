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
        return view('login_manager');
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
            Session::put('name',$dangnhap->HoTen);
            Session::put('id',$dangnhap->id_TK);
            // Nếu đúng mật khẩu MD5
            toastr()->success('Đăng Nhập Thành Công');
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
        toastr()->success('Đăng Xuất Thành Công');
        return redirect('login-manager');
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
