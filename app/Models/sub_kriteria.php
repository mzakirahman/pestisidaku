<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class sub_kriteria extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'pm_sub_kriteria';
    protected $primaryKey = 'id_sub_kriteria';
    protected $fillable = ['id_kriteria','kode_sub_kriteria','nama_sub_kriteria','profil_ideal','faktor'];
    protected $dates = ['deleted_at'];

    public function value()
    {
        return $this->hasMany(value_data_uji::class,'id_sub_kriteria');
    }
    public function gap()
    {
        return $this->hasMany(gap::class,'id_sub_kriteria','id_sub_kriteria');
    }
    public function value_set()
    {
        return $this->hasMany(value_set::class,'id_sub_kriteria','id_sub_kriteria');
    }
    public function kriteria()
    {
        return $this->belongsTo(kriteria::class,'id_kriteria','id_kriteria');
    }
}
