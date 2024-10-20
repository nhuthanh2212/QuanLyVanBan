<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VB_PB extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['id_VB', 'id_PB'];
    protected $primaryKey = 'id';
    protected $table = 'vb_pb';
}
