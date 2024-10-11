<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Models\TaiKhoan;
use App\Models\ChucVu;


use Auth;

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
        $chucvu = ChucVu::orderBy('id','ASC')->get();
        return view('manager.user.create',compact('chucvu'));
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
        $chucvu = ChucVu::orderBy('id','ASC')->get();
        return view('manager.user.edit',compact('tk','chucvu'));
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
    
}
