<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class secondary_fk extends Model
{
     use SoftDeletes;
    protected $table = 'm_secondary_faktor';
    protected $primaryKey = 'id_secondary_faktor';
    protected $fillable = ['id_hitung','id_data_uji','id_kriteria','nilai_secondary_faktor'];
    protected $dates = ['deleted_at'];

    public function hitung()
    {   
        return $this->belongsTo(hitung::class);
    }
}