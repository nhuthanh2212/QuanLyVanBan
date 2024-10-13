<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongBan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenPB', 'slug', 'MoTaPB','TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'phongban';

    public function ban()
    {
        return $this->hasMany(Ban::class, 'id_PB');
    }
    
}
