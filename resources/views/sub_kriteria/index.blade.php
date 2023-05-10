@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between py-2" >
        <h5>Tabel Data Sub Kriteria</h5>
        <button type="button" class="btn btn-success addButton" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
        Add
        </button>
    </div>
    <div class="card shadow-sm  p-2">
        <table class="table " id="dtHorizontalExample" cellspacing="0"width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sub Kriteria</th>
                    <th>Nama Sub Kriteria</th>
                    <th>Nama Kriteria</th>
                    <th>Profile Ideal</th>
                    <th>Faktor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
         <tbody>
               @foreach($sub_kriteria as $s)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$s->kode_sub_kriteria}}</td>
                    <td>{{$s->nama_sub_kriteria}}</td>
                    <td>{{$s->nama_Kriteria}}</td>
                    <td>{{$s->profil_ideal}}</td>
                    <td>{{$s->faktor}}</td>
                    <td>
                         <button class="btn btn-warning btn-detail open_modal"   value="{{$s->id_sub_kriteria}}"><i class="bi bi-pencil-square"></i></button>
                         <a href="sub-kriteria/data/hapus/{{$s->id_sub_kriteria}}" onclick="return confirm('Yakin ingin menghapus data ini ?');" class="btn btn-danger"><i class="bi bi-trash2"></i></a>
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
        <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
         <form action="{{ route('sub-kriteria/tambah-data/proses') }}" id="form_modal" method="post">
             {{ csrf_field() }}
             <input type="hidden" class="form-control" name="id_sub_kriteria" id="id_sub_kriteria">
             <label for="">Kriteria</label>
             <select name="id_kriteria" id="id_kriteria" class="form-control">
                 @foreach($kriteria as $k)
                 <option value="{{$k->id_kriteria}}">{{$k->nama_kriteria}}</option>
                 @endforeach
             </select>
            <label for="">Kode Sub Kriteria</label>
            <input type="text" class="form-control" name="kode_sub_kriteria" id="kode_sub_kriteria">
            <label for="">Nama Sub Kriteria</label>
            <input type="text" class="form-control" name="nama_sub_kriteria" id="nama_sub_kriteria">
            <label for="">Profile Ideal</label>
            <input type="text" class="form-control" name="profil_ideal" id="profil_ideal">
            <label for="">Faktor</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="faktor"  value="core" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                    Core Faktor
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="faktor" value="secondary" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                    Secondary Faktor
                </label>
            </div>
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


<script type="text/javascript">
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
        var url = "sub-kriteria/get-data";
        var id= $(this).val();
        $.get(url + '?id_sub_kriteria=' + id, function (data) {
            //success data
            console.log(data);
            $('#exampleModalLongTitle').html('Edit Data')
            $('#exampleModalCenter').modal('show');
            $('#id_sub_kriteria').val(data[0].id_sub_kriteria);
            $('#id_kriteria').val(data[0].id_kriteria);
            $('#kode_sub_kriteria').val(data[0].kode_sub_kriteria);
            $('#nama_sub_kriteria').val(data[0].nama_sub_kriteria);
            $('#profil_ideal').val(data[0].profil_ideal);
            if(data[0].faktor=='core'){
                $('#flexRadioDefault1').prop('checked',true);
            }
            if(data[0].faktor=='secondary'){
                $('#flexRadioDefault2').prop('checked',true);
            }
            $('select option[value="' + data[0].id_kriteria +'"]').prop("selected", true);
            $('#form_modal').attr('action', '{{ route('sub-kriteria/edit-data/proses') }}');
        }) 
    });
    $(document).on('click','.addButton', function(){
         $('#form_modal')[0].reset();
        $('#exampleModalLongTitle').html('Tambah Data')
    });
    $(document).on('click','.closebtn', function(){
        $('#form_modal')[0].reset();
    });
</script>
@endsection




