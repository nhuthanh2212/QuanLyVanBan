<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BH_N extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_BH_LVB', 'id_N'];
    protected $primaryKey = 'id';
    protected $table = 'bh_n';
}
