@extends('layouts.main')

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Data Struktur Jabatan
                </h1>
                </div><!-- /.col -->          
            </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if ($positions->isEmpty())
                            <p class="font-italic">Data Belum Diisi</p>
                            <a href="/add-default" class="btn btn-primary btn-sm" >Atur Struktur Jabatan Secara Otomatis</a>
                        @else
                            <button class="btn btn-primary btn-sm tambah-jabatan" data-toggle="modal" data-target="#inputModal">Tambah Struktur Jabatan</button>
                            <hr>

                            @foreach ($positions as $position)
                                <div class="col-md-4">
                                    <div class="card card-default ">
                                        <div class="card-header">
                                            <h3 class="card-title h3"><strong>{{$position->jabatan}}</strong></h3>                                    
                                            <div class="card-tools">
                                                @if ($position->jabatan == "GURU")
                                                    <button type="button" class="btn btn-secondary btn-sm tambah-guru" data-toggle="modal" data-target="#inputStaff"  data-position="{{$position->id}}">+ Tambah Guru</button>
                                                @endif
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool position-delete" delete-id="{{$position->id}}"><i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            
                                            <table class="table table-borderless">
                                                <tbody>
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @if ($allstaffperiod->isNotEmpty())
                                                        @foreach ($allstaffperiod as $sp)
                                                            @if ($sp->position_id == $position->id)
                                                                @if ($semester->id == $sp->semester_id)
                                                                    <tr>
                                                                        <td>{{$sp->staff->nama}}</td>
                                                                        <td class="float-right"><button class="btn btn-sm btn-danger staff-delete" delete-id="{{$sp->id}}">Hapus</button></td>
                                                                    </tr>
                                                                    @php
                                                                        $i++;
                                                                    @endphp
                                                                @endif                                                            
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                    @if ($i == 0)
                                                        <tr>
                                                            <td>
                                                                <i>Tidak ada STAFF pada Semester Ini</i>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-primary btn-sm float-right tambah-staff" data-toggle="modal" data-target="#inputStaff" data-position="{{$position->id}}">Tambah Data</button>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                            @endforeach                                 
                            
                            
                        @endif
                    </div>
                </div>  

                <div class="row">
                    <div class="col-12">
                        <small class="text-danger">
                            <strong><i>
                                NB. Sebelum menambahkan Posisi Staff, silakan Melakukan Registrasi Akun Staff terlebih dahulu.
                            </i></strong>
                        </small>
                    </div>
                </div>

            </div>

            {{-- Form Modal Input Tambah Struktur Jabatan --}}
            <div class="modal-position">
                <form action="/add-position" method="POST">    
                    @csrf            
                    <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="inputModalLabel">Tambah Jabatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" value="{{ old('jabatan') }}">
                                        @error('jabatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </form> 
            </div>

            {{-- Form Modal Input Tambah Staff --}}
            <div class="modal-staff">
                <form action="/add-staff-position" method="POST">    
                    @csrf            
                    <div class="modal fade" id="inputStaff" tabindex="-1" role="dialog" aria-labelledby="inputStaffLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="inputStaffLabel">Tambah Staff</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <input type="text" hidden name="semester" value="{{$semester->id}}" placeholder="">
                                    <input type="text" class="input-position" hidden name="position">
                                    <label for="staff" class="col-sm-3 col-form-label">Nama Staff</label>
                                    <div class="col-sm-9 staff-input">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>                 
        
@endsection

@section('script')
<script type="text/javascript">

function customInputSelect(add,position){
    
    $('.staff-input').html(add);
    $(".input-position").val(position);

    fetch(`{{route('ajax.get.select.data.staff')}}`)
    .then(response => response.json())
    .then(function(data){
        data.map(d=>{
            $('.staff-select').append(`<option value="${d.id}">${d.nama}</option>`)
        })
    });

    $('.staff-select').select2({
        theme: "classic",
        width: '80%',        
    });
}

$(document).ready(function() {   

    $('.position-delete').click(function(){
        let delete_id = $(this).attr('delete-id');
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/position/${delete_id}/delete`;
            }
        })
    })

    $('.staff-delete').click(function(){
        let delete_id = $(this).attr('delete-id');
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/position/${delete_id}/deletestaff`;
            }
        })
    })

    $('.tambah-staff').click(function(){
        let position = $(this).data('position');
        let selectInput = `<select class="staff-select form-control" id="staffselect " name="staffselect" ></select>`;
        customInputSelect(selectInput,position);
    })

    $('.tambah-guru').click(function(){
        let position = $(this).data('position');
        let selectInput = `<select class="staff-select form-control" id="staffselect " name="staffselect[]" multiple="multiple"></select>`;
        customInputSelect(selectInput,position);
    })

    $('.staff-select').select2({
        theme: "classic",
        width: '80%',        
    });

})


</script>
@endsection
