<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenN', 'slug', 'MoTaN','TrangThai','id_BP'];
    protected $primaryKey = 'id';
    protected $table = 'nganh';
    public function bophan()
    {
        return $this->belongsTo(BoPhan::class, 'id_BP');
    }
    public function chuyennganh()
    {
        return $this->hasMany(ChuyenNganh::class, 'id_N');
    }
}
