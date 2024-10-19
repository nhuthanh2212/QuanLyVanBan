<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LVBTheoDVHB extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_LVB', 'id_Gr'];
    protected $primaryKey = 'id';
    protected $table = 'lvb_bh';

    public function nhantheolvb(){
        return $this->belongsToMany(Phongban::class, 'BH_PB', 'id_BH_LVB', 'id_PB');
    }
    public function nhandonvitheolvb(){
        return $this->belongsToMany(DonVi::class, 'BH_DV', 'id_BH_LVB', 'id_DV');
    }
    public function nhanphongtheolvb(){
        return $this->belongsToMany(Phong::class, 'BH_P', 'id_BH_LVB', 'id_P');
    }
    public function nhannganhtheolvb(){
        return $this->belongsToMany(Nganh::class, 'BH_N', 'id_BH_LVB', 'id_N');
    }
    public function nhanchuyennganhtheolvb(){
        return $this->belongsToMany(ChuyenNganh::class, 'BH_CN', 'id_BH_LVB', 'id_CN');
    }
}
