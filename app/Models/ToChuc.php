<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToChuc extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['TenTC', 'MoTaTC', 'TrangThai'];
    protected $primaryKey = 'id';
    protected $table = 'tochuc';
}
