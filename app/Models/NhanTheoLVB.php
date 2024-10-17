<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanTheoLVB extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_BH_LVB', 'noi_nhan'];
    protected $primaryKey = 'id';
    protected $table = 'nhanlvbtheobh';

}
