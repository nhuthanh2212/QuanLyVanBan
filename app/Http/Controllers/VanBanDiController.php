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
use App\Models\VanBanDi;
use App\Models\Nhom;
use App\Models\PhongBan;
use App\Models\DonVi;
use App\Models\Phong;
use App\Models\Nganh;
use App\Models\ChuyenNganh;
use App\Models\LVBTheoDVHB;
use App\Models\TaiKhoan;

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
        $theloai = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        $vanbandi = VanBanDi::with('taikhoan')->orderBy('id','DESC')->get();
        foreach ($vanbandi as $vb) {
            // Chuyển đổi ngày gửi từ cơ sở dữ liệu sang Carbon
            $ngayGui = Carbon::parse($vb->NgayGui);

            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = $ngayGui->greaterThanOrEqualTo(Carbon::now()->subDays(3));
                }
        return view('vanban.vanbandi.list',compact('theloai','vanbandi'));
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

        $loaivanban = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        
        $phongban = PhongBan::orderBy('id', 'ASC')->get();
        $donvi = DonVi::orderBy('id', 'ASC')->get();
        $phong = Phong::orderBy('id', 'ASC')->get();
        $nganh = Nganh::orderBy('id', 'ASC')->get();
        $chuyennganh = ChuyenNganh::orderBy('id', 'ASC')->get();
        
        //lay duoi so hieu
        $nhom = Nhom::where('id',$taikhoan->id_Gr)->first();
        $slug = '';
        if($nhom->id_PB != NULL){
            if($nhom->id_DV != NULL){
                if($nhom->id_P != NULL){
                    if($nhom->id_N != NULL){
                        if($nhom->id_CN != NULL){
                            foreach($chuyennganh as $cn){
                                if($cn->id == $nhom->id_CN){
                                    $slug = $cn->slug;
                                }
                            }
                        }
                        else{
                            foreach($nganh as $ng){
                                if($ng->id == $nhom->id_N){
                                    $slug = $ng->slug;
                                }
                            }
                        }
                    }
                    else{
                        foreach($phong as $phg){
                            if($phg->id == $nhom->id_P){
                                $slug = $phg->slug;
                            }
                        }
                    }
                }
                else{
                    foreach($donvi as $dv){
                        if($dv->id == $nhom->id_DV){
                        $slug = $dv->slug;
                        }
                    }
                }
            }
            else{
                foreach($phongban as $phgb){
                    if($phgb->id == $nhom->id_PB){
                        $slug = $phgb->slug;
                    }
                }
            }
        }
        else{
            $slug = '';
        }
        
        return view('vanban.vanbandi.create',compact('loaivanban', 'taikhoan','id', 'phongban', 'donvi', 'phong', 'nganh', 'chuyennganh','tengroup','slug'));
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

        $filePath = 'uploads/vanbandi/' . $vanbandi_chitiet->file;
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

        return view('vanban.vanbandi.chitiet', compact('vanbandi_chitiet','theloai','tengroup','vb_pb','vb_dv','vb_p','vb_n','vb_cn', 'phongban', 'donvi', 'phong', 'nganh', 'chuyennganh','htmlOutput'));
    }
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
        $id_TK = Session::get('id');
        $data = $request->validate([
            'NoiDung' => 'required',
            'SoHieu' => 'required',
            'id_LVB' => 'required',
            'file' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf',  // Chỉ cho phép các định dạng văn bản
            
        ],
        [
            
            'NoiDung.required' => 'Trích Nội Dung Văn Bản Phải Có',
            'SoHieu.required' => 'Số Hiệu Văn Bản Phải Có',
            'id_LVB.required' => 'Loai Văn Bản Phải Có',
            'file.required' => 'File Phải Có',
            'file.mimes' => 'File phải là định dạng: .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf',
        ]);
        $vanbandi = new VanBanDi();
        $vanbandi->id_LVB = $data['id_LVB'];
        $vanbandi->id_Gr = $request->id_Gr;
        $vanbandi->SoHieu = $data['SoHieu'];
        $vanbandi->NoiDung = $data['NoiDung'];
        $vanbandi->GhiChu = $request->GhiChu;
        $vanbandi->TrangThai = $request->TrangThai;
        $vanbandi->id_TK = $id_TK;
        $vanbandi->NgayBH = $request->NgayBH;
        $vanbandi->NgayGui = Carbon::now('Asia/Ho_Chi_Minh');

        if ($data['file']) {
            $get_file = $data['file']; // Lấy đối tượng file
            $path = 'uploads/vanbandi'; // Đường dẫn lưu file
        
            // Lấy tên gốc của file
            $file_name = $get_file->getClientOriginalName(); // Lấy tên gốc của file
        
            // Kiểm tra xem file đã tồn tại hay chưa để đảm bảo tên file là duy nhất
            $file_path = $path . '/' . $file_name; // Đường dẫn đầy đủ của file
        
            // Nếu file đã tồn tại, bạn có thể thêm một số logic ở đây, ví dụ như thêm số vào tên file
            if (file_exists($file_path)) {
                // Thêm logic để xử lý khi file đã tồn tại (Ví dụ: tạo tên mới)
                $file_name = time() . '_' . $file_name; // Hoặc bạn có thể thêm logic khác
            }
        
            // Di chuyển file đến thư mục đích và lưu với tên gốc
            $get_file->move($path, $file_name);
        
            // Lưu tên file vào cột `file` trong cơ sở dữ liệu
            $vanbandi->file = $file_name;
        }
        $vanbandi->save();
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
