<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class penyakit extends Model
{
     use SoftDeletes;
    protected $table = 'penyakit';
    protected $primaryKey = 'id_penyakit';
    protected $fillable = ['nama_penyakir','img','ket_penyakit'];
    protected $dates = ['deleted_at'];

}
