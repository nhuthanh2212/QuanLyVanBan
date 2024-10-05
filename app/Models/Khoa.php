<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenKhoa', 'MoTaKhoa', 'TrangThai','id_Truong'];
    protected $primaryKey = 'id';
    protected $table = 'khoa';

    // Mỗi khoa thuộc về một trường
    public function truong()
    {
        return $this->belongsTo(Truong::class, 'id_Truong');
    }
}
