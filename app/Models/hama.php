<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hama extends Model
{
     use SoftDeletes;
    protected $table = 'm_hama';
    protected $primaryKey = 'id_hama';
    protected $fillable = ['nama_hama','img','ket_hama'];
    protected $dates = ['deleted_at'];

}
