<?php

namespace App\Http\Controllers;

use App\Models\bobot_selisih;
use App\Models\core_fk;
use App\Models\hitung;
use App\Models\kriteria;
use App\Models\data_uji;
use App\Models\hitung_gap;
use App\Models\hitung_selisih;
use App\Models\m_detail_pestisida;
use App\Models\nilai_akhir;
use App\Models\nilai_total;
use App\Models\secondary_fk;
use App\Models\sub_kriteria;
use App\Models\value_data_uji;
use Illuminate\Http\Request;

class HitungController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = kriteria::with(['sub.value_set'])->get();
        // dd($kriteria);
        return view('hitung.index', compact('kriteria'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('max_execution_time', 0);
        $data = $request->all();
        $subK = sub_kriteria::with('kriteria')->get();
        $selisih_user = [];
        $pemetaan_user = [];
        $faktor_user = [];
        // Selisih Nilai User
        foreach($subK as $k){
            $sel = $data['kode_data'][$k->kode_sub_kriteria]-$k->profil_ideal; 
            $tmp = [
                'id_kriteria' =>$k->id_kriteria,
                'faktor' =>$k->faktor,
                'kode_sub' =>$k->kode_sub_kriteria,
                'selisih' =>$sel
            ];
            array_push($selisih_user,$tmp);
        }
        // Pemetaan NIlai Gap User
        foreach($selisih_user as $su){
            $p = bobot_selisih::where('selisih',$su['selisih'])->get();
              $tmp = [
                'id_kriteria' =>$su['id_kriteria'],
                'faktor' =>$su['faktor'],
                'kode_sub' =>$su['kode_sub'],
                'pemetaan' =>$p[0]->nilai_pembobotan
            ]; 
            array_push($pemetaan_user,$tmp);
        }
        // Core dan Secondary Faktor User
        $kriteria_u = kriteria::all();
        foreach($kriteria_u as $k){
                $tmp_core = 0 ;
                $tmp_secondary = 0;
                $jmlCore = 0;
                $jmlSecnd = 0;
                $core ='';
                $second = '';
            foreach($pemetaan_user as $pu){
                if($pu['id_kriteria']==$k->id_kriteria){
                    if($pu['faktor']=='core'){
                        $tmp_core += $pu['pemetaan'];
                        $jmlCore++;
                    }
                    if($pu['faktor']=='secondary'){
                        $tmp_secondary += $pu['pemetaan'];
                        $jmlSecnd++;
                    }
                }
            }

            if($tmp_core != 0){
                $core = $tmp_core/$jmlCore;
            }
            if($tmp_core == 0){
                $core = $tmp_core;
            }
            if($tmp_secondary !=0){
                 $second = $tmp_secondary/$jmlSecnd;
            }
            if($tmp_secondary ==0){
                $second =  $tmp_secondary;
            }
            $f_result = 0;
              if($core ==0 && $second ==0){
                    $f_result = $core +$second;
                }
                if($core ==0 ){
                    $f_result = $core +(($second*40)/100);
                }
                if($second ==0 ){
                    $f_result = (($core*60)/100) +$second;
                }
                if($second !=0 && $second != 0 ){
                    $f_result = (($core*60)/100) +(($second*40)/100);
                }

            $tmp = [
                'id_kriteria' => $k->id_kriteria,
                'total' => $f_result
            ]; 
            array_push($faktor_user,$tmp);
        }
        // Nilai Akhir User
        $nilai_akhir_u =0;
        foreach($faktor_user as $tu){
            $bobot = kriteria::where('id_kriteria',$tu['id_kriteria'])->get();
            $nt = $tu['total']*$bobot[0]->bobot;
            $nilai_akhir_u +=$nt;
        }

        
        $data_encode = json_encode($data['kode_data']);
        $hitung = new hitung();
        $hitung->kode_data = $data_encode;
        $hitung->save();
        $id_hitung = $hitung->id_hitung;
        $result = [];
        $tmp_selisih = [];
        $tmp_gap = [];
        $subKriteria = [];
        $dataU=data_uji::all();
        foreach($dataU as $kd){
            $val_dt=value_data_uji::where('id_data_uji',$kd->id_data_uji)->get();
            foreach($val_dt as $val){
                array_push($result,$val);
            }
        }
        $sk=sub_kriteria::all();

    //    Selisih Gap
        foreach($sk as $sk){
            foreach($result as $rst){
                    if($rst->id_sub_kriteria == $sk['id_sub_kriteria']){
                    $selisih = $rst->nilai_data_uji - $sk['profil_ideal'];
                    $tmp = [
                        'id_hitung' => $id_hitung,
                        'id_data_uji' => $rst->id_data_uji,
                        'id_sub_kriteria' => $rst->id_sub_kriteria,
                        'nilai_selisih' => $selisih
                    ];
                    array_push($tmp_selisih,$tmp);
                 }
            };
        };
        // Pemetaan NIlai Gap
        hitung_selisih::insert($tmp_selisih);
        $selisih = hitung_selisih::where('id_hitung',$id_hitung)->get();

         foreach($selisih as $s){
            $bobot_selisih = bobot_selisih::where('selisih',$s->nilai_selisih)->get();
            $tmp = [
                 'id_hitung' => $id_hitung,
                 'id_data_uji' => $s->id_data_uji,
                 'id_sub_kriteria' => $s->id_sub_kriteria,
                 'nilai_gap' => $bobot_selisih[0]->nilai_pembobotan
             ];
             array_push($tmp_gap,$tmp);
         }
        //  Core Dan Secondary Faktor
         hitung_gap::insert($tmp_gap);
         $gaps = hitung_gap::with(['sub'])->where('id_hitung',$id_hitung)->get();
         $kriterias = kriteria::all();
         $dataUji = data_uji::all();
         foreach($kriterias as $kriteria){
            foreach($dataUji as $dtUji){
                $tmp_core = 0 ;
                $tmp_secondary = 0;
                $jmlCore = 0;
                $jmlSecnd = 0;
             foreach($gaps as $gap){
               if($gap->id_data_uji == $dtUji->id_data_uji){
                 if($gap->sub->id_kriteria == $kriteria->id_kriteria){
                    if($gap->sub->faktor == 'core'){
                        $jmlCore++;
                        $tmp_core += $gap->nilai_gap;
                    }
                    if($gap->sub->faktor == 'secondary'){
                        $jmlSecnd++;
                        $tmp_secondary += $gap->nilai_gap;
                    }
                }

               }
             }
            if($tmp_core != 0){
                $core = [
                 'id_hitung' => $id_hitung,
                 'id_data_uji' => $dtUji->id_data_uji,
                 'id_kriteria' => $kriteria->id_kriteria,
                 'nilai_core_faktor' => $tmp_core/$jmlCore
             ];
            }
            if($tmp_core == 0){
                $core = [
                 'id_hitung' => $id_hitung,
                 'id_data_uji' => $dtUji->id_data_uji,
                 'id_kriteria' => $kriteria->id_kriteria,
                 'nilai_core_faktor' => $tmp_core
             ];
            }
            if($tmp_secondary !=0){
                $second = [
                 'id_hitung' => $id_hitung,
                 'id_data_uji' => $dtUji->id_data_uji,
                 'id_kriteria' => $kriteria->id_kriteria,
                 'nilai_secondary_faktor' => $tmp_secondary/$jmlSecnd
             ];
            }
            if($tmp_secondary ==0){
                $second = [
                 'id_hitung' => $id_hitung,
                 'id_data_uji' => $dtUji->id_data_uji,
                 'id_kriteria' => $kriteria->id_kriteria,
                 'nilai_secondary_faktor' => $tmp_secondary
             ];
            }
             core_fk::insert($core);
             secondary_fk::insert($second);
            }
         }

         $faktor_c = core_fk::where('id_hitung',$id_hitung)->get();
         $faktor_s = secondary_fk::where('id_hitung',$id_hitung)->get();

        //  Nilai Total
         foreach($kriterias as $kriteria){
            foreach($dataUji as $dtUji){
                $temp_cf = 0;
                $temp_sf = 0;
                foreach($faktor_c as $cf){
                    if($cf->id_data_uji == $dtUji->id_data_uji){
                        if($cf->id_kriteria == $kriteria->id_kriteria){
                            $temp_cf = $cf->nilai_core_faktor;
                        }
                    }

                }
                foreach($faktor_s as $sf){
                    if($sf->id_data_uji == $dtUji->id_data_uji){
                        if($sf->id_kriteria == $kriteria->id_kriteria){
                            $temp_sf = $sf->nilai_secondary_faktor;
                        }
                    }

                }

                if($temp_cf ==0 && $temp_sf ==0){
                    $f_result = $temp_cf +$temp_sf;
                }
                if($temp_cf ==0 ){
                    $f_result = $temp_cf +(($temp_sf*40)/100);
                }
                if($temp_sf ==0 ){
                    $f_result = (($temp_cf*60)/100) +$temp_sf;
                }
                if($temp_cf !=0 && $temp_sf != 0 ){
                    $f_result = (($temp_cf*60)/100) +(($temp_sf*40)/100);
                }
                $nilai_total = [
                 'id_hitung' => $id_hitung,
                 'id_data_uji' => $dtUji->id_data_uji,
                 'id_kriteria' => $kriteria->id_kriteria,
                 'nilai_nilai_total' => $f_result
                ];
                nilai_total::insert($nilai_total);
            }
        }

        $total = nilai_total::where('id_hitung',$id_hitung)->get();
        // Nilai Akhir
        foreach($dataUji as $dtUji){
            $tmp_total = 0;
            foreach($total as $t){
                if($t->id_data_uji == $dtUji->id_data_uji){
                    foreach($kriterias as $k){
                        if($t->id_kriteria == $k->id_kriteria){
                           $tmp =  $t->nilai_nilai_total * $k->bobot;
                            $tmp_total += $tmp; 
                        }
                    }

                }
            }
            $nilai_akhir = [
                 'id_hitung' => $id_hitung,
                 'id_data_uji' => $dtUji->id_data_uji,
                 'nilai_nilai_akhir' => $tmp_total
                ];
            nilai_akhir::insert($nilai_akhir);
        }
        // Get data dengan nilai total berdasarkan nilai akhir user
        $result_final = nilai_akhir::where('id_hitung',$id_hitung)->where('nilai_nilai_akhir','<=',$nilai_akhir_u)->with('data_uji.detail')->orderBy('nilai_nilai_akhir','DESC')->limit(5)->get();
        
        return $result_final;

    }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hitung  $hitung
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $id=$request->get('id_data_uji');
         $data = m_detail_pestisida::where('id_data_uji',$id)->with('data_uji')->get();
        //  dd($data);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hitung  $hitung
     * @return \Illuminate\Http\Response
     */
    public function edit(hitung $hitung)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hitung  $hitung
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hitung $hitung)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hitung  $hitung
     * @return \Illuminate\Http\Response
     */
    public function destroy(hitung $hitung)
    {
        //
    }
}
