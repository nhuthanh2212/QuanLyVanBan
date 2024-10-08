<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\LoaiVanBan;
use App\Models\VanBanDi;
use App\Models\DonViCapCao;
use App\Models\Truong;
use App\Models\TrungTam;
use App\Models\HanhChinh;
use App\Models\PhucVu;
use App\Models\ToChuc;
use App\Models\Khoa;
use App\Models\TaiKhoan;

class VanBanDiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $theloai = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        $vanbandi = VanBanDi::orderBy('id','DESC')->get();
        return view('vanban.vanbandi.list',compact('theloai','vanbandi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $loaivanban = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        $donvicapcao = DonViCapCao::orderBy('id_DV','ASC')->get();
        $truong = Truong::orderBy('id','ASC')->get();
        $trungtam = TrungTam::orderBy('id','ASC')->get();
        $hanhchinh = HanhChinh::orderBy('id','ASC')->get();
        $phucvu = PhucVu::orderBy('id','ASC')->get();
        $tochuc = ToChuc::orderBy('id','ASC')->get();
        $khoa = Khoa::orderBy('id','ASC')->get();
        
        return view('vanban.vanbandi.create',compact('loaivanban','donvicapcao','truong','trungtam','hanhchinh','phucvu','tochuc','khoa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function loc()
    {
        $loaivanban = $_GET['loaivanban'];
        $Ngay = $_GET['ngay'];
        // If no filter is selected
        if (empty($loaivanban) && empty($Ngay)) {
            toastr()->warning('Vui Lòng Chọn Dữ Liệu Muốn Lọc', 'Không Có Dữ Liệu Lọc');
            return redirect()->back();
        }

        // Filter data based on input
        $query = VanBanDi::query();
        
        if (!empty($loaivanban)) {
            $query->where('id_LVB', $loaivanban);
        }
        
        if (!empty($Ngay)) {
            $query->where('NgayGui', $Ngay);
        }

        $vanbandi = $query->orderBy('id', 'DESC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB', 'ASC')->get();

        // Return the same view with the filtered data
        return view('vanban.vanbandi.list', compact('vanbandi', 'theloai'));
    }
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
