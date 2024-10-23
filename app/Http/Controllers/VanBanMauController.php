<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;
use Carbon\Carbon;

use App\Models\Nhom;
use App\Models\LoaiVanBan;
use App\Models\VB_Mau;
use App\Models\TaiKhoan;
class VanBanMauController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
        $id = Session::get('id');
        $taikhoan = TaiKhoan::where('id_TK', $id)->first();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $loaivanban = LoaiVanBan::orderBy('id_LVB','ASC')->get();
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
    public function edit(string $id)
    {
        $id = Session::get('id');
        $taikhoan = TaiKhoan::where('id_TK', $id)->first();
        $nhom = Nhom::orderBy('id', 'ASC')->get();
        $loaivanban = LoaiVanBan::orderBy('id_LVB','ASC')->get();
        $vanbanmau = VB_Mau::with('loaivanban')->with('nhom')->find($id);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vanbanmau = VB_Mau::find($id);
        $vanbanmau->delete();
        $path_unlink =  public_path('uploads/vanbanmau'. $vanbanmau->file);
            if(file_exists($path_unlink)){
                unlink($path_unlink);
            }
        toastr()->success('Xóa Văn Bản Mẫu Thành Công');
        return redirect()->route('van-ban-mau.index');
    }
}
