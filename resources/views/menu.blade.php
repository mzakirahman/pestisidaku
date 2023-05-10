@extends('layouts.app')

@section('content')

<div class="container text-center">
  <div class="row">
    <div class="col">
        <img src="{{asset('img/img2.jpg')}}" class="w-100 rounded-top" alt="">
            <a href="{{ route('hitung') }}" class="btn btn-success w-100 rounded-0 rounded-bottom">Perstisida Terbaik</a>
    </div>
    <div class="col">
        <img src="{{asset('img/img4.jpg')}}" class="w-100 rounded-top" alt="">
            <a href="{{ route('daftar-hama') }}" class="btn btn-success w-100 rounded-0 rounded-bottom">Daftar Hama Padi</a>
    </div>
    <div class="col">
        <img src="{{asset('img/informasi.png')}}" class="w-100 rounded-top" alt="">
        <a href="{{ route('info') }}" class="btn btn-success w-100 rounded-0 rounded-bottom">Informasi</a>
    </div>
  </div>
</div>


@endsection