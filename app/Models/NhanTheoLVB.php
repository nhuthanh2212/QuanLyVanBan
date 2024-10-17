<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanTheoLVB extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_LVB', 'id_Den','id_Gr'];
    protected $primaryKey = 'id';
    protected $table = 'nhantheolvb';

    public function noiden(){
        return $this->belongsToMany(PhongBan::class, 'noiden', 'id_LVB','id_Gr', 'id_Den');
    }
}
