<?php

namespace App\Http\Controllers;

use App\Models\data_uji;
use App\Models\kriteria;
use App\Models\m_detail_pestisida;
use App\Models\value_data_uji;
use Illuminate\Http\Request;

class DataUjiController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    public function index()
    {
        //
        $data_uji = data_uji::with(['value.sub_kriteria' ])->get();
        $kriteria = kriteria::with('sub')->get();
        // dd($data_uji,$kriteria);
        return view('data_uji.index', compact('data_uji','kriteria'));
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
        //
        $data = $request->all();
        // dd($data);
        $data_uji = new data_uji();
        $data_uji->nama_data_uji = $data['nama_data_uji'];
        $data_uji->save();
        $id_data = $data_uji->id_data_uji;
        $dt = [];
        foreach($data['id_sub_kriteria'] as $key=>$id){
            $dt[]=[
                'id_data_uji' => $id_data,
                'id_sub_kriteria' => $id,
                'nilai_data_uji' => $data['nilai_data_uji'][$key]
            ];
        };

        // dd($dt);

        value_data_uji::insert($dt);
        // dd($data_uji->id_data_uji);
        return redirect()->route('data-uji')->with('status','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\data_uji  $data_uji
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data_uji = data_uji::with(['value.sub_kriteria' ])->findOrFail($request);
        return $data_uji;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\data_uji  $data_uji
     * @return \Illuminate\Http\Response
     */
    public function edit(data_uji $data_uji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\data_uji  $data_uji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, data_uji $data_uji)
    {
        //
         $data=data_uji::with(['value.sub_kriteria' ])->findOrFail($request->id_data_uji);
       $dataUpdate = $request->all();
    //    dd($data);
    //    $data->update($dataUpdate);
       foreach($dataUpdate['id_sub_kriteria'] as $key =>$v){
            if($dataUpdate['id_value_data_uji'][$key] != ''){
                $valUpdate = [
                        'id_data_uji' => $dataUpdate['id_data_uji'],
                        'id_sub_kriteria' => $dataUpdate['id_sub_kriteria'][$key],
                        'id_value_data_uji' => $dataUpdate['id_value_data_uji'][$key],
                        'nilai_data_uji' => $dataUpdate['nilai_data_uji'][$key],
                ];
                $value = value_data_uji::findOrFail($dataUpdate['id_value_data_uji'][$key]);
                // dd($valUpdate);
                $value->update($valUpdate);
                // dd($value);
            }
            if($dataUpdate['id_value_data_uji'][$key] == ''){
                $valUpdate = [
                        'id_data_uji' => $dataUpdate['id_data_uji'],
                        'id_sub_kriteria' => $dataUpdate['id_sub_kriteria'][$key],
                        'nilai_data_uji' => $dataUpdate['nilai_data_uji'][$key],
                ];
                value_data_uji::create($valUpdate);
            }

       };
       return redirect()->route('data-uji')->with('status','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\data_uji  $data_uji
     * @return \Illuminate\Http\Response
     */
    public function destroy($data_uji)
    {
         $data = data_uji::find($data_uji);
         $detail = m_detail_pestisida::where('id_data_uji',$data_uji)->delete();
        $data->delete();

        return redirect()->route('data-uji')->with('status','Data Berhasil di Hapus');
    }
}

