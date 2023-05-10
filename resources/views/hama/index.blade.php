@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between py-2" >
        <h5>Tabel Data Hama</h5>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success addButton" data-toggle="modal" data-target="#exampleModalCenter">
        Add
        </button>
    </div>
    <div class="card shadow-sm p-2">
        <table class="table " id="dtHorizontalExample" cellspacing="0"width="100%">
           <thead>
             <tr>
                <th>No</th>
                <th>Nama Hama</th>
                <th>Gambar</th>
                <th>Keretangan</th>
                <th>Aksi</th>
            </tr>
           </thead>
           <tbody>
             @foreach($hama as $h)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$h->nama_hama}}</td>
                    <td><img src="{{url('public/hama/'.$h->img)}}" class="img-thumbnail" alt=""></td>
                    <td>{!!$h->ket_hama!!}</td>
                    <td>
                         <button class="btn btn-warning btn-detail open_modal"   value="{{$h->id_hama}}"><i class="bi bi-pencil-square"></i></button>
                         <a href="hama/data/hapus/{{$h->id_hama}}" onclick="return confirm('Yakin ingin menghapus data {{$h->nama_hama}} ini ?');" class="btn btn-danger"><i class="bi bi-trash2"></i></a>
                    </td>
                </tr>
            @endforeach
           </tbody>
        </table>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
        <button type="button" class="close closebtn" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form action="{{ route('hama/tambah-data/proses') }}" id="form_modal" method="post" enctype="multipart/form-data">
             {{ csrf_field() }}
             <input type="hidden" class="form-control" name="id_hama" id="id_hama">
             <input type="hidden" class="form-control" name="img_old" id="img_old">
              <label for="">Nama Hama</label>
              <input type="text" class="form-control" name="nama_hama" id="nama_hama">
            <label for="">Gambar Hama</label>
            <input type="file" class="form-control" name="img" id="img">
             <img src="" class="w-50" id="preview" alt=""><br>
            <label for="">keterangan hama</label>
            <textarea class="form-control" name="ket_hama" id="ket_hama" cols="30" rows="5"></textarea>
            {{-- <button class="btn btn-success">Simpan</button> --}}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary closebtn" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
    </div>
  </div>
</div>
<script>
   
</script>


<script type="text/javascript">
let myEditor 
        ClassicEditor
        .create( document.querySelector( '#ket_hama' ) )
        .then( editor => {
            window.editor = editor;
            myEditor = editor
        } )
        .catch( error => {
            console.error( 'There was a problem initializing the editor.', error );
        } );

        $(document).ready(function () {
        $('#dtHorizontalExample').DataTable({
            "scrollX": true
        });
        $('.dataTables_length').addClass('bs-select');
        });
        $(document).ready(function() {
                $('#dtHorizontalExample').DataTable();
            } );
        $(document).on('click','.open_modal',function(){
        var url = "hama/get-data";
        var id= $(this).val();
        $.get(url + '?id_hama=' + id, function (data) {
            //success data
            var link ="{{ URL::asset('public/hama') }}/"+data[0].img;
            console.log(data);
            $('#exampleModalCenter').modal('show');
            $('#id_hama').val(data[0].id_hama);
            $('#nama_hama').val(data[0].nama_hama);
            $('#img_old').val(data[0].img);
            $('#preview').attr('src',link);
            myEditor.setData(data[0].ket_hama)
            $('#form_modal').attr('action', '{{ route('hama/edit-data/proses') }}');
            $('#exampleModalLongTitle').html('Edit Data')
        }) 
    });
    $(document).on('click','.addButton', function(){
        $('#exampleModalLongTitle').html('Tambah Data')
    });
    $(document).on('click','.closebtn', function(){
        console.log('true')
        $('#form_modal')[0].reset();
    });
</script>



@endsection