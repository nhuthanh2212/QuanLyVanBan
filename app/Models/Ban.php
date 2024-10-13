<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenB', 'slug', 'MoTaB','TrangThai','id_PB'];
    protected $primaryKey = 'id';
    protected $table = 'ban';
    public function phongban()
    {
        return $this->belongsTo(PhongBan::class, 'id_PB');
    }
    public function bophan()
    {
        return $this->hasMany(BoPhan::class, 'id_B');
    }
}
