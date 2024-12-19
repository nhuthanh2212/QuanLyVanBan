<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;
use Dompdf\Dompdf;
use Carbon\Carbon;

use App\Models\Nhom;
use App\Models\LoaiVanBan;
use App\Models\VB_Mau;
use App\Models\TaiKhoan;
class VanBanMauController extends Controller
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
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        $vanbanmau = VB_Mau::with('loaivanban')->with('nhom')->orderBy('id','DESC')->get();
        
        return view('vanban.vanbanmau.list',compact('theloai','vanbanmau','nhom'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->session_login();
        $id = Session::get('id');
        $taikhoan = TaiKhoan::where('id_TK', $id)->first();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $loaivanban = LoaiVanBan::where('TrangThai',1)->orderBy('id_LVB','ASC')->get();
        $vanbanmau = VB_Mau::with('loaivanban')->with('nhom')->orderBy('id','DESC')->get();
        $id = '';
        $ten = '';
        foreach($nhom as $nh){
            if($taikhoan->id_Gr == $nh->id){
                $ten = $nh->TenGroup;
                $id = $nh->id;
            }
        }
        // Tìm vị trí của dấu '-' cuối cùng
        $tim = strrpos($ten, '-');
        // Lấy chuỗi sau dấu '-' cuối cùng
        $tengroup = substr($ten, $tim + 1);
        return view('vanban.vanbanmau.create',compact('loaivanban','vanbanmau','nhom','id','tengroup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenVB' => 'required',
            
            'id_LVB' => 'required',
            'file' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|max:5120',  // Chỉ cho phép các định dạng văn bản
            
        ],
        [
            
            'TenVB.required' => 'Tên Văn Bản Mẫu Phải Có',
           
            'id_LVB.required' => 'Loai Văn Bản Phải Có',
            'file.required' => 'File Phải Có',
            'file.mimes' => 'File phải là định dạng: .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf',
        ]);
        $vanbanmau = new VB_Mau();
        $vanbanmau->id_LVB = $data['id_LVB'];
        $vanbanmau->id_Gr = $request->id_Gr;
        $vanbanmau->TenVB = $data['TenVB'];
        $vanbanmau->TrangThai = 1;
        

        if ($data['file']) {
            $get_file = $data['file']; // Lấy đối tượng file
    
            // Thư mục đầu tiên: uploads/vanbandi
            $path1 = public_path('uploads/vanbanmau'); 
          
            
            // Lấy tên gốc của file
            $file_name = $get_file->getClientOriginalName(); // Lấy tên gốc của file
            
            // Kiểm tra xem file đã tồn tại hay chưa trong cả hai thư mục để đảm bảo tên file là duy nhất
            $file_path1 = $path1 . '/' . $file_name; // Đường dẫn đầy đủ của file trong thư mục thứ nhất
          
            
            // Nếu file đã tồn tại trong bất kỳ thư mục nào, tạo tên mới cho file
            if (file_exists($file_path1)) {
                // Thêm tiền tố thời gian vào tên file để tránh trùng lặp
                $file_name = time() . '_' . $file_name;
            }

            // Di chuyển file đến thư mục đầu tiên
            $get_file->move($path1, $file_name); // Di chuyển đến uploads/vanbandi

           

            // Lưu tên file vào cột `file` trong cơ sở dữ liệu
            $vanbanmau->file = $file_name;
        }
        $vanbanmau->save();

        toastr()->success('Thêm Văn Bản Mẫu Thành Công');
        return redirect()->route('van-ban-mau.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function loc()
    {
        $this->session_login();
        $loaivanban = $_GET['loaivanban'];
        $donvibanhanh = $_GET['donvibanhanh'];
        // If no filter is selected
        if (empty($loaivanban) && empty($donvibanhanh)) {
            toastr()->warning('Vui Lòng Chọn Dữ Liệu Muốn Lọc', 'Không Có Dữ Liệu Lọc');
            return redirect()->back();
        }

        // Filter data based on input
        $query = VB_Mau::query();
        
        if (!empty($loaivanban)) {
            $query->where('id_LVB', $loaivanban);
        }
        
        if (!empty($donvibanhanh)) {
            $query->where('id_Gr', $donvibanhanh);
        }

        $vanbanmau = $query->orderBy('id', 'DESC')->get();
        $theloai = LoaiVanBan::orderBy('id_LVB', 'ASC')->get();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        
        // Return the same view with the filtered data
        return view('vanban.vanbanmau.list', compact('vanbanmau', 'theloai','nhom'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function chitiet(string $id){
        $this->session_login();
        $vanbanmau_chitiet = VB_Mau::where('id',$id)->first();
        
        $nhom = Nhom::orderBy('id','ASC')->get();
        foreach($nhom as $nh){
            if($vanbanmau_chitiet->id_Gr == $nh->id){
                $ten = $nh->TenGroup;
            }
        }
        // Tìm vị trí của dấu '-' cuối cùng
        $tim = strrpos($ten, '-');
        // Lấy chuỗi sau dấu '-' cuối cùng
        $tengroup = substr($ten, $tim + 1);
        $theloai = LoaiVanBan::where('id_LVB',$vanbanmau_chitiet->id_LVB)->first();

        $fullPath = public_path('uploads/vanbanmau/' . $vanbanmau_chitiet->file);
        // Cấu hình Dompdf làm PDF renderer
        Settings::setPdfRendererName(Settings::PDF_RENDERER_DOMPDF);
        Settings::setPdfRendererPath(base_path('vendor/dompdf/dompdf'));

        $fileExtension = pathinfo($fullPath, PATHINFO_EXTENSION);
        $htmlOutput = '';

        if ($fileExtension === 'pdf') {
            $htmlOutput = '<iframe src="' . asset('uploads/vanbanmau/' . $vanbanmau_chitiet->file) . '" style="width: 100%; height: 600px;"></iframe>';
        } elseif ($fileExtension === 'docx') {
            try {
                $phpWord = IOFactory::load($fullPath);
                $pdfPath = public_path('uploads/vanbanmau/' . pathinfo($fullPath, PATHINFO_FILENAME) . '.pdf');
                $pdfWriter = IOFactory::createWriter($phpWord, 'PDF');
                $pdfWriter->save($pdfPath);

                $htmlOutput = '<iframe src="' . asset('uploads/vanbanmau/' . basename($pdfPath)) . '" style="width: 100%; height: 600px;"></iframe>';
            } catch (\Exception $e) {
                dd('Lỗi xử lý DOCX: ' . $e->getMessage());
            }
        } elseif ($fileExtension === 'txt') {
            $htmlOutput = '<pre>' . htmlspecialchars(file_get_contents($fullPath)) . '</pre>';
        } elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $htmlOutput = '<img src="' . asset('uploads/vanbanmau/' . $vanbanmau_chitiet->file) . '" style="width: 100%; height: auto;">';
        } elseif ($fileExtension === 'doc') {
            $url = urlencode(asset('uploads/vanbanmau/' . $vanbanmau_chitiet->file));
            $htmlOutput = '<iframe src="https://docs.google.com/gview?url=' . $url . '&embedded=true" style="width: 100%; height: 600px;"></iframe>';
        } elseif ($fileExtension === 'xlsx') {
            $url = urlencode(asset('uploads/vanbanmau/' . $vanbanmau_chitiet->file));
            $htmlOutput = '<iframe src="https://docs.google.com/gview?url=' . $url . '&embedded=true" style="width: 100%; height: 600px;"></iframe>';
        } else {
            return response()->json(['error' => 'Unsupported file type.'], 400);
        }
        return view('vanban.vanbanmau.chitiet', compact('vanbanmau_chitiet','tengroup','theloai','htmlOutput'));
    }
    public function edit(string $id)
    {
        $this->session_login();
        $vanbanmau = VB_Mau::find($id);
        $id = Session::get('id');
        $taikhoan = TaiKhoan::where('id_TK', $id)->first();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $loaivanban = LoaiVanBan::where('TrangThai',1)->orderBy('id_LVB','ASC')->get();
        
        $id = '';
        $ten = '';
        foreach($nhom as $nh){
            if($taikhoan->id_Gr == $nh->id){
                $ten = $nh->TenGroup;
                $id = $nh->id;
            }
        }
        // Tìm vị trí của dấu '-' cuối cùng
        $tim = strrpos($ten, '-');
        // Lấy chuỗi sau dấu '-' cuối cùng
        $tengroup = substr($ten, $tim + 1);
        return view('vanban.vanbanmau.edit',compact('loaivanban','vanbanmau','nhom','id','tengroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenVB' => 'required',
            
            'id_LVB' => 'required',
            'file' => 'mimes:doc,docx,xls,xlsx,ppt,pptx,pdf',  // Chỉ cho phép các định dạng văn bản
            
        ],
        [
            
            'TenVB.required' => 'Tên Văn Bản Mẫu Phải Có',
           
            'id_LVB.required' => 'Loai Văn Bản Phải Có',
           
            'file.mimes' => 'File phải là định dạng: .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf',
        ]);
        $vanbanmau = VB_Mau::find($id);
        $vanbanmau->id_LVB = $data['id_LVB'];
        $vanbanmau->id_Gr = $request->id_Gr;
        $vanbanmau->TenVB = $data['TenVB'];
        $vanbanmau->TrangThai = $request->TrangThai;
        

        if ($request->file) {
            $get_file = $request->file; // Lấy đối tượng file
    
            // Thư mục đầu tiên: uploads/vanbandi
            $path1 = public_path('uploads/vanbanmau'); 
          
            
            // Lấy tên gốc của file
            $file_name = $get_file->getClientOriginalName(); // Lấy tên gốc của file
            
            // Kiểm tra xem file đã tồn tại hay chưa trong cả hai thư mục để đảm bảo tên file là duy nhất
            $file_path1 = $path1 . '/' . $file_name; // Đường dẫn đầy đủ của file trong thư mục thứ nhất
          
            
            // Nếu file đã tồn tại trong bất kỳ thư mục nào, tạo tên mới cho file
            if (file_exists($file_path1)) {
                // Thêm tiền tố thời gian vào tên file để tránh trùng lặp
                $file_name = time() . '_' . $file_name;
            }

            // Di chuyển file đến thư mục đầu tiên
            $get_file->move($path1, $file_name); // Di chuyển đến uploads/vanbandi

           

            // Lưu tên file vào cột `file` trong cơ sở dữ liệu
            $vanbanmau->file = $file_name;
        }
        $vanbanmau->save();

        toastr()->success('Cập Nhật Văn Bản Mẫu Thành Công');
        return redirect()->route('van-ban-mau.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->session_login();
        $vanbanmau = VB_Mau::find($id);
        $vanbanmau->delete();
        $path_unlink =  public_path('uploads/vanbanmau'. $vanbanmau->file);
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        toastr()->success('Xóa Văn Bản Mẫu Thành Công');
        return redirect()->route('van-ban-mau.index');
    }
    public function downloadFilemau(Request $request){
        // Lấy tên file từ request
        $fileName = $request->input('file');

        // Kiểm tra xem file có tồn tại không
        if (file_exists(public_path('uploads/vanbandi/' . $fileName))) {
            return response()->download(public_path('uploads/vanbandi/' . $fileName));
        }

        return response()->json(['error' => 'File không tồn tại.'], 404);
    }
}
