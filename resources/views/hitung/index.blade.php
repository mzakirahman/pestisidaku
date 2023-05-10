@extends('layouts.app')
@section('head')
<link href="{{ asset('css/style.css') }}" rel="stylesheet"> 
@endsection
@section('content')
@php
    $result_final = '';
@endphp
<div class="container-fluid">
        <a href="{{route('menu')}}" class="btn btn-outline-dark mx-1">Back</a>

        <div style="display: none" id="load" class="loading ">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    <div class="p-2" id="main" style="display: block">
        {{-- <form action="{{ route('hitung/tambah-data/proses') }}" method="post"> --}}
        <form id="myForm" action="javascript:void(0)" method="post">
            {{ csrf_field() }}
        <div class="d-flex justify-content-between ">
            <h4>SELAMAT DATANG DI PESTISIDA KU</h4>
            <button class="btn btn-success" id="btn_sub" type="submit">Hasil</button>
        </div>
            <div class="row p-2">
                {{-- <div class="col-md-12 p-2"> --}}
                    @foreach($kriteria as $key=>$k)
                        @foreach($k->sub as $s)
                            <div class=" p-2 col-md-3 col-md-3" >
                                <label for="" class="fs-bold">{{$k->nama_kriteria}} {{$s->nama_sub_kriteria}}</label>
                                @forEach($s->value_set as $v)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="{{$v->value}}" name="kode_data[{{$s->kode_sub_kriteria}}]" id="kode_data_{{$s->kode_sub_kriteria}}" 
                                        @if ($v->value == 1) checked="true" @endif>
                                        <label class="form-check-label" for="kode_data_{{$s->kode_sub_kriteria}}">
                                            {{$v->keterangan_value}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @endforeach
                {{-- </div>   --}}
            </div>  
        </form>      
 </div>
 <div class="" id="res" style="display: none">
    <div class="d-flex justify-content-between ">
        <h6 class="card shadow p-2 m-0 col">Rekomendasi Pestisida Terbaik</h6>
        <button class="btn btn-outline-dark mx-1" id="btn_back" type="button">Back</button>

    </div>
    <div class="card shadow p-2 ">
        <table class="table " id="dtHorizontalExample" cellspacing="0"width="100%">
           <thead>
           </thead>
           <tbody id="hasil">
           </tbody>
        </table>
    </div>
 </div>


 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pestisida</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     <img src=""  id="preview" alt="" width="150px">
    <h4 id="title"></h4>
    <div class="" id="keterangan"></div>
      </div>
    </div>
  </div>
</div>
</div>




<script type="text/javascript">
$('#btn_back').on('click',function(event){
    $('#res').css("display", "none");
    $('#main').css("display", "block");
});

$('#btn_sub').on('click',function(event){
        $('#load').css("display", "block");
          var form=$('#myForm')[0];
            var data=new FormData(form);
            //  console.log(data)
            $.ajax({
            type:'POST',
            url:'{{ route('hitung/tambah-data/proses') }}',
            data:data,
            // dataType:'json',
            cache:false,
              contentType:false,
              processData:false,
            success:function(data){
                $('#myForm')[0].reset();
                // window.location.replace('/result')
                $('#res').css("display", "block");
                $('#load').css("display", "none");
                $('#main').css("display", "none");
                //  $('.hasil').html(data);
                createRes(data);
              console.log(data);
            },
            error:function(error){
                $('#res').css("display", "block");
                $('#load').css("display", "none");
                $('#main').css("display", "none");
            $('.hasil').html('Tidak Ada Hasil');
            console.log(error);
            }
          });
        //   }
      }
);

$(document).on('click','.modal_open',function(){
        var url = "hitung/get-data";
        var id= $(this).attr('value');
        // console.log(id);
        $.get(url + '?id_data_uji=' + id, function (data) {
            $('#title').html('');
            $('#keterangan').html('');
            $('#preview').attr('src','');
            //success data
            // console.log(data);
            $('#exampleModal').modal('show');
            $('#title').html(data[0].data_uji.nama_data_uji);
            $('#keterangan').html(data[0].ket_pestisida);
            var link ="{{ URL::asset('public/Image') }}/"+data[0].img;
            $('#preview').attr('src',link);
        }) 
    });


function createRes(data){
     var fieldHtml='';
        var wrapper_hasil=$('#hasil');

        for (item in data) {
        
        fieldHtml+='<tr>';
          fieldHtml+='<td><a href="#"  type="button" class="modal_open" value="'+data[item].id_data_uji+'">'+data[item].data_uji.nama_data_uji+'</a></td>';
          fieldHtml+='<td> '+data[item].nilai_nilai_akhir+'%</td>';
          fieldHtml+='</tr>';
        }
        $(wrapper_hasil).html(fieldHtml);
}

</script>
@endsection


