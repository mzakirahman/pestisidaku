<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class kriteria extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'pm_kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $fillable = ['kode_kriteria','nama_kriteria','bobot'];
    protected $dates = ['deleted_at'];


     public function sub()
    {
        // $valu_dt = new value_data_uji;
        return $this->hasMany(sub_kriteria::class,'id_kriteria','id_kriteria');
    }
}
