<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChucVu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenCV', 'MoTaCV', 'TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'chucvu';

    public function taikhoan()
    {
        return $this->hasMany(TaiKhoan::class, 'id_CV');
    }
}
