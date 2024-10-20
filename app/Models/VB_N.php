<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VB_N extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_VB', 'id_N'];
    protected $primaryKey = 'id';
    protected $table = 'vb_n';
}
