<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhucVu extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenPPV', 'MoTaPPV', 'TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'phucvu';
}
