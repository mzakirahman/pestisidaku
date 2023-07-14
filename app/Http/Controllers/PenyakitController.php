<?php

namespace App\Http\Controllers;

use App\Models\penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $penyakit = penyakit::all();
        // dd($kriteria);
        return view('penyakit.index', compact('penyakit'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {
         $penyakit = penyakit::all();
        // dd($kriteria);
        return view('penyakit.index_client', compact('penyakit'));
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
        $data = new penyakit();
        $data['nama_penyakit'] = $request->nama_penyakit;
        $data['ket_penyakit'] = $request->ket_penyakit;
        if($request->file('img')){
            $file= $request->file('img');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/penyakit'), $filename);
            $data['img']= $filename;
        }

        // $image_path = $request->file('img')->store('image', 'public');

        // $data = m_detail_pestisida::create([
        //     'id_data_uji' => $request->id_data_uji,
        //     'image' => $image_path,
        //     'ket_pestisida'=>$request->detail
        // ]);
        $data->save();
        return redirect()->route('penyakit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
         $id_penyakit=$request->get('id_penyakit');
        $data = penyakit::where('id_penyakit',$id_penyakit)->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function edit(penyakit $penyakit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penyakit $penyakit)
    {
       $data=penyakit::findOrFail($request->id_penyakit);
       $dataUpdate = $request->all();
       $data->update($dataUpdate);
    //    dd($data);
       return redirect()->route('penyakit')->with('status','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penyakit  $penyakit
     * @return \Illuminate\Http\Response
     */
    public function destroy($penyakit)
    {
        $data = penyakit::find($penyakit);
        $data->delete();

        return redirect()->route('penyakit')->with('status','Data Berhasil di Hapus');
    }
}
