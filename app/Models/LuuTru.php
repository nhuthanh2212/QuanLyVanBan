<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuuTru extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_TK', 'id_VB'];
    protected $primaryKey = 'id_luu';
    protected $table = 'luu_tru';
}
