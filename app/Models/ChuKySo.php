<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuKySo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_TK', 'public_Key', 'TrangThai','NgayKy'];
    protected $primaryKey = 'id';
    protected $table = 'chukyso';
}
