<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenP', 'slug', 'MoTaP','TrangThai','id_DV'];
    protected $primaryKey = 'id';
    protected $table = 'phong';
    public function donvi()
    {
        return $this->belongsTo(DonVi::class, 'id_DV');
    }
    public function nganh()
    {
        return $this->hasMany(Nganh::class, 'id_P');
    }
}
