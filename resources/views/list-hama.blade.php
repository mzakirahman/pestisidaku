@extends('layouts.app')

@section('content')

<div class="container text-center">
  <div class="row">

    <div class="col">
        <img src="{{asset('img/img5.png')}}" class="w-100 rounded-top" alt="">
            <a href="{{ route('daftar-penyakit') }}" class="btn btn-success w-100 rounded-0 rounded-bottom">Daftar Penyakit Padi</a>
    </div>

    <div class="col">
        <img src="{{asset('img/img4.jpg')}}" class="w-100 rounded-top" alt="">
            <a href="{{ route('daftar-hama') }}" class="btn btn-success w-100 rounded-0 rounded-bottom">Daftar Hama Padi</a>
    </div>

  </div>
</div>


@endsection