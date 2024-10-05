<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrungTam extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenTT', 'MoTaTT', 'TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'trungtam';
}
