<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenN', 'slug', 'MoTaN','TrangThai','id_P'];
    protected $primaryKey = 'id';
    protected $table = 'nganh';
    public function phong()
    {
        return $this->belongsTo(Phong::class, 'id_P');
    }
    public function chuyennganh()
    {
        return $this->hasMany(ChuyenNganh::class, 'id_N');
    }
    public function vanBanDen()
    {
        return $this->belongsToMany(VanBanDen::class, 'Den_N', 'id_N', 'id_VB');
    }
}
