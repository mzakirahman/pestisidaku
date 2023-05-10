@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow border-0 p-2">
                    <h3>Selamat Datang {{ Auth::user()->name }} Dihalaman Administrator</h3>
            </div>
            <div class="d-flex py-2 text-light">
                <div class="card col shadow border-0 p-2 m-1">
                    <img src="{{ asset('img/img1.jpg') }}" class="w-100 img-responsive" alt="">
                {{-- <h5>Data Uji Alternatif</h5> --}}
                {{-- <div class="display-4"><i class="bi bi-folder2-open "></i>{{$data_uji}} Data</div> --}}
            </div>
            <div class="card col shadow border-0 p-2 m-1">
                <div class="card bg-info col shadow border-0 p-2 m-1">
                <h5>Data Uji Alternatif</h5>
                <div class="display-4"><i class="bi bi-folder2-open "></i>{{$data_uji}} Data</div>
            </div>
            <div class="card col shadow border-0 p-2 m-1">
                <div class="card bg-danger col shadow border-0 p-2 m-1">
                <h5>Kriteria</h5>
                <div class="display-4"><i class="bi bi-folder2-open "></i>{{$kriteria}} Data</div>
            </div>
            <div class="card col shadow border-0 p-2 m-1">
                <div class="card bg-success col shadow border-0 p-2 m-1">
                <h5>Sub Kriteria</h5>
                <div class="display-4"><i class="bi bi-folder2-open "></i>{{$sub_kriteria}} Data</div>
            </div>
            <div class="card col shadow border-0 p-2 m-1">
                <div class="card bg-warning col shadow border-0 p-2 m-1">
                <h5>Pencarian Rekomendasi</h5>
                <div class="display-4"><i class="bi bi-folder2-open "></i>{{$hitung}} Data</div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
