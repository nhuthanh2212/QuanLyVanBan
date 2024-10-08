<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VanBanDi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenVB', 'SoHieu', 'id_LVB','NgayGui','id_Tk','file'];
    protected $primaryKey = 'id';
    protected $table = 'vanbandi';
}
