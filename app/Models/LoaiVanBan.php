<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiVanBan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenLVB', 'MoTaLVB', 'TrangThai','ky_tu'];
    protected $primaryKey = 'id_LVB';
    protected $table = 'loaivanban';
    public function vanbandi()
    {
        return $this->hasMany(VanBanDi::class, 'id_LVB');
    }
}
