<?php

namespace App\Models;
use App\Models\data_uji;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class m_detail_pestisida extends Model
{
     use SoftDeletes;
    protected $table = 'm_detail_pestisida';
    protected $primaryKey = 'id_detail_pestisida';
    protected $fillable = ['id_data_uji','img','ket_detail_pestisida'];
    protected $dates = ['deleted_at'];

    public function data_uji()
    {   
        return $this->belongsTo(data_uji::class,'id_data_uji','id_data_uji');
    }
}
