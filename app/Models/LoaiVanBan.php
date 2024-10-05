<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiVanBan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenLVB', 'MoTaLVB', 'TrangThai'];
    protected $primaryKey = 'id_LVB';
    protected $table = 'loaivanban';
}
