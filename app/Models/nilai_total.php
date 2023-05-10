<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class nilai_total extends Model
{
     use SoftDeletes;
    protected $table = 'm_nilai_total';
    protected $primaryKey = 'id_nilai_total';
    protected $fillable = ['id_hitung','id_data_uji','id_kriteria','nilai_nilai_total'];
    protected $dates = ['deleted_at'];

    public function hitung()
    {   
        return $this->belongsTo(hitung::class);
    }
}