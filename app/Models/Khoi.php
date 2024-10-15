<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenK', 'slug', 'MoTaK','TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'khoi';

    public function phongban()
    {
        return $this->hasMany(PhongBan::class, 'id_K');
    }
    
}
