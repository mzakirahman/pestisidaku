@extends('layouts.app')

@section('content')

<div class=" text-center">
    <h3>SISTEM PENDUKUNG KEPUTUSAN</h3>
    <h3>PEMILIHAN PESTISIDA HAMA TANAMAN PADI</h3>
    <h3>MENGGUNAKAN METODE PROFILE MATCHING</h3>
    <img src="{{ asset('img/intro.PNG') }}" class="img-responsive" alt="">
</div>
        
<div class="d-flex justify-content-end  pt-5 mt-5 px-2">
    <a href="{{ route('menu') }}"><button type="button" class="btn btn-outline-success"><marquee direction=”right”>LANJUTKAN DISINI </marquee></button></a>
</div>        



@endsection