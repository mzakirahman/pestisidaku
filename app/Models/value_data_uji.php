<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class value_data_uji extends Model
{
    // use HasFactory;
    use SoftDeletes;
    protected $table = 'm_value_data_uji';
    protected $primaryKey = 'id_value_data_uji';
    protected $fillable = ['id_data_uji','id_sub_kriteria','nilai_data_uji'];
    protected $dates = ['deleted_at'];

    public function data_uji()
    {   
        return $this->belongsTo(data_uji::class);
    }

    public function sub_kriteria()
    {
        // return $this->belongsTo('App\Models\data_uji', 'id_data_uji');
   
        return $this->belongsTo(sub_kriteria::class,'id_sub_kriteria');
    }
}