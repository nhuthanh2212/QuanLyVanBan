<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\IOFactory;

use App\Models\VanBanDen;
use App\Models\TaiKhoan;
use App\Models\LuuTru;
use App\Models\Nhom;
use Illuminate\Support\Facades\Auth;

class LuuTruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy id người dùng hiện tại (hoặc id cụ thể nếu cần)
        $idTaiKhoan = Auth::user()->id_TK;
            
        // Lấy tất cả văn bản đã được lưu bởi người dùng này
        $vanBan = LuuTru::where('luu_tru.id_TK', $idTaiKhoan)
        ->join('vanbanden', 'luu_tru.id_VB', '=', 'vanbanden.id') // Join với bảng van_ban_den
        ->select('luu_tru.id_luu as id_luu', 'vanbanden.*') // Lấy id của bảng luu_tru và tất cả cột từ van_ban_den
        ->orderBy('vanbanden.NgayNhan', 'desc') // Sắp xếp mới nhất
        ->get();

        
        return view('vanban.luutru.index',compact('vanBan'));
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
        $luu = LuuTru::orderBy('id_luu','DESC')->get();

        foreach($luu as $l){
            if($l->id_TK == $request->id_nguoigui && $l->id_VB == $request->id_vb){
                toastr()->warning('Văn Bản Đã Được Lưu', 'Đã Có');
                return redirect()->route('van-ban-den.index');
            }
        }
        $luutru = new LuuTru();
        $luutru->id_TK = $request->id_nguoigui;
        $luutru->id_VB = $request->id_vb;
        $luutru->save();
        toastr()->success('Lưu Trữ Văn Bản Thành Công', 'Thành Công');
        return redirect()->route('van-ban-den.index');
        
    }

    public function mofile(string $id)
    {
        $vanban = VanBanDen::where('id',$id)->first();
        // Kiểm tra xem file có tồn tại không
        if (!$vanban) {
            return abort(404, 'Văn bản không tồn tại.');
        }

        $filePath = public_path("uploads/vanbanden/{$vanban->file}");

        // Kiểm tra file có tồn tại không
        if (!file_exists($filePath)) {
            return abort(404, 'File không tồn tại.');
        }


         // Đọc file Word và lấy nội dung
         $content = '';
         $fileExtension = pathinfo($vanban->file, PATHINFO_EXTENSION);
 
         if ($fileExtension == 'docx') {
            // Tải file Word
            $phpWord = IOFactory::load($filePath);

            // Lặp qua các sections
            foreach ($phpWord->getSections() as $section) {
                // Lặp qua các phần tử trong section
                foreach ($section->getElements() as $element) {
                    // Kiểm tra nếu phần tử là TextRun (chứa văn bản)
                    if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                        foreach ($element->getElements() as $textElement) {
                            if ($textElement instanceof \PhpOffice\PhpWord\Element\Text) {
                                $content .= $textElement->getText() . "\n";
                            }
                        }
                    }
                }
            }
        }

        // Trả về nội dung file (hoặc view để chỉnh sửa)
        return view('vanban.luutru.edit', compact('vanban', 'content'));
    }


    public function savefile(string $id, Request $request)
    {
        $vb = VanBanDen::find($id);

        if (!$vb) {
            toastr()->error('Văn Bản Không Tồn Tại', 'Thất Bại');
            return redirect()->route('luu-tru.index');
        }

        // Kiểm tra trạng thái ký số
        if ($vb->is_signed) {
            return response()->json(['error' => 'Văn bản này đã được ký chữ ký số, không thể chỉnh sửa.'], 403);
        }

        // Lưu file sau khi chỉnh sửa (ví dụ file Word)
        $newContent = $request->input('content');
        $filePath = public_path("uploads/vanbanden/{$vb->file}");

        if (pathinfo($vb->file, PATHINFO_EXTENSION) == 'docx') {
            // Sử dụng PHPWord để chỉnh sửa file Word
            $templateProcessor = new TemplateProcessor($filePath);
            $templateProcessor->setValue('placeholder', $newContent); // Thay thế nội dung placeholder
            $templateProcessor->saveAs($filePath); // Lưu lại file

            toastr()->success('Lưu Văn Bản Thành Công', 'Thành Công');
            return redirect()->route('luu-tru.index');
        } elseif (pathinfo($vb->file, PATHINFO_EXTENSION) == 'txt') {
            // Đối với file text, chỉ cần ghi lại nội dung
            File::put($filePath, $newContent);

            toastr()->success('Lưu Văn Bản Thành Công', 'Thành Công');
            return redirect()->route('luu-tru.index');
        }

        toastr()->error('Định Dạng Văn Bản Không Hợp Lệ', 'Thất Bại');
        return redirect()->route('luu-tru.index');
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
        $luu_tru = LuuTru::where('id_VB',$id)->first();
        $luu_tru->delete();
        toastr()->success('Xóa Văn Bản Lưu Trữ Thành Công', 'Thành Công');
        return redirect()->route('luu-tru.index');
    }
}
