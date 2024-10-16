<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\ChucVu;

use App\Models\Khoi;
use App\Models\PhongBan;
use App\Models\DonVi;
use App\Models\Phong;
use App\Models\Nganh;
use App\Models\ChuyenNganh;
use App\Models\Nhom;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $role = Role::create(['name' => 'user']); them vai tro
        // $permission = Permission::create(['name' => '']); //them su cho phep

        // $role = Role::find(2);
        // $permission = Permission::find(4);
        // // $role->givePermissionTo($permission); quyen co vai tro gi
        // $permission->assignRole($role);

        $taikhoan = TaiKhoan::orderBy('id_TK','desc')->get();
        return view('manager.user.list',compact('taikhoan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nhom = Nhom::orderBy('id','ASC')->get();
        $chucvu = ChucVu::orderBy('id','ASC')->get();
        $khoi = Khoi::orderBy('id','ASC')->get();
        return view('manager.user.create',compact('chucvu','khoi','nhom'));
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
        $tk = TaiKhoan::find($id);
        $khoi = Khoi::orderBy('id','ASC')->get();
        $chucvu = ChucVu::orderBy('id','ASC')->get();
        return view('manager.user.edit',compact('tk','chucvu','khoi'));
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

    public function profile()
    {
        return view('manager.user.profile');
    }
    //group thành viên
    public function add_group(){
        $khoi = Khoi::orderBy('id','ASC')->get();
        return view('manager.user.group',compact('khoi'));
    }
    public function insert_group(Request $request)
    {
        $data = $request->all();
        $khoi = Khoi::where('id', $data['khoi'])->first();
        $phongban = PhongBan::where('id', $data['phongban'])->first();
        $donvi = !empty($data['donvi']) ? DonVi::where('id', $data['donvi'])->first() : null;
        $phong = !empty($data['phong']) ? Phong::where('id', $data['phong'])->first() : null;
        $nganh = !empty($data['nganh']) ? Nganh::where('id', $data['nganh'])->first() : null;
        $chuyennganh = !empty($data['chuyennganh']) ? ChuyenNganh::where('id', $data['chuyennganh'])->first() : null;
        $ten = '';

        if ($khoi && $phongban) { // Kiểm tra các trường bắt buộc
            $ten .= $khoi->TenK . ' - ' . $phongban->TenPB;

            if ($donvi) { // Chỉ nối thêm nếu tồn tại $donvi
                $ten .= ' - ' . $donvi->TenDV;
            }
            if ($phong) { // Chỉ nối thêm nếu tồn tại $phong
                $ten .= ' - ' . $phong->TenP;
            }
            if ($nganh) { // Chỉ nối thêm nếu tồn tại $nganh
                $ten .= ' - ' . $nganh->TenN;
            }
            if ($chuyennganh) { // Chỉ nối thêm nếu tồn tại $chuyennganh
                $ten .= ' - ' . $chuyennganh->TenCN;
            }
        }

        

        
        $nhom = new Nhom();
        $nhom->id_K = $data['khoi'];
        $nhom->id_PB = $data['phongban'];
        $nhom->id_DV = $donvi ? $donvi->id : null;  // Chỉ gán giá trị nếu tồn tại
        $nhom->id_P = $phong ? $phong->id : null;
        $nhom->id_N = $nganh ? $nganh->id : null;
        $nhom->id_CN = $chuyennganh ? $chuyennganh->id : null;
        $nhom->TenGroup = $ten;
        $nhom->save();


    }

    public function list_group()
    {
        $nhom = Nhom::with('khoi')->with('phongban')->with('donvi')->with('phong')->with('nganh')->with('chuyennganh')->orderBy('id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive"> 
                    <table class="table table-bordered" >
                        <thread>
                            <tr>
                                <th>Tên Khối</th>
                                <th>Tên Phòng Ban</th>
                                <th>Tên Đơn Vị</th>
                                <th>Tên Phòng</th>
                                <th>Tên Ngành</th>
                                <th>Tên Chuyên Ngành</th>
                                <th>Tên Group</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach($nhom as $key => $gr){ 
            $output .= '
                    <tr>
                        <td>'.(optional($gr->khoi)->TenK ?? 'Không có').'</td>
                        <td>'.(optional($gr->phongban)->TenPB ?? 'Không có').'</td>
                        <td>'.(optional($gr->donvi)->TenDV ?? 'Không có').'</td>
                        <td>'.(optional($gr->phong)->TenP ?? 'Không có').'</td>
                        <td>'.(optional($gr->nganh)->TenN ?? 'Không có').'</td>
                        <td>'.(optional($gr->chuyennganh)->TenCN ?? 'Không có').'</td>
                        <td>'.$gr->TenGroup.'</td>
                        <td  data-gr_id="'.$gr->id.'" class="edit"></td>
                    </tr>
                    ';
        }

        $output .= '
                    </tbody>
                </table>
            </div>
        ';

        echo $output;
    }
    public function select_group(Request $request)
    {
        $data = $request->all();
        // Kiểm tra xem các trường 'action' và 'id_K' có tồn tại và không rỗng
       
            if ($data['action']) {
                $output = '';

                // Kiểm tra action để xử lý theo từng phần
                if ($data['action'] == "khoi") {
                    // Lấy danh sách phòng ban dựa theo id_K
                    $select_phongban = PhongBan::where('id_K', $data['id_K'])->orderby('id', 'ASC')->get();
                    $output = '<option>-----Chọn Phòng Ban-----</option>';
                    foreach ($select_phongban as $key => $phongban) {
                        $output .= '<option value="'.$phongban->id.'">'.$phongban->TenPB.'</option>';
                    }
                } else if ($data['action'] == "phongban") {
                    // Lấy danh sách đơn vị dựa theo id_PhongBan
                    $select_donvi = DonVi::where('id_PB', $data['id_K'])->orderby('id', 'ASC')->get();
                    $output .= '<option>-----Chọn Đơn Vị-----</option>';
                    foreach ($select_donvi as $key => $donvi) {
                        $output .= '<option value="' . $donvi->id . '">' . $donvi->TenDV . '</option>';
                    }
                } else if ($data['action'] == "donvi") {
                    // Lấy danh sách phòng dựa theo id_DonVi
                    $select_phong = Phong::where('id_DV', $data['id_K'])->orderby('id', 'ASC')->get();
                    $output .= '<option>-----Chọn Phòng-----</option>';
                    foreach ($select_phong as $key => $phong) {
                        $output .= '<option value="' . $phong->id . '">' . $phong->TenP . '</option>';
                    }
                } else if ($data['action'] == "phong") {
                    // Lấy danh sách ngành dựa theo id_Phong
                    $select_nganh = Nganh::where('id_P', $data['id_K'])->orderby('id', 'ASC')->get();
                    $output .= '<option>-----Chọn Ngành-----</option>';
                    foreach ($select_nganh as $key => $nganh) {
                        $output .= '<option value="' . $nganh->id . '">' . $nganh->TenN . '</option>';
                    }
                } else if ($data['action'] == "nganh") {
                    // Lấy danh sách chuyên ngành dựa theo id_Nganh
                    $select_chuyennganh = ChuyenNganh::where('id_N', $data['id_K'])->orderby('id', 'ASC')->get();
                    $output .= '<option>-----Chọn Chuyên Ngành-----</option>';
                    foreach ($select_chuyennganh as $key => $chuyennganh) {
                        $output .= '<option value="' . $chuyennganh->id . '">' . $chuyennganh->TenCN . '</option>';
                    }
                }

                // Trả về output đã được tạo ra
                echo $output;
            }
        
        
    }
}
