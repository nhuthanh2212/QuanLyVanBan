<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use PhpOffice\PhpWord\Settings;
use phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;

use App\Models\LoaiVanBan;
use App\Models\VanBanDi;
use App\Models\Nhom;
use App\Models\PhongBan;
use App\Models\DonVi;
use App\Models\Phong;
use App\Models\Nganh;
use App\Models\ChuyenNganh;
use App\Models\LVBTheoDVHB;
use App\Models\TaiKhoan;
use App\Models\ChuKySo;
use App\Models\VanBanDen;
use App\Models\Statistical;

use App\Models\BH_CN;
use App\Models\BH_PB;
use App\Models\BH_P;
use App\Models\BH_DV;
use App\Models\BH_N;

use App\Models\VB_PB;
use App\Models\VB_DV;
use App\Models\VB_P;
use App\Models\VB_N;
use App\Models\VB_CN;




class VanBanDiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        $vanbandi = VanBanDi::with('taikhoan')->with('nhom')->orderBy('id','DESC')->get();
        foreach ($vanbandi as $vb) {
            // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
            $ngayGui = Carbon::parse($vb->NgayGui);

            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = $ngayGui->greaterThanOrEqualTo(Carbon::now()->subDays(3));
                }
        return view('vanban.vanbandi.list',compact('theloai','vanbandi','nhom'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id = Session::get('id');
        $taikhoan = TaiKhoan::where('id_TK', $id)->first();
        $group = Nhom::orderBy('id','ASC')->get();
       
        $ten = '';
        $id = '';
        foreach($group as $nh){
            if($taikhoan->id_Gr == $nh->id){
                $ten = $nh->TenGroup;
                $id = $nh->id;
            }
        }
        // Tìm vị trí của dấu '-' cuối cùng
        $tim = strrpos($ten, '-');
        // Lấy chuỗi sau dấu '-' cuối cùng
        $tengroup = substr($ten, $tim + 1);

        $loaivanban = LoaiVanBan::where('TrangThai',1)->orderBy('id_LVB','ASC')->get();
        
        $phongban = PhongBan::orderBy('id', 'ASC')->get();
        $donvi = DonVi::orderBy('id', 'ASC')->get();
        $phong = Phong::orderBy('id', 'ASC')->get();
        $nganh = Nganh::orderBy('id', 'ASC')->get();
        $chuyennganh = ChuyenNganh::orderBy('id', 'ASC')->get();
        
                
        return view('vanban.vanbandi.create',compact('loaivanban', 'taikhoan','id', 'phongban', 'donvi', 'phong', 'nganh', 'chuyennganh','tengroup'));
    }

    //check nhung noi duoc gui theo loai văn bản và đon vị ban hanh được tạo trước đó
    public function check_noinhan(Request $request) {
        // Tìm kiếm thông tin theo loại văn bản và đơn vị ban hành
        $phongban = PhongBan::orderBy('id', 'ASC')->get();
        $donvi = DonVi::orderBy('id', 'ASC')->get();
        $phong = Phong::orderBy('id', 'ASC')->get();
        $nganh = Nganh::orderBy('id', 'ASC')->get();
        $chuyennganh = ChuyenNganh::orderBy('id', 'ASC')->get();
        
        $nhan = LVBTheoDVHB::where('id_LVB', $request->id_LVB)
                            ->where('id_Gr', $request->id_Gr)
                            ->first();
        
        if ($nhan) {
            $nhanpb = BH_PB::where('id_BH_LVB',$nhan->id)->pluck('id_PB')->toArray();
            $nhandv = BH_DV::where('id_BH_LVB',$nhan->id)->pluck('id_DV')->toArray();
            $nhanp = BH_P::where('id_BH_LVB',$nhan->id)->pluck('id_P')->toArray();
            $nhannganh = BH_N::where('id_BH_LVB',$nhan->id)->pluck('id_N')->toArray();
            $nhanchuyennganh = BH_CN::where('id_BH_LVB',$nhan->id)->pluck('id_CN')->toArray();
            $output = '<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="checkAlll" class="check-alll"> Chọn Tất Cả</th>
                                </tr>
                                <tr>
                                    <th scope="col"><input type="checkbox" id="checkAlllPhongBan" class="check-alll">Phòng Ban</th>
                                    <th scope="col"><input type="checkbox" id="checkAlllDonVi" class="check-alll">Đơn Vị</th>
                                    <th scope="col"><input type="checkbox" id="checkAlllPhong" class="check-alll">Phòng</th>
                                    <th scope="col"><input type="checkbox" id="checkAlllNganh" class="check-alll">Ngành</th>
                                    <th scope="col"><input type="checkbox" id="checkAlllChuyenNganh" class="check-alll">Chuyên Ngành</th>
                                </tr>
                            </thead>
                            <tbody>';
            
            // Hiển thị danh sách Phòng Ban
            $output .= '<tr><td>';
            foreach ($phongban as $pb) {
                $checked = in_array($pb->id, $nhanpb) ? 'checked' : '';
                $output .= '<label style="font-weight: normal;">
                                <input type="checkbox" class="checkk-phong-ban" value="' . $pb->id . '" name="id_pb[]" ' . $checked . '>
                                ' . $pb->TenPB . '
                            </label><br>';
            }
            $output .= '</td>';
    
            // Hiển thị danh sách Đơn Vị
            $output .= '<td>';
            foreach ($donvi as $dv) {
                $checked = in_array($dv->id, $nhandv) ? 'checked' : '';
                $output .= '<label style="font-weight: normal;">
                                <input type="checkbox" class="checkk-don-vi" value="' . $dv->id . '" name="id_dv[]" ' . $checked . '>
                                ' . $dv->TenDV . '
                            </label><br>';
            }
            $output .= '</td>';

            $output .= '<td>';
            foreach ($phong as $p) {
                $checked = in_array($p->id, $nhanp) ? 'checked' : '';
                $output .= '<label style="font-weight: normal;">
                                <input type="checkbox" class="checkk-phong" value="' . $p->id . '" name="id_p[]" ' . $checked . '>
                                ' . $p->TenP . '
                            </label><br>';
            }
            $output .= '</td>';

            $output .= '<td>';
            foreach ($nganh as $n) {
                $checked = in_array($n->id, $nhannganh) ? 'checked' : '';
                $output .= '<label style="font-weight: normal;">
                                <input type="checkbox" class="checkk-nganh" value="' . $n->id . '" name="id_n[]" ' . $checked . '>
                                ' . $n->TenN . '
                            </label><br>';
            }
            $output .= '</td>';

            $output .= '<td>';
            foreach ($chuyennganh as $cn) {
                $checked = in_array($cn->id, $nhanchuyennganh) ? 'checked' : '';
                $output .= '<label style="font-weight: normal;">
                                <input type="checkbox" class="checkk-chuyen-nganh" value="' . $cn->id . '" name="id_cn[]" ' . $checked . '>
                                ' . $cn->TenCN . '
                            </label><br>';
            }
            $output .= '</td>';
    
            // Hiển thị danh sách Phòng, Ngành, Chuyên Ngành tương tự...
            
            $output .= '</tr></tbody></table>';
    
            return response()->json(['html' => $output]);
        }
    
        return response()->json(['html' => '<p style="color: red;">Loại Văn Bản Này Do Đơn Vị Ban Hành Gửi Chưa Có Nơi Gửi Đến Vui Lòng Cập Nhật Thêm.</p>']);
    }

    public function getNextSoThuTu($id_LVB)
    {
        // Lấy tháng và năm hiện tại
        $currentMonth = Carbon::now()->month; // Tháng hiện tại
        $currentYear = Carbon::now()->year;   // Năm hiện tại

        // Tìm số thứ tự cao nhất của loại văn bản này trong tháng hiện tại
        $maxSoThuTu = VanBanDi::where('id_LVB', $id_LVB)
                            ->whereMonth('NgayGui', $currentMonth)
                            ->whereYear('NgayGui', $currentYear)
                            ->max('tt_lvb');

        // Nếu chưa có bản ghi nào thì bắt đầu từ 1
        $nextSoThuTu = $maxSoThuTu ? $maxSoThuTu + 1 : 1;
        $loaivanban = LoaiVanBan::where('id_LVB',$id_LVB)->first();
        $kytu = $loaivanban->ky_tu;
        // Trả về số thứ tự mới dưới dạng JSON
        return response()->json(['next_so_thu_tu' => $nextSoThuTu, 'ky_tu' => $kytu]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function chitiet(string $id){
       
        $phongban = PhongBan::orderBy('id', 'ASC')->get();
        $donvi = DonVi::orderBy('id', 'ASC')->get();
        $phong = Phong::orderBy('id', 'ASC')->get();
        $nganh = Nganh::orderBy('id', 'ASC')->get();
        $chuyennganh = ChuyenNganh::orderBy('id', 'ASC')->get();

        $vanbandi_chitiet = VanBanDi::where('id',$id)->first();
        
        $nhom = Nhom::orderBy('id','ASC')->get();
        foreach($nhom as $nh){
            if($vanbandi_chitiet->id_Gr == $nh->id){
                $ten = $nh->TenGroup;
            }
        }
        // Tìm vị trí của dấu '-' cuối cùng
        $tim = strrpos($ten, '-');
        // Lấy chuỗi sau dấu '-' cuối cùng
        $tengroup = substr($ten, $tim + 1);
        $theloai = LoaiVanBan::where('id_LVB',$vanbandi_chitiet->id_LVB)->first();
        $vb_pb = VB_PB::where('id_VB' ,$vanbandi_chitiet->id)->get();
        $vb_dv = VB_DV::where('id_VB' ,$vanbandi_chitiet->id)->get();
        $vb_p = VB_P::where('id_VB' ,$vanbandi_chitiet->id)->get();
        $vb_n = VB_N::where('id_VB' ,$vanbandi_chitiet->id)->get();
        $vb_cn = VB_CN::where('id_VB' ,$vanbandi_chitiet->id)->get();

        $fullPath = public_path('uploads/vanbandi/' . $vanbandi_chitiet->file);
        // Cấu hình Dompdf làm PDF renderer
        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
        Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));

        $fileExtension = pathinfo($fullPath, PATHINFO_EXTENSION);
        $htmlOutput = '';

        if ($fileExtension === 'pdf') {
            $htmlOutput = '<iframe src="' . asset('uploads/vanbandi/' . $vanbandi_chitiet->file) . '" style="width: 100%; height: 600px;"></iframe>';
        } elseif ($fileExtension === 'docx') {
            try {
                $phpWord = IOFactory::load($fullPath);
                $pdfPath = public_path('uploads/vanbandi/' . pathinfo($fullPath, PATHINFO_FILENAME) . '.pdf');
                $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
                $pdfWriter->save($pdfPath);

                $htmlOutput = '<iframe src="' . asset('uploads/vanbandi/' . basename($pdfPath)) . '" style="width: 100%; height: 600px;"></iframe>';
                } catch (\Exception $e) {
                    dd('Lỗi xử lý DOCX: ' . $e->getMessage());
                }
            } elseif ($fileExtension === 'txt') {
                $htmlOutput = '<pre>' . htmlspecialchars(file_get_contents($fullPath)) . '</pre>';
            } elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                $htmlOutput = '<img src="' . asset('uploads/vanbandi/' . $vanbandi_chitiet->file) . '" style="width: 100%; height: auto;">';
            } elseif ($fileExtension === 'doc') {
                $url = urlencode(asset('uploads/vanbandi/' . $vanbandi_chitiet->file));
                $htmlOutput = '<iframe src="https://docs.google.com/gview?url=' . $url . '&embedded=true" style="width: 100%; height: 600px;"></iframe>';
            } elseif ($fileExtension === 'xlsx') {
                $url = urlencode(asset('uploads/vanbandi/' . $vanbandi_chitiet->file));
                $htmlOutput = '<iframe src="https://docs.google.com/gview?url=' . $url . '&embedded=true" style="width: 100%; height: 600px;"></iframe>';
            } else {
                return response()->json(['error' => 'Unsupported file type.'], 400);
            }
        return view('vanban.vanbandi.chitiet', compact('vanbandi_chitiet','theloai','tengroup','vb_pb','vb_dv','vb_p','vb_n','vb_cn', 'phongban', 'donvi', 'phong', 'nganh', 'chuyennganh','htmlOutput'));
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
        $query = VanBanDi::query();
        
        if (!empty($loaivanban)) {
            $query->where('id_LVB', $loaivanban);
        }
        
        if (!empty($SoHieu)) {
            $query->where('SoHieu', $SoHieu);
        }

        $vanbandi = $query->orderBy('id', 'DESC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB', 'ASC')->get();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        foreach ($vanbandi as $vb) {
            // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
            $ngayGui = Carbon::parse($vb->NgayGui);

            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = $ngayGui->greaterThanOrEqualTo(Carbon::now()->subDays(3));
                }
        // Return the same view with the filtered data
        return view('vanban.vanbandi.list', compact('vanbandi', 'theloai','nhom'));
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
            return redirect()->route('van-ban-di.index');
        }
        if(empty($nhom) ){
            toastr()->warning('Vui Lòng Chọn Đơn Vị Ban Hành', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-di.index');
        }
        if(empty($tungay) ){
            toastr()->warning('Vui Lòng Chọn Thời Gian Đi', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-di.index');
        }
        if(empty($denngay) ){
            toastr()->warning('Vui Lòng Chọn Thời Gian Đến', 'Thiếu Dữ Liệu Lọc');
            return redirect()->route('van-ban-di.index');
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
            return redirect()->route('van-ban-di.index');
        }
        $vanbandi = VanBanDi::whereBetween('NgayGui',[$tungay,$denngay])->where('id_LVB',$loaivanban)->where('id_Gr',$donvi)->orderBy('id','DESC')->get();
        foreach ($vanbandi as $vb) {
            // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
            $ngayGui = Carbon::parse($vb->NgayGui);

            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = $ngayGui->greaterThanOrEqualTo(Carbon::now()->subDays(3));
                }
        return view('vanban.vanbandi.loc', compact('vanbandi','theloai','nhom'));
    }

    public function store(Request $request)
    {
        $id_TK = Session::get('id');
        $chuKy = TaiKhoan::find($id_TK);
        $public_key = ChuKySo::where('id_TK',$id_TK)->first();
        if($chuKy->chu_ky_so == 1){
            $data = $request->validate([
                'NoiDung' => 'required',
                
                'id_LVB' => 'required',
                'file' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf',  // Chỉ cho phép các định dạng văn bản
                
            ],
            [
                
                'NoiDung.required' => 'Trích Nội Dung Văn Bản Phải Có',
               
                'id_LVB.required' => 'Loai Văn Bản Phải Có',
                'file.required' => 'File Phải Có',
                'file.mimes' => 'File phải là định dạng: .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf',
            ]);
            if($request->has('id_pb') || $request->has('id_dv') || $request->has('id_p') || $request->has('id_n') || $request->has('id_cn')){
                $vanbandi = new VanBanDi();
                $vanbandi->id_LVB = $data['id_LVB'];
                $vanbandi->id_Gr = $request->id_Gr;
    
                $vanbandi->SoHieu = $request->tt. '-'.$request->kytu. '-' .$request->namgui. '-' .$request->thuoc;
    
                $vanbandi->NoiDung = $data['NoiDung'];
                $vanbandi->GhiChu = $request->GhiChu;
                $vanbandi->tt_lvb = $request->tt;
                $vanbandi->TrangThai = $request->TrangThai;
                $vanbandi->id_TK = $id_TK;
                $vanbandi->NgayBH = $request->NgayBH;
                $vanbandi->NgayGui = Carbon::now('Asia/Ho_Chi_Minh');
    
                if ($data['file']) {
                    $get_file = $data['file'];
                    $path1 = public_path('uploads/vanbandi');
                    $path2 = public_path('uploads/vanbanden');
                    $file_name = $get_file->getClientOriginalName();
                    $file_path1 = $path1 . '/' . $file_name;
                    $file_path2 = $path2 . '/' . $file_name;
    
                    // Ensure the directories exist
                    if (!file_exists($path1)) {
                        mkdir($path1, 0777, true);
                    }
                    if (!file_exists($path2)) {
                        mkdir($path2, 0777, true);
                    }
    
                    // Check if the file exists and adjust name if necessary
                    if (file_exists($file_path1) || file_exists($file_path2)) {
                        $file_name = time() . '_' . $file_name;
                        $file_path1 = $path1 . '/' . $file_name;
                    }
                    
                    // Move the file to the first directory
                    if ($get_file->move($path1, $file_name)) {
                        // Copy the file to the second directory
                        copy($file_path1, $file_path2);
                        $vanbandi->file = $file_name;
                    } 
                    
                      // Tạo hash từ file
                    $fileContent = file_get_contents($path1 . '/' . $file_name);
                    $fileHash = hash('sha256', $fileContent);
                }
                // Tạo chuỗi hash từ nội dung văn bản + hash file
                $combinedHash = $fileHash;

                // Lấy khóa bí mật từ file và giải mã
                $encryptedPrivateKey = Storage::get('private_keys/'.$id_TK.'_private.key');
                $privateKey = Crypt::decryptString($encryptedPrivateKey);

                // Tải khóa bí mật vào RSA
                $rsa = RSA::load($privateKey);
                $signature = base64_encode($rsa->sign($combinedHash));
                // Lưu chữ ký số và hash vào cơ sở dữ liệu
                $vanbandi->chu_ky_so = $signature;
                $vanbandi->hash_content = $fileHash;
                $vanbandi->save();
            }
            else{
                toastr()->error('Gửi Không Thành Công, Vui Lòng Chọn Nơi Nhận','Không Thành Công');
                return redirect()->back();
            }
        }
        else{
            toastr()->error('Bạn Chưa Được Cấp Chữ Ký Số','Thất Bại');
            return redirect()->route('van-ban-di.index');
        }
        

        //thống kê
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $thongke = Statistical::where('date',$now)->get();
        if($thongke){
            $statistic_count = $thongke->count();
        }else{
            $statistic_count = 0;
        }
        if($statistic_count != 0){
       
            foreach($thongke as $sta ){
                if($sta->id_LVB == $data['id_LVB'] && $sta->id_Gr == $request->id_Gr){
                    $statistic_new =  Statistical::where('date',$now)->first();
                    $statistic_new->total_LVB = $statistic_new->total_LVB + 1;
                    $statistic_new->total_Gr = $statistic_new->total_Gr + 1;
                    $statistic_new->save();
                }elseif($sta->id_Gr == $request->id_Gr){
                    $statistic_new =  Statistical::where('date',$now)->first();
                    $statistic_new->total_Gr = $statistic_new->total_Gr + 1;
                    $statistic_new->save();
                }elseif($sta->id_LVB == $data['id_LVB']){
                    $statistic_new =  Statistical::where('date',$now)->first();
                    $statistic_new->total_LVB = $statistic_new->total_LVB + 1;
                    $statistic_new->save();
                }
                else{
                    $statisticl = new Statistical();
                    $statisticl->id_LVB = $data['id_LVB'];
                    $statisticl->id_Gr = $request->id_Gr;
                    $statisticl->total_LVB = 1;
                    $statisticl->total_Gr = 1;
                    $statisticl->date = $now;
                    $statisticl->save();
                }
            }

        }
        else{
            $statisticl1 = new Statistical();
            $statisticl1->id_LVB = $data['id_LVB'];
            $statisticl1->id_Gr = $request->id_Gr;
            $statisticl1->total_LVB = 1;
            $statisticl1->total_Gr = 1;
            $statisticl1->date = $now;
            $statisticl1->save();
        }
        
       // Gán nơi đến (nhiều checkbox đã chọn)
       if ($request->has('id_pb')) {
        // Gán id_DV từ request vào cột id_Den của bảng pivot
            foreach($request->id_pb as $id_pb) {
                $vanbandi->denphongban()->attach($id_pb);
            }
        }
        // Attach 'id_dv' to  table
        if ($request->has('id_dv')) {
            foreach($request->id_dv as $id_dv) {
                $vanbandi->dendonvi()->attach($id_dv); 
            }
        }
        
        if ($request->has('id_p')) {
            foreach($request->id_p as $id_p) {
                $vanbandi->denphong()->attach($id_p); 
            }
        }
        
        if ($request->has('id_n')) {
            foreach($request->id_n as $id_n) {
                $vanbandi->dennganh()->attach($id_n); 
            }
        }
        
        if ($request->has('id_cn')) {
            foreach($request->id_cn as $id_cn) {
                $vanbandi->denchuyennganh()->attach($id_cn); 
            }
        }

        //van ban den 
        $vanbanden = new VanBanDen();
        $vanbanden->id_LVB = $data['id_LVB'];
        $vanbanden->id_Gr = $request->id_Gr;
        $vanbanden->id_TK = $id_TK;
        $vanbanden->SoHieu = $request->tt. '-'.$request->kytu. '-' .$request->namgui. '-' .$request->thuoc;
        $vanbanden->NoiDung = $data['NoiDung'];
        $vanbanden->GhiChu = $request->GhiChu;
        $vanbanden->TrangThai = $request->TrangThai;
        $vanbanden->chu_ky_so = $signature;
        $vanbanden->hash_content = $combinedHash;
        $vanbanden->NgayBH = $request->NgayBH;
        $vanbanden->NgayNhan = Carbon::now('Asia/Ho_Chi_Minh');
        if ($data['file']) {
            $get_file = $data['file']; // Lấy đối tượng file
            
            // Lấy tên gốc của file
            $file_name = $get_file->getClientOriginalName(); // Lấy tên gốc của file
            // Lưu tên file vào cột `file` trong cơ sở dữ liệu
            $vanbanden->file = $file_name;
        }
        $vanbanden->save();
        //van ban den
       if ($request->has('id_pb')) {
        // Gán id_DV từ request vào cột id_Den của bảng pivot
            foreach($request->id_pb as $id_pb) {
                $vanbanden->denphongban()->attach($id_pb);
            }
        }
        // Attach 'id_dv' to  table
        if ($request->has('id_dv')) {
            foreach($request->id_dv as $id_dv) {
                $vanbanden->dendonvi()->attach($id_dv); 
            }
        }
        
        if ($request->has('id_p')) {
            foreach($request->id_p as $id_p) {
                $vanbanden->denphong()->attach($id_p); 
            }
        }
        
        if ($request->has('id_n')) {
            foreach($request->id_n as $id_n) {
                $vanbanden->dennganh()->attach($id_n); 
            }
        }
        
        if ($request->has('id_cn')) {
            foreach($request->id_cn as $id_cn) {
                $vanbanden->denchuyennganh()->attach($id_cn); 
            }
        }

        toastr()->success('Gửi Văn Bản Thành Công');
        return redirect()->route('van-ban-di.index');

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
        $vanBanDiList = VanBanDi::whereIn('id', $ids)->get();

        foreach ($vanBanDiList as $vanBanDi) {
            // Delete the associated file if it exists
            $path_unlink = 'uploads/vanbandi/' . $vanBanDi->file;
            if (file_exists(public_path($path_unlink))) {
                unlink(public_path($path_unlink));
            }

            // Detach related relationships
            $vanBanDi->denphongban()->detach($vanBanDi->id_pb); 
            $vanBanDi->dendonvi()->detach($vanBanDi->id_dv);
            $vanBanDi->denphong()->detach($vanBanDi->id_p);
            $vanBanDi->dennganh()->detach($vanBanDi->id_n);
            $vanBanDi->denchuyennganh()->detach($vanBanDi->id_cn);

            // Delete the VanBanDi record
            $vanBanDi->delete();
        }

        // Show success message
        toastr()->success('Xóa Văn Bản Thành Công');
        
        return redirect()->route('van-ban-di.index');
    }
    public function downloadFile(Request $request){
        // Lấy tên file từ request
        $fileName = $request->input('file');

        // Kiểm tra xem file có tồn tại không
        if (file_exists(public_path('uploads/vanbandi/' . $fileName))) {
            return response()->download(public_path('uploads/vanbandi/' . $fileName));
        }

        return response()->json(['error' => 'File không tồn tại.'], 404);
    }
}
