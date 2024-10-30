<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonVi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenDV', 'slug', 'MoTaDV','TrangThai','id_PB'];
    protected $primaryKey = 'id';
    protected $table = 'donvi';

    public function PhongBan()
    {
        return $this->belongsTo(PhongBan::class, 'id_PB');
    }
    public function phong()
    {
        return $this->hasMany(Phong::class, 'id_DV');
    }
    public function vanBanDen()
    {
        return $this->belongsToMany(VanBanDen::class, 'Den_DV', 'id_DV', 'id_VB');
    }
}
