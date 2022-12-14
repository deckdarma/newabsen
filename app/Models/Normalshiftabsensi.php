<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Normalshiftabsensi extends BaseModel
{

    // Don't forget to fill this array
    protected $fillable = ['id','nama_event', 'date', 
'jam_masuk',
'jam_akhir_masuk',
'jam_pulang',
'jam_akhir_pulang',


'id_ONTIME',
'ONTIME_masuk',
'ONTIME_pulang',



'id_SKOR1',
'SKOR1_masuk',
'SKOR1_pulang',


'id_SKOR2',
'SKOR2_masuk',
'SKOR2_pulang',


'id_SKOR3',
'SKOR3_masuk',
'SKOR3_pulang',


'id_SKOR4',
'SKOR4_masuk',
'SKOR4_pulang',


'jam_masuk_jumat',
'jam_akhir_masuk_jumat',
'jam_pulang_jumat',
'jam_akhir_pulang_jumat',


'id_jumat_ONTIME',
'ONTIME_masuk_jumat',
'ONTIME_pulang_jumat',



'id_jumat_SKOR1',
'SKOR1_masuk_jumat',
'SKOR1_pulang_jumat',


'id_jumat_SKOR2',
'SKOR2_masuk_jumat',
'SKOR2_pulang_jumat',


'id_jumat_SKOR3',
'SKOR3_masuk_jumat',
'SKOR3_pulang_jumat',


'id_jumat_SKOR4',
'SKOR4_masuk_jumat',
'SKOR4_pulang_jumat'];


   
}
