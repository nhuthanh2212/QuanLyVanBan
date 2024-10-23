<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VB_Mau extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenVB', 'id_LVB','id_Gr','file','TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'vanbanmau';

    public function nhom()
    {
        return $this->belongsTo(Nhom::class, 'id_Gr');
    }
    public function loaivanban()
    {
        return $this->belongsTo(LoaiVanBan::class, 'id_LVB');
    }
}
