<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanBanDen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['NoiDung','GhiChu', 'SoHieu', 'id_LVB','NgayNhan','id_Gr','NgayBH','file','TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'vanbanden';

    public function denphongban(){
        return $this->belongsToMany(Phongban::class, 'Den_PB', 'id_VB', 'id_PB');
    }
    public function dendonvi(){
        return $this->belongsToMany(DonVi::class, 'Den_DV', 'id_VB', 'id_DV');
    }
    public function denphong(){
        return $this->belongsToMany(Phong::class, 'Den_P', 'id_VB', 'id_P');
    }
    public function dennganh(){
        return $this->belongsToMany(Nganh::class, 'Den_N', 'id_VB', 'id_N');
    }
    public function denchuyennganh(){
        return $this->belongsToMany(ChuyenNganh::class, 'Den_CN', 'id_VB', 'id_CN');
    }
}
