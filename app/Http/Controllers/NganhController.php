<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\Nganh;
use App\Models\BoPhan;

class NganhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nganh = Nganh::with('bophan')->orderBy('id','DESC')->get();
        return view('manager.nganh.list', compact('nganh'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bophan = BoPhan::orderBy('id','ASC')->get();
        return view('manager.nganh.create',compact('bophan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TenN' => 'required|unique:nganh',
            'MoTaN' => 'required',
            'id_BP' => 'required',
        ],
        [
            'TenN.unique' => 'Tên Ngành này đã có, vui lòng điền tên khác',
            'TenN.required' => 'Tên Ngành Phải Có',
            'MoTaN.required' => 'Mô Tả Ngành Phải Có',
           'id_BP.required' => ' Ngành Này Thuộc Bộ Phận Nào Phải Có',
            
        ]);
        $nganh = new Nganh();
        $nganh->TenN = $data['TenN'];
        $nganh->slug = str::slug($data['TenN']);
        $nganh->MoTaN = $data['MoTaN'];
        $nganh->id_BP = $data['id_BP'];
        $nganh->TrangThai = 1;
        $nganh->save();
        toastr()->success('Thêm Ngành Thành Công');
        return redirect()->route('nganh.index');
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
        $nganh = Nganh::find($id);
        $bophan = BoPhan::orderBy('id','ASC')->get();
        return view('manager.nganh.edit',compact('bophan','nganh'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenN' => 'required:nganh',
            'MoTaN' => 'required',
            'id_BP' => 'required',
        ],
        [
           
            'TenN.required' => 'Tên Ngành Phải Có',
            'MoTaN.required' => 'Mô Tả Ngành Phải Có',
           'id_BP.required' => ' Ngành Này Thuộc Bộ Phận Nào Phải Có',
            
        ]);
        $nganh = Nganh::find($id);
        $nganh->TenN = $data['TenN'];
        $nganh->slug = str::slug($data['TenN']);
        $nganh->MoTaN = $data['MoTaN'];
        $nganh->id_BP = $data['id_BP'];
        $nganh->TrangThai = $request->TrangThai;
        $nganh->save();
        toastr()->success('Cập Nhật Ngành Thành Công');
        return redirect()->route('nganh.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nganh = Nganh::find($id);
        $nganh->delete();
        toastr()->success('Xóa Ngành Thành Công');
        return redirect()->route('nganh.index');
    }
}
