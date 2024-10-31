<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class TaiKhoan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    protected $guard_name = 'web'; // Explicitly set the guard name
    public $timestamps = false;
    protected $fillable = ['HoTen', 'slug', 'NamSinh','DienThoai','Gmail', 'GioiTinh','DiaChi','img','id_Gr','id_CV','TenDN','password'];
    protected $primaryKey = 'id_TK';
    protected $table = 'taikhoan';
    public function chucvu()
    {
        return $this->belongsTo(ChucVu::class, 'id_CV');
    }
    public function nhom()
    {
        return $this->belongsTo(Nhom::class, 'id_Gr');
    }
}
