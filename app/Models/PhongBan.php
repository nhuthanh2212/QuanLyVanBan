<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenPB', 'slug', 'MoTaPB','TrangThai','id_K'];
    protected $primaryKey = 'id';
    protected $table = 'phongban';
    public function khoi()
    {
        return $this->belongsTo(Khoi::class, 'id_K');
    }
    public function donvi()
    {
        return $this->hasMany(DonVi::class, 'id_PB');
    }
    public function vanBanDen()
    {
        return $this->belongsToMany(VanBanDen::class, 'Den_PB', 'id_PB', 'id_VB');
    }
}
