<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonViCapCao extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenDV', 'MoTaDV', 'TrangThai'];
    protected $primaryKey = 'id_DV';
    protected $table = 'donvicapcao';
}
