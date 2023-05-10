<?php

namespace App\Http\Controllers;

use App\Models\hama;
use Illuminate\Http\Request;

class HamaController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $hama = hama::all();
        // dd($kriteria);
        return view('hama.index', compact('hama'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
         $hama = hama::all();
        // dd($kriteria);
        return view('hama.index_client', compact('hama'));
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
        $data = new hama();
        $data['nama_hama'] = $request->nama_hama;
        $data['ket_hama'] = $request->ket_hama;
        if($request->file('img')){
            $file= $request->file('img');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/hama'), $filename);
            $data['img']= $filename;
        }

        // $image_path = $request->file('img')->store('image', 'public');

        // $data = m_detail_pestisida::create([
        //     'id_data_uji' => $request->id_data_uji,
        //     'image' => $image_path,
        //     'ket_pestisida'=>$request->detail
        // ]);
        $data->save();
        return redirect()->route('hama');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hama  $hama
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $id_hama=$request->get('id_hama');
        $data = hama::where('id_hama',$id_hama)->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hama  $hama
     * @return \Illuminate\Http\Response
     */
    public function edit(hama $hama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hama  $hama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hama $hama)
    {
       $data=hama::findOrFail($request->id_hama);
       $dataUpdate = $request->all();
       $data->update($dataUpdate);
    //    dd($data);
       return redirect()->route('hama')->with('status','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hama  $hama
     * @return \Illuminate\Http\Response
     */
    public function destroy($hama)
    {
        $data = hama::find($hama);
        $data->delete();

        return redirect()->route('hama')->with('status','Data Berhasil di Hapus');
    }
}
