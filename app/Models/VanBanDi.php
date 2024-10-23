<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanBanDi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['NoiDung','GhiChu', 'SoHieu', 'id_LVB','NgayGui','id_Tk','id_Gr','NgayBH','file','TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'vanbandi';

    public function denphongban(){
        return $this->belongsToMany(Phongban::class, 'VB_PB', 'id_VB', 'id_PB');
    }
    public function dendonvi(){
        return $this->belongsToMany(DonVi::class, 'VB_DV', 'id_VB', 'id_DV');
    }
    public function denphong(){
        return $this->belongsToMany(Phong::class, 'VB_P', 'id_VB', 'id_P');
    }
    public function dennganh(){
        return $this->belongsToMany(Nganh::class, 'VB_N', 'id_VB', 'id_N');
    }
    public function denchuyennganh(){
        return $this->belongsToMany(ChuyenNganh::class, 'VB_CN', 'id_VB', 'id_CN');
    }
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'id_TK');
    }
    public function nhom()
    {
        return $this->belongsTo(Nhom::class, 'id_Gr');
    }
}
