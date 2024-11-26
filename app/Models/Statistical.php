<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_LVB', 'id_Gr','date','total_LVB','total_Gr'];
    protected $primaryKey = 'id';
    protected $table = 'statistical';
}
