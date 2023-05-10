<?php

namespace App\Http\Controllers;

use App\Models\sub_kriteria;
use App\Models\kriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
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
        //
        // $sub_kriteria = sub_kriteria::all();
        $sub_kriteria = sub_kriteria::join('pm_kriteria', 'pm_kriteria.id_kriteria', '=', 'pm_sub_kriteria.id_kriteria')->get(['pm_sub_kriteria.*', 'pm_kriteria.nama_Kriteria']);
        $kriteria = kriteria::all();
        // dd($sub_kriteria);
        return view('sub_kriteria.index', compact('sub_kriteria','kriteria'));
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
         $data =$request->all();
        // dd($data);
        $sub_kriteria = sub_kriteria::create($data);

       return redirect()->route('sub-kriteria')->with('status','Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sub_kriteria  $sub_kriteria
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
         $id_sub_kriteria=$request->get('id_sub_kriteria');
        $data = sub_kriteria::where('id_sub_kriteria',$id_sub_kriteria)->get();
        // dd($id_kriteria);
        // $data = kriteria::firstWhere('id_kriteria', $id_kriteria);
        // dd($data);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sub_kriteria  $sub_kriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(sub_kriteria $sub_kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sub_kriteria  $sub_kriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sub_kriteria $sub_kriteria)
    {
        $data=sub_kriteria::findOrFail($request->id_sub_kriteria);
       $dataUpdate = $request->all();
       $data->update($dataUpdate);
    //    dd($data);
       return redirect()->route('sub-kriteria')->with('status','Data Berhasil di Ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sub_kriteria  $sub_kriteria
     * @return \Illuminate\Http\Response
     */
    public function destroy($sub_kriteria)
    {
        //
        $data = sub_kriteria::find($sub_kriteria);
        $data->delete();

        return redirect()->route('sub-kriteria')->with('status','Data Berhasil di Hapus');
    }
}
