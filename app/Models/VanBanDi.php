<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanBanDi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenVB','slug', 'SoHieu', 'id_LVB','NgayGui','id_Tk','file'];
    protected $primaryKey = 'id';
    protected $table = 'vanbandi';

    public function noiden(){
        return $this->belongsToMany(DonViCapCao::class, 'noiden', 'id_VB', 'id_Den');
    }
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'id_TK');
    }
}
