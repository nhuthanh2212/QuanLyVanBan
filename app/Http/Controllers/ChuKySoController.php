<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

use phpseclib3\Crypt\RSA;
use Illuminate\Support\Facades\Storage;

use App\Models\Nhom;
use App\Models\TaiKhoan;
use App\Models\ChuKySo;




class ChuKySoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $chukyso = ChuKySo::orderBy('id','DESC')->get();
        $taikhoan = TaiKhoan::with('nhom')->with('chucvu')->orderBy('id_TK','DESC')->get();
        
        return view('manager.chukyso.list', compact('chukyso','taikhoan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nhom = Nhom::orderBy('id','ASC')->get();
        return view('manager.chukyso.create', compact('nhom'));
    }
    public function select_ca_nhan(Request $request){
        $data = $request->all();

        // Kiểm tra xem 'action' có tồn tại
        if ($data['action']) {
            $output = '';

            // Nếu action là "donvi"
            if ($data['action'] == "donvi") {
                // Thay thế 'canhan' bằng 'donvi' trong điều kiện truy vấn
                // Giả sử rằng bạn muốn lấy danh sách tài khoản dựa trên 'id_Gr' (được gán giá trị từ 'donvi')
                $select_taikhoan = TaiKhoan::where('id_Gr', $data['donvi'])->orderby('id_TK', 'ASC')->get();
                $output = '<option>-----Chọn Cá Nhân-----</option>';

                // Tạo danh sách các cá nhân
                foreach ($select_taikhoan as $key => $tk) {
                    $output .= '<option value="' . $tk->id_TK . '">' . $tk->HoTen . '</option>';
                }
            }

            // Trả về output để cập nhật trong select box
            return response()->json($output);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Tạo khóa RSA (2048 bit)
        //  $keyPair = RSA::createKey(2048);
         $data = $request->validate([
            'HoTen' => 'required',
            'DienThoai' => 'required',
            'CCCD' => 'required',
           
        ],
        [
            
            'HoTen.required' => 'Họ Tên Phải Có',
            'DienThoai.required' => 'Số Điện Thoại Phải Có',
            'CCCD.required' => 'Số CCCD Phải Có',
           
            
        ]);

         // Concatenate Họ Tên, Số Điện Thoại, and CCCD
        //  $combinedData = $data['HoTen'] . ' ' . $data['DienThoai'] . ' ' . $data['CCCD'];

        // Generate RSA key pair using PHP's OpenSSL functions
        $config = [
            "private_key_bits" => 2048,
            "private_key_type" => OPENSSL_KEYTYPE_RSA,
        ];

        // Create a new private key
        $resource = openssl_pkey_new($config);
        openssl_pkey_export($resource, $privateKey);
        $publicKey = openssl_pkey_get_details($resource)['key'];

        // Store the public key in the database
        $chukyso = new ChuKySo();
        $chukyso->id_TK = $request->input('id'); // Using CCCD as an identifier, adjust if needed
        $chukyso->TrangThai = 1;
        $chukyso->NgayKy = Carbon::now('Asia/Ho_Chi_Minh');
        $chukyso->public_Key = $publicKey;
        $chukyso->save();

        // Save the private key securely to a file
        $fileName = 'private_keys/' . $request->input('id') . '_private.key';
        Storage::put($fileName, $privateKey);
 
         // Display success message

        //  // Khóa công khai và khóa bí mật
        //  $publicKey = $keyPair->getPublicKey()->toString('PKCS1');
        //  $privateKey = $keyPair->toString('PKCS1');
        //  $chukyso = new ChuKySo();
        //  $chukyso->id_TK = $request->canhan;
        //  $chukyso->TrangThai = 1;
        //  $chukyso->NgayKy =  Carbon::now('Asia/Ho_Chi_Minh');
        //  //khoa cong khai
        //  $chukyso->public_Key = $publicKey;
        //  $chukyso->save();
        //  // Lưu khóa bí mật vào file bảo mật hoặc sử dụng mã hóa để lưu trữ
        //  Storage::put('private_keys/'.$request->canhan.'_private.key', $privateKey);
         toastr()->success('Cấp Chữ Ký Số Thành Công');
        return redirect()->route('chu-ky-so.index');
    }

    public function khoa(string $id){
        $chukyso = ChuKySo::find($id);
        $chukyso->TrangThai = 0;
        $chukyso->save();
        toastr()->success('Khóa Người Công');
        return redirect()->route('chu-ky-so.index');
    }

    public function bo_khoa(string $id){
        $chukyso = ChuKySo::find($id);
        $chukyso->TrangThai = 1;
        $chukyso->save();
        toastr()->success('Hủy Khóa Thành Công');
        return redirect()->route('chu-ky-so.index');
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
        return view('manager.chukyso.edit');
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
        $chukyso = ChuKySo::find($id);
      
        
        // Xóa file chứa khóa bí mật
        $privateKeyPath = 'private_keys/' . $chukyso->id_TK . '_private.key';
        if (Storage::exists($privateKeyPath)) {
            Storage::delete($privateKeyPath);
        }

        // Xóa bản ghi chữ ký số
        $chukyso->delete();
        toastr()->success('Xóa Chữ Ký Số Thành Công');
        return redirect()->route('chu-ky-so.index');
    }
}
