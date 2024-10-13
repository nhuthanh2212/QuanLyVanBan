<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChuyenNganh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenCN', 'slug', 'MoTaCN','TrangThai','id_N'];
    protected $primaryKey = 'id';
    protected $table = 'chuyennganh';
    public function nganh()
    {
        return $this->belongsTo(Nganh::class, 'id_N');
    }
   
}
