<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiKhoan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['HoTen', 'slug', 'NamSinh','DienThoai','Gmail', 'GioiTinh','DiaChi','id_PB','id_CV','TenDN','password','id_VaiTro'];
    protected $primaryKey = 'id_TK';
    protected $table = 'taikhoan';
}
