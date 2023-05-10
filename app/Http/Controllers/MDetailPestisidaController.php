<?php

namespace App\Http\Controllers;

use App\Models\data_uji;
use App\Models\m_detail_pestisida;
use Illuminate\Http\Request;

class MDetailPestisidaController extends Controller
{
         /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detail = m_detail_pestisida::with('data_uji')->get();
        // dd($detail);
        $data_uji = data_uji::all();
        return view('pestisida.index',compact('detail','data_uji'));
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
        $data = new m_detail_pestisida();
        $data['id_data_uji'] = $request->id_data_uji;
        $data['ket_pestisida'] = $request->detail;
        if($request->file('img')){
            $file= $request->file('img');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $data['img']= $filename;
        }

        // $image_path = $request->file('img')->store('image', 'public');

        // $data = m_detail_pestisida::create([
        //     'id_data_uji' => $request->id_data_uji,
        //     'image' => $image_path,
        //     'ket_pestisida'=>$request->detail
        // ]);
        $data->save();
        return redirect()->route('pestisida');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\m_detail_pestisida  $m_detail_pestisida
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id=$request->get('id_detail_pestisida');
        $data = m_detail_pestisida::where('id_detail_pestisida',$id)->with('data_uji')->get();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\m_detail_pestisida  $m_detail_pestisida
     * @return \Illuminate\Http\Response
     */
    public function edit(m_detail_pestisida $m_detail_pestisida)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\m_detail_pestisida  $m_detail_pestisida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, m_detail_pestisida $m_detail_pestisida)
    {
       $data=m_detail_pestisida::findOrFail($request->id_detail_pestisida);
       $img = '';
    //    dd($request);
       if(empty($request->img)){
        $img = $request->img_old;
       }else{
        if($request->file('img')){
            $file= $request->file('img');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/Image'), $filename);
            $img= $filename;
        }
       }
        $dataUpdate = [
            'id_detail_pestisida'=>$request->id_detail_pestisida,
            'id_data_uji'=>$request->id_data_uji,
            'img'=>$img,
            'ket_pestisida'=>$request->detail
       ];
       $data->id_data_uji = $request->id_data_uji;
       $data->img = $img;
       $data->ket_pestisida = $request->detail;
        
    //    dd($dataUpdate);
    //    dd($data);
       $data->save();
       return redirect()->route('pestisida')->with('status','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\m_detail_pestisida  $m_detail_pestisida
     * @return \Illuminate\Http\Response
     */
    public function destroy($m_detail_pestisida)
    {
        $data = m_detail_pestisida::find($m_detail_pestisida);
        // dd($data);
        $data->delete();

        return redirect()->route('pestisida')->with('status','Data Berhasil di Hapus');
    }
}
