<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoiDen extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_VB', 'id_Den'];
    protected $primaryKey = 'id';
    protected $table = 'noiden';
}
