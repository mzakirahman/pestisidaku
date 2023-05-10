<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class hitung_gap extends Model
{
     use SoftDeletes;
    protected $table = 'm_pemetaan_gap';
    protected $primaryKey = 'id_pemetaan_gap';
    protected $fillable = ['id_hitung','id_data_uji','id_sub_kriteria','nilai_gap'];
    protected $dates = ['deleted_at'];

    public function hitung()
    {   
        return $this->belongsTo(hitung::class);
    }
    public function sub()
    {   
        return $this->belongsTo(sub_kriteria::class,'id_sub_kriteria');
    }
}