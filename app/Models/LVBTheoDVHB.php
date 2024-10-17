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
        return $this->belongsToMany(Phongban::class, 'nhanlvbtheobh', 'id_BH_LVB', 'noi_nhan');
    }
    public function nhandonvitheolvb(){
        return $this->belongsToMany(DonVi::class, 'nhanlvbtheobh', 'id_BH_LVB', 'noi_nhan');
    }
    public function nhanphongtheolvb(){
        return $this->belongsToMany(Phong::class, 'nhanlvbtheobh', 'id_BH_LVB', 'noi_nhan');
    }
    public function nhannganhtheolvb(){
        return $this->belongsToMany(Nganh::class, 'nhanlvbtheobh', 'id_BH_LVB', 'noi_nhan');
    }
    public function nhanchuyennganhtheolvb(){
        return $this->belongsToMany(ChuyenNganh::class, 'nhanlvbtheobh', 'id_BH_LVB', 'noi_nhan');
    }
}
