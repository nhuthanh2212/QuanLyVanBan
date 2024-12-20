<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanBanAn extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_VB', 'id_TK'];
    protected $primaryKey = 'id';
    protected $table = 'vanbanan';
}
