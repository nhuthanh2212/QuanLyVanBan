<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoPhan extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenBP', 'slug', 'MoTaBP','TrangThai','id_PB'];
    protected $primaryKey = 'id';
    protected $table = 'bophan';

    public function phongban()
    {
        return $this->belongsTo(PhongBan::class, 'id_PB');
    }
}
