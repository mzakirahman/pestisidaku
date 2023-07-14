@extends('layouts.app')

@section('content')
<div class="container-fluid">
     <div class="" id="res" >
    <div class="d-flex justify-content-between ">
        <h6 class="card shadow p-2 m-0 col">Selamat Datang Di Pestisidaku</h6>
        <a href="{{route('list-hama')}}" class="btn btn-outline-dark mx-1"> Back</a>
    </div>
    
    <div class="card shadow p-2 ">
        <table class="table_new" id="dtHorizontalExample" cellspacing="0"width="100%">
           <tbody id="hasil">
            @forEach($penyakit as $p)
            <tr>
            </a>
                <td ><a href="#" type="button" class="modal_open" value="{{$p->id_penyakit}}" ><img src="{{url('public/penyakit/'.$p->img)}}" class="rounded float-left" style="max-width: 100px;" alt=""></a></td>
                <td style="word-wrap: break-word;max-width:85%">{{$p->nama_penyakit}}</td>
            </tr>
            @endforeach
           </tbody>
        </table>
    </div>
 </div>


 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Penyakit Padi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
     <div class="text-center">
        <img src="" class="img-thumbnail mx-auto d-block w-25" id="preview" alt="">
        <h4 id="title">
        </h4>
     </div>
    <div class="" id="keterangan">
    </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>

<script type="text/javascript">
    $(document).on('click','.modal_open',function(){
        var url = "penyakit/get-data1";
        var id= $(this).attr('value');
        // console.log(id);
        $.get(url + '?id_penyakit=' + id, function (data) {
            $('#title').html('');
            $('#keterangan').html('');
            $('#preview').attr('src','');
            //success data
            // console.log(data);
            $('#exampleModal').modal('show');
            $('#title').html(data[0].nama_penyakit);
            $('#keterangan').html(data[0].ket_penyakit);
            var link ="{{ URL::asset('public/penyakit') }}/"+data[0].img;
            $('#preview').attr('src',link);
        }) 
    });
</script>


@endsection