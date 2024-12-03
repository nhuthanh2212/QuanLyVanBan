<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuKySo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_TK', 'public_Key','NgayKy','TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'chukyso';
    public function taikhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'id_TK');
    }
}
