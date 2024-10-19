<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
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
use App\Models\NoiDen;
use App\Models\BH_PB;
use App\Models\BH_P;
use App\Models\BH_DV;
use App\Models\BH_N;
use App\Models\BH_CN;

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
            // Kiểm tra nếu ngày gửi trong vòng 3 ngày
            $vb->isNew = Carbon::parse($vb->NgayGui)->greaterThanOrEqualTo(Carbon::now()->subDays(3));
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
        $nhom = Nhom::orderBy('id', 'DESC')->get();
        $ten = '';
        foreach($nhom as $nh){
            if($taikhoan->id_Gr == $nh->id){
                $ten = $nh->TenGroup;
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
        
        
        
        return view('vanban.vanbandi.create',compact('loaivanban', 'nhom', 'phongban', 'donvi', 'phong', 'nganh', 'chuyennganh','tengroup'));
    }

    //check nhung noi duoc gui theo loai văn bản và đon vị ban hanh được tạo trước đó
    public function check_noinhan(Request $request) {
        // Kiểm tra nếu id_LVB hoặc id_Gr không hợp lệ
        if (!$request->id_LVB || !$request->id_Gr) {
            return response()->json(['html' => '']); // Trả về rỗng nếu không có dữ liệu
        }
    
        // Tìm kiếm thông tin theo loại văn bản và đơn vị ban hành
        $nhan = LVBTheoDVHB::where('id_LVB', $request->id_LVB)->where('id_Gr', $request->id_Gr)->first();
    
        // Nếu không tìm thấy, trả về không có dữ liệu
        if (!$nhan) {
            return response()->json(['html' => '']);
        }
    
        // Lấy danh sách các phòng, đơn vị, ngành... tương ứng
        $nhanpb = BH_PB::where('id_BH_LVB', $nhan->id)->pluck('id_PB')->toArray();
        $nhandv = BH_DV::where('id_BH_LVB', $nhan->id)->pluck('id_DV')->toArray();
        $nhanp = BH_P::where('id_BH_LVB', $nhan->id)->pluck('id_P')->toArray();
        $nhannganh = BH_N::where('id_BH_LVB', $nhan->id)->pluck('id_N')->toArray();
        $nhanchuyennganh = BH_CN::where('id_BH_LVB', $nhan->id)->pluck('id_CN')->toArray();
    
        // Trả về view kèm theo dữ liệu
        return response()->json([
            'html' => view('vanban.vanbandi.recipient_list', compact('nhanpb', 'nhandv', 'nhanp', 'nhannganh', 'nhanchuyennganh'))->render()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function chitiet(string $slug){
        
        $vanbandi_chitiet = VanBanDi::where('slug',$slug)->first();
        $noiden = NoiDen::where('id_VB', $vanbandi_chitiet->id)->orderBy('id','DESC')->get();
        
        $theloai = LoaiVanBan::where('id_LVB',$vanbandi_chitiet->id_LVB)->first();
        return view('vanban.vanbandi.chitiet', compact('vanbandi_chitiet','theloai','noiden'));
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
            'TenVB' => 'required|unique:vanbandi',
            'SoHieu' => 'required',
            'id_LVB' => 'required',
            'file' => 'required',
            'id_DV' => 'required|array', // Kiểm tra id_DV là một mảng
        ],
        [
            'TenVB.unique' => 'Tên văn bản này đã có, vui lòng điền tên khác',
            'TenVB.required' => 'Tên Văn Bản Phải Có',
            'SoHieu.required' => 'Số Hiệu Văn Bản Phải Có',
            'id_LVB.required' => 'Loai Văn Bản Phải Có',
            'file.required' => 'File Phải Có',
        ]);
        $vanbandi = new VanBanDi();
        $vanbandi->TenVB = $data['TenVB'];
        $vanbandi->slug = Str::slug($data['TenVB']);
        $vanbandi->SoHieu = $data['SoHieu'];
        $vanbandi->id_LVB = $data['id_LVB'];
        $vanbandi->id_TK = $id_TK;
        $vanbandi->NgayGui = Carbon::now('Asia/Ho_Chi_Minh');

        if($data['file']){
            $get_file = $data['file'];  // Lấy đối tượng file
            $path = 'uploads/vanbandi'; // Đường dẫn lưu file

            // Lấy tên gốc của file
            $file_name = time() . '_' . $get_file->getClientOriginalName(); // Đảm bảo tên file duy nhất

            // Di chuyển file đến thư mục đích và lưu với tên gốc (hoặc bạn có thể tạo tên mới)
            $get_file->move($path, $file_name);

            // Lưu tên file vào cột `file` trong cơ sở dữ liệu
            $vanbandi->file = $file_name;
        }
        $vanbandi->save();
       // Gán nơi đến (nhiều checkbox đã chọn)
        if ($request->has('id_DV')) {
            // Gán id_DV từ request vào cột id_Den của bảng pivot
            foreach($request->id_DV as $id_DV) {
                $vanbandi->noiden()->attach($id_DV); // Cột đúng là id_Den trong bảng noiden
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
