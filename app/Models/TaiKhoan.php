<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    use HasFactory;
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
