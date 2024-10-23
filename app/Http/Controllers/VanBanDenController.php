<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Carbon\Carbon;

use App\Models\LoaiVanBan;
use App\Models\Nhom;
use App\Models\VanBanDen;

class VanBanDenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        $vanbanden = VanBanDen::orderBy('id','DESC')->get();
        foreach ($vanbanden as $vb) {
            // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
            $ngayNhan = Carbon::parse($vb->NgayNhan);

            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = $ngayNhan->greaterThanOrEqualTo(Carbon::now()->subDays(3));
                }
        return view('vanban.vanbanden.list',compact('theloai','vanbanden','nhom'));
    }


    public function loc()
    {
        $loaivanban = $_GET['loaivanban'];
        $SoHieu = $_GET['SoHieu'];
        // If no filter is selected
        if (empty($loaivanban) && empty($SoHieu)) {
            toastr()->warning('Vui Lòng Chọn Dữ Liệu Muốn Lọc', 'Không Có Dữ Liệu Lọc');
            return redirect()->back();
        }

        // Filter data based on input
        $query = VanBanDen::query();
        
        if (!empty($loaivanban)) {
            $query->where('id_LVB', $loaivanban);
        }
        
        if (!empty($SoHieu)) {
            $query->where('SoHieu', $SoHieu);
        }

        $vanbanden = $query->orderBy('id', 'DESC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB', 'ASC')->get();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        foreach ($vanbanden as $vb) {
            // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
            $ngayNhan = Carbon::parse($vb->NgayNhan);

            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = $ngayNhan->greaterThanOrEqualTo(Carbon::now()->subDays(3));
                }
        // Return the same view with the filtered data
        return view('vanban.vanbanden.list', compact('vanbanden', 'theloai','nhom'));
    }

    public function loc_chi_tiet(){
        $theloai = LoaiVanBan::orderBy('id_LVB', 'ASC')->get();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $loaivanban = $_GET['loaivanban'];
        $donvi = $_GET['donvibanhanh'];
        $tungay = $_GET['tungay'];
        $denngay = $_GET['denngay'];
        if(empty($loaivanban) ){
            toastr()->warning('Vui Lòng Chọn Loại Văn Bản', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-den.index');
        }
        if(empty($nhom) ){
            toastr()->warning('Vui Lòng Chọn Đơn Vị Ban Hành', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-den.index');
        }
        if(empty($tungay) ){
            toastr()->warning('Vui Lòng Chọn Thời Gian Đi', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-den.index');
        }
        if(empty($denngay) ){
            toastr()->warning('Vui Lòng Chọn Thời Gian Đến', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-den.index');
        }
        // Check if the date fields are provided and convert the format
        if (!empty($tungay)) {
            $tungay = Carbon::createFromFormat('d/m/Y', $tungay)->startOfDay(); // Convert to Y-m-d and set to start of the day
        }

        if (!empty($denngay)) {
            $denngay = Carbon::createFromFormat('d/m/Y', $denngay)->endOfDay(); // Convert to Y-m-d and set to end of the day
        }
        
        if (empty($loaivanban) && empty($donvi) && empty($tungay) && empty($denngay)) {
            toastr()->warning('Vui Lòng Nhập Đầy Đủ Dữ Liệu Muốn Lọc', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-den.index');
        }
        $vanbanden = VanBanDen::whereBetween('NgayNhan',[$tungay,$denngay])->where('id_LVB',$loaivanban)->where('id_Gr',$donvi)->orderBy('id','DESC')->get();
        foreach ($vanbanden as $vb) {
            // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
            $ngayNhan = Carbon::parse($vb->NgayNhan);

            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = $ngayNhan->greaterThanOrEqualTo(Carbon::now()->subDays(3));
                }
        return view('vanban.vanbanden.loc', compact('vanbanden','theloai','nhom'));
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
    // xóa 1 hoac nhieu van ban
    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');
    
        if (empty($ids)) {
            return response()->json(['message' => 'Không Có Văn Bản Được Chọn.'], 400);
        }

        // Retrieve the records to delete their files and detach relationships
        $vanBanDenList = VanBanDen::whereIn('id', $ids)->get();

        foreach ($vanBanDenList as $vanBanDen) {
            // Delete the associated file if it exists
            $path_unlink = 'uploads/vanbanden/' . $vanBanDen->file;
            if (file_exists(public_path($path_unlink))) {
                unlink(public_path($path_unlink));
            }

            // Detach related relationships
            $vanBanDen->denphongban()->detach($vanBanDen->id_pb); 
            $vanBanDen->dendonvi()->detach($vanBanDen->id_dv);
            $vanBanDen->denphong()->detach($vanBanDen->id_p);
            $vanBanDen->dennganh()->detach($vanBanDen->id_n);
            $vanBanDen->denchuyennganh()->detach($vanBanDen->id_cn);

            // Delete the VanBanDi record
            $vanBanDen->delete();
        }

        // Show success message
        toastr()->success('Xóa Văn Bản Thành Công');
        
        return redirect()->route('van-ban-den.index');
    }
}
