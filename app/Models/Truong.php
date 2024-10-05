<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truong extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['Tentruong', 'MoTaTruong', 'TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'truong';

    // Một trường có nhiều khoa
    public function khoa()
    {
        return $this->hasMany(Khoa::class, 'id_Truong');
    }
}
