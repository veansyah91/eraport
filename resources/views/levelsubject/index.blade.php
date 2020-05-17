@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h3 class="m-0 text-dark">
                        <strong>Kompetensi Dasar</strong>  
                    </h3>
                    <h1 class="m-0 text-dark">
                        {{$levelsubject->subject->mata_pelajaran}}
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
                        
                        <hr>
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button 
                                        type="button" 
                                        class="btn btn-primary btn-sm tambah mb-2" 
                                        data-toggle="modal" 
                                        data-target="#inputModal" 
                                        data-id="{{$levelsubject->id}}"
                                        data-controller = "add-knowledge-competence"
                                        @if ($kompetensidasar)
                                            data-jumlah="{{count($kompetensidasar)}}"
                                        @else
                                            data-jumlah="0"
                                        @endif
                                    >
                                        Tambah Pengetahuan Kompetensi Dasar
                                    </button>

                                    <table class="table table-hover table-responsive">
                                        
                                            @if (!$kompetensidasar)
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"><i>Kompetensi Dasar Belum Diatur</i></td>
                                                </tr> 
                                            </tbody>
                                            @else
                                                <thead>
                                                    <tr>
                                                        <th>KD</th>
                                                        <th>Pengetahuan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($kompetensidasar as $kd)
                                                    <tr>
                                                        <td>{{$kd->kode}}</td>
                                                        <td>{{$kd->pengetahuan_kompetensi_dasar}}</td>
                                                        <td style="width: 8em">
                                                            <button class="btn btn-danger btn-sm kd-delete" data-id={{$kd->id}} data-controller = "delete-knowledge-competence">Hapus</button>
                                                            <button class="btn btn-success btn-sm btn-edit-kd" data-id={{$kd->id}} data-kd="{{$kd->pengetahuan_kompetensi_dasar}}" data-kode="{{$kd->kode}}" data-toggle="modal" 
                                                                data-target="#editModal" data-controller = "edit-knowledge-competence">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            @endif                                     
                                        
                                    </table>
                                </div>

                                <div class="col-sm-6">
                                    <button 
                                        type="button" 
                                        class="btn btn-primary btn-sm tambah mb-2" 
                                        data-toggle="modal" 
                                        data-target="#inputModal" 
                                        data-id="{{$levelsubject->id}}"
                                        data-controller = "add-practice-competence"
                                        @if ($praktekkompetensidasar)
                                            data-jumlah="{{count($praktekkompetensidasar)}}"
                                        @else
                                            data-jumlah="0"
                                        @endif
                                    >
                                        Tambah Keterampilan Kompetensi Dasar
                                    </button>

                                    <table class="table table-hover table-responsive">
                                        
                                            @if (!$praktekkompetensidasar)
                                            <tbody>
                                                <tr>
                                                    <td colspan="2"><i>Kompetensi Dasar Belum Diatur</i></td>
                                                </tr> 
                                            </tbody>
                                            @else
                                                <thead>
                                                    <tr>
                                                        <th>KD</th>
                                                        <th>Pengetahuan</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                @foreach ($praktekkompetensidasar as $kd)
                                                    <tr>
                                                        <td>{{$kd->kode}}</td>
                                                        <td>{{$kd->keterampilan_kompetensi_dasar}}</td>
                                                        <td style="width: 8em">
                                                            <button class="btn btn-danger btn-sm kd-delete" data-id={{$kd->id}} data-controller = "delete-practice-competence">Hapus</button>
                                                            <button class="btn btn-success btn-sm btn-edit-kd" data-id={{$kd->id}} data-kd="{{$kd->keterampilan_kompetensi_dasar}}" data-kode="{{$kd->kode}}" data-toggle="modal" 
                                                                data-target="#editModal" data-controller = "edit-practice-competence">Edit</button>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            @endif                                     
                                        
                                    </table>
                                </div>
                            </div>
                        </div>                   
                        

                    </div>
                </div>            
                
                
                {{-- Form Modal Input --}}
                <div class="modal-input">
                    <form action="" method="POST">    
                        @csrf            
                        <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="inputModalLabel">Tambah Kompetensi Dasar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="mata_pelajaran" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="mata_pelajaran" name="mata_pelajaran" readonly value="{{$levelsubject->subject->mata_pelajaran}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode" class="col-sm-4 col-form-label">Kode</label>
                                        <div class="col-sm-8">
                                            <input class="form-control kode" id="kode" name="kode">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kd" class="col-sm-4 col-form-label">Kompetensi Dasar</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control kd" id="kd" name="kd"></textarea>
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

                {{-- Form Modal edit --}}
                <div class="modal-edit">
                    <form action="" method="POST">    
                        @csrf            
                        @method('patch')
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Kompetensi Dasar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="mata_pelajaran" class="col-sm-4 col-form-label">Mata Pelajaran</label>
                                        <div class="col-sm-8">
                                            <input class="form-control"name="mata_pelajaran" readonly value="{{$levelsubject->subject->mata_pelajaran}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode" class="col-sm-4 col-form-label">Kode</label>
                                        <div class="col-sm-8">
                                            <input class="form-control edit-kode" name="kode">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kd" class="col-sm-4 col-form-label">Kompetensi Dasar</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control edit-kd" name="kd"></textarea>
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

            </div>
        </section>
        <!-- /.content -->
@endsection

@section('script')
<script type="text/javascript">
    $('document').ready(function(){
        $('.tambah').click(function(){
            let jumlah = $(this).data('jumlah');
            let nilai = jumlah+1;
            let id = $(this).data('id');
            let controller = $(this).data('controller');

            $('.kode').val(`3.${nilai}`);

            $('.modal-input form').attr(`action`,`/levelsubject/${id}/${controller}`);
            
        })

        $('.kd-delete').click(function(){
        let delete_id = $(this).data('id');
        let controller = $(this).data('controller');
        
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/levelsubject/${delete_id}/${controller}`;
            }
        })
        })
        
        $('.btn-edit-kd').click(function(){
            let id = $(this).data('id');
            let kd = $(this).data('kd');
            let kode = $(this).data('kode');         
            let controller = $(this).data('controller');
            

            $('.edit-kode').val(kode);
            $('.edit-kd').val(kd);

            $('.modal-edit form').attr(`action`,`/levelsubject/${id}/${controller}`);
        })

    })

</script>
@endsection