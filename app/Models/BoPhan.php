<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoPhan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenBP', 'slug', 'MoTaBP','TrangThai','id_B'];
    protected $primaryKey = 'id';
    protected $table = 'bophan';

    public function bannganh()
    {
        return $this->belongsTo(Ban::class, 'id_B');
    }
    public function nganh()
    {
        return $this->hasMany(Nganh::class, 'id_BP');
    }
}
