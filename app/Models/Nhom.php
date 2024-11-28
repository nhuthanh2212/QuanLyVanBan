<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhom extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_K', 'id_PB', 'id_DV', 'id_P','id_N','id_CN','TenGroup'];
    protected $primaryKey = 'id';
    protected $table = 'nhom';

    public function khoi(){
        return $this->belongsTo(Khoi::class, 'id_K');
    }
    public function phongban(){
        return $this->belongsTo(PhongBan::class, 'id_PB');
    }
    public function donvi(){
        return $this->belongsTo(DonVi::class, 'id_DV');
    }
    public function phong(){
        return $this->belongsTo(Phong::class, 'id_P');
    }
    public function nganh(){
        return $this->belongsTo(Nganh::class, 'id_N');
    }
    public function chuyennganh(){
        return $this->belongsTo(ChuyenNganh::class, 'id_CN');
    }

    public function taikhoan()
    {
        return $this->hasMany(TaiKhoan::class, 'id_Gr');
    }
    public function noinhan()
    {
        return $this->hasMany(LVBTheoDVHB::class, 'id_Gr');
    }
}
