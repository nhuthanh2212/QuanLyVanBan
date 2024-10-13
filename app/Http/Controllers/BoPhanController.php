<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

use App\Models\BoPhan;
use App\Models\Ban;

class BoPhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bophan = BoPhan::with('bannganh')->orderBy('id','ASC')->get();
        return view('manager.bophan.list',compact('bophan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ban = Ban::orderBy('id','ASC')->get();
        return view('manager.bophan.create', compact('ban'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            'TenBP' => 'required|unique:bophan',
            'MoTaBP' => 'required',
            'id_B' => 'required',
        ],
        [
            'TenBP.unique' => 'Tên bộ phận này đã có, vui lòng điền tên khác',
            'TenBP.required' => 'Tên Bộ Phận Phải Có',
            'MoTaBP.required' => 'Mô Tả Bộ Phận Phải Có',
           'id_B.required' => ' Bộ Phận Này Thuộc Ban Ngành Nào Phải Có',
            
        ]);
        $bophan = new BoPhan();
        $bophan->TenBP = $data['TenBP'];
        $bophan->slug = str::slug($data['TenBP']);
        $bophan->MoTaBP = $data['MoTaBP'];
        $bophan->id_B = $data['id_B'];
        $bophan->TrangThai = 1;
        $bophan->save();
        toastr()->success('Thêm Bộ Phận Thành Công');
        return redirect()->route('bo-phan.index');
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
        $bophan = BoPhan::find($id);
        $ban = Ban::orderBy('id','ASC')->get();
        return view('manager.bophan.edit', compact('ban', 'bophan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'TenBP' => 'required:bophan',
            'MoTaBP' => 'required',
            'id_B' => 'required',
        ],
        [
           
            'TenBP.required' => 'Tên Bộ Phận Phải Có',
            'MoTaBP.required' => 'Mô Tả Bộ Phận Phải Có',
           'id_B.required' => ' Bộ Phận Này Thuộc Ban Ngành Nào Phải Có',
            
        ]);
        $bophan = BoPhan::find($id);
        $bophan->TenBP = $data['TenBP'];
        $bophan->slug = str::slug($data['TenBP']);
        $bophan->MoTaBP = $data['MoTaBP'];
        $bophan->id_B = $data['id_B'];
        $bophan->TrangThai = $request->TrangThai;
        $bophan->save();
        toastr()->success('Cập Nhật Bộ Phận Thành Công');
        return redirect()->route('bo-phan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bophan = BoPhan::find($id);
        $bophan->delete();
        toastr()->success('Xóa Bộ Phận Thành Công');
        return redirect()->route('bo-phan.index');
    }
}
