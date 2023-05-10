@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between ">
        <h6 class="card shadow p-2 m-0 col">Selamat Datang Di Pestisidaku</h6>
        <a href="{{route('menu')}}" class="btn btn-outline-dark mx-1"> Back</a>
</div>

<div class="container-fluid">
<h2 class="display-3 text-center">Kontak Kami</h2>
<div class="row">
    <div class="col-6">
    <div class="p-3 border bg-light">
      <table class="table" border="0">
  <tbody>
    
    <tr>
      <th >ALAMAT</th>
      <td>:Jalan Keramat, Desa Sungai Siput, <br> Kec. Siak Kecil, Kab. Bengkalis</td>
    </tr>
    
    <tr>
      <th >TELEPON</th>
      <td>:0854XXXXYYYY</td>
    </tr>

    <tr>
      <th >EMAIL</th>
      <td>:balaipenyuluhpertanian@gmail.com</td>
    </tr>

    <tr>
      <th >INSTAGRAM</th>
      <td>:@BalaiPenyuluhPertanian</td>
    </tr>

    <tr>
      <th >YOUTUBE</th>
      <td>:BalaiPenyuluhPertanian</td>
    </tr>
  </tbody>
</table></div>
    </div>
    <div class="col-6">
    <div class="p-3 border bg-light">MAPS BALAI PENYULUH PERTANIAN</div>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.921113837383!2d102.13466021488058!3d1.215109499113715!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d155d0971e8007%3A0xcf0d6f3c49ad2356!2sUPT%20Balai%20Penyuluhan%20Pertanian%20(BPP)%20Siak%20Kecil!5e0!3m2!1sen!2sid!4v1669641407447!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    </div>
  </div>
</div>




<!-- <div class="container overflow-hidden">
  <div class="row gx-5">
    <div class="col">
     
    </div>
    <div class="col">
      
  </div>
</div> -->


@endsection