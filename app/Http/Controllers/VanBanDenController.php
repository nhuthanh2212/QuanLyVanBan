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
use App\Models\TaiKhoan;

use App\Models\Den_PB;
use App\Models\Den_DV;
use App\Models\Den_P;
use App\Models\Den_N;
use App\Models\Den_CN;

class VanBanDenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_TK = Session::get('id');
        $taikhoan = TaiKhoan::where('id_TK',$id_TK)->first();
        $query = VanBanDen::query();

        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB','ASC')->get();

        $chuyennganh = Den_CN::orderBy('id', 'ASC')->get();
        $phongban = Den_PB::orderBy('id', 'ASC')->get();
        $donvi = Den_DV::orderBy('id', 'ASC')->get();
        $phong = Den_P::orderBy('id', 'ASC')->get();
        $nganh = Den_N::orderBy('id', 'ASC')->get();

        // $vanbanden = VanBanDen::with('nhom')->orderBy('id','DESC')->get();
        // foreach ($vanbanden as $vb) {
        //     // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
        //     $ngayNhan = Carbon::parse($vb->NgayNhan);

        //     // Kiểm tra nếu ngày gửi trong vòng 3 ngày
        //     $vb->isNew = $ngayNhan->greaterThanOrEqualTo(Carbon::now()->subDays(3));
        //         }

        foreach ($nhom as $key => $nh) {
            if ($nh->id == $taikhoan->id_Gr) {
                // Kiểm tra các điều kiện và xây dựng truy vấn dựa trên từng trường phòng ban
                if ($nh->id_CN != null) {
                    $query->whereHas('denchuyennganh', function ($q) use ($nh) {
                        $q->where('id_CN', $nh->id_CN);
                    });
                } elseif ($nh->id_N != null) {
                    $query->whereHas('dennganh', function ($q) use ($nh) {
                        $q->where('id_N', $nh->id_N);
                    });
                } elseif ($nh->id_P != null) {
                    $query->whereHas('denphong', function ($q) use ($nh) {
                        $q->where('id_P', $nh->id_P);
                    });
                } elseif ($nh->id_DV != null) {
                    $query->whereHas('dendonvi', function ($q) use ($nh) {
                        $q->where('id_DV', $nh->id_DV);
                    });
                } elseif ($nh->id_PB != null) {
                    $query->whereHas('denphongban', function ($q) use ($nh) {
                        $q->where('id_PB', $nh->id_PB);
                    });
                }
            }
        }
        $vanbanden = $query->orderBy('id', 'DESC')->get();
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


    public function chitiet(string $id){
       
        $vanbanden_chitiet = VanBanDen::where('id',$id)->first();
        
        $nhom = Nhom::orderBy('id','ASC')->get();
        foreach($nhom as $nh){
            if($vanbanden_chitiet->id_Gr == $nh->id){
                $ten = $nh->TenGroup;
            }
        }
        // Tìm vị trí của dấu '-' cuối cùng
        $tim = strrpos($ten, '-');
        // Lấy chuỗi sau dấu '-' cuối cùng
        $tengroup = substr($ten, $tim + 1);
        $theloai = LoaiVanBan::where('id_LVB',$vanbanden_chitiet->id_LVB)->first();
        

        $filePath = 'uploads/vanbanden/' . $vanbanden_chitiet->file;
         // Đường dẫn đến file .docx
         $fullPath = public_path($filePath);
    // dd($fullPath);
    // // Kiểm tra sự tồn tại của file
    
    if (!file_exists($fullPath)) {
        return response()->json(['error' => 'File does not exist.'], 404);
    }
    $fileExtension = pathinfo($fullPath, PATHINFO_EXTENSION);
    $htmlOutput = '';

    if ($fileExtension === 'pdf') {
        // Nếu file là PDF, chỉ cần truyền đường dẫn đến view
        $htmlOutput = '<iframe src="' . asset($filePath) . '" style="width: 100%; height: 600px;"></iframe>';
    } elseif ($fileExtension === 'docx') {
        // Nếu file là DOCX, sử dụng PHPWord để đọc file
        $phpWord = IOFactory::load($fullPath);
        
        // Chuyển đổi thành HTML và lưu vào biến
        ob_start(); // Bắt đầu ghi vào buffer
        $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
        $htmlWriter->save('php://output'); // Ghi nội dung ra buffer
        $htmlOutput = ob_get_clean(); // Lấy nội dung từ buffer và dọn sạch buffer
    } else {
        return response()->json(['error' => 'Unsupported file type.'], 400);
    }
    // if (!file_exists($fullPath)) {
    //     return response()->json(['error' => 'File does not exist.'], 404);
    // }

    // // Sử dụng PHPWord để đọc file
    // $phpWord = IOFactory::load($fullPath);
    
    // // Chuyển đổi thành HTML
    // $htmlWriter = IOFactory::createWriter($phpWord, 'HTML');
    // $htmlFilePath = public_path('uploads/vanbandi/' . pathinfo($filePath, PATHINFO_FILENAME) . '.html');
    // $htmlWriter->save($htmlFilePath);
    // // Chuyển đổi HTML sang PDF
    // $dompdf = new Dompdf();
    // $dompdf->loadHtml(file_get_contents($htmlFilePath));
    // $dompdf->setPaper('A4', 'portrait');
    // $dompdf->render();

        return view('vanban.vanbanden.chitiet', compact('vanbanden_chitiet','theloai','tengroup', 'htmlOutput'));
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
