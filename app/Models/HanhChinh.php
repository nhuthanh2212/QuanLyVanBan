<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HanhChinh extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenP', 'MoTaP', 'TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'hanhchinh';
}
