@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Data Mata Pelajaran
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
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputModal">
                            Tambah Mata Pelajaran
                        </button>
                        <hr>
                        @if ($subjects->isEmpty())
                            <p class="font-italic">Data Belum Diisi</p>
                        @else
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"><strong>Pelajaran Wajib</strong></td>
                                            </tr>
                                            @foreach ($subjects as $subject)
                                                @if ($subject->kategori == 'Pelajaran Wajib')
                                                    <tr>
                                                        <td>{{$subject->mata_pelajaran}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm detail-student" 
                                                            data-toggle="modal" 
                                                            data-id="{{$subject->id}}" 
                                                            data-mapel="{{$subject->mata_pelajaran}}"
                                                            data-kategori="{{$subject->kategori}}"
                                                            data-target="#subjectEditModal">
                                                            <i class="far fa-list-alt"></i></button>
                                                            <button class="btn btn-danger btn-sm subject-delete" delete-id="{{$subject->id}}"><i class="far fa-trash-alt"></i></button>
                                                        </td>
                                                    </tr>                                   
                                                @endif
                                            @endforeach                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm">
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td colspan="2"><strong>Muatan Lokal</strong></td>
                                            </tr>
                                            @foreach ($subjects as $subject)
                                                @if ($subject->kategori == 'Muatan Lokal')
                                                    <tr>
                                                        <td>{{$subject->mata_pelajaran}}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary btn-sm detail-student" 
                                                            data-toggle="modal" 
                                                            data-id="{{$subject->id}}" 
                                                            data-mapel="{{$subject->mata_pelajaran}}"
                                                            data-kategori="{{$subject->kategori}}"
                                                            data-target="#subjectEditModal">
                                                            <i class="far fa-list-alt"></i></button>
                                                            <button class="btn btn-danger btn-sm subject-delete" delete-id="{{$subject->id}}"><i class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>                                   
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                        @endif                     
                        

                    </div>
                </div>            
                
                
                {{-- Form Modal Input --}}
                <div class="modal-input">
                    <form action="/add-subjects" method="POST">    
                        @csrf            
                        <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="inputModalLabel">Tambah Mata Pelajaran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="mata_pelajaran" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="mata_pelajaran" name="mata_pelajaran" placeholder="Mata Pelajaran" value="{{ old('mata_pelajaran') }}">
                                            @error('mata_pelajaran')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                                        <div class="col-sm-9">
                                            <select class="custom-select" id="kategori" name="kategori" >
                                                <option value="" selected><-- Pilih Kategori--></option>
                                                <option value="Pelajaran Wajib">Pelajaran Wajib</option>
                                                <option value="Muatan Lokal">Muatan Lokal</option>
                                            </select>
                                            @error('kategori')
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

                {{-- Form Modal Edit --}}
                <div class="modal-edit">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal fade" id="subjectEditModal" tabindex="-1" role="dialog" aria-labelledby="subjectEditModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="subjectEditModalTitle">Edit Mata Pelajaran</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body"> 
                                        @method('patch')
                                        @csrf                               
                                        <div class="form-group row">
                                            <label for="editmata_pelajaran" class="col-sm-3 col-form-label">Mata Pelajaran</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="editmata_pelajaran" name="mata_pelajaran" placeholder="Mata Pelajaran" value="{{ old('editmata_pelajaran') }}">
                                                @error('editmata_pelajaran')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="editkategori" class="col-sm-3 col-form-label">Kategori</label>
                                            <div class="col-sm-9">
                                                <select class="custom-select" id="editkategori" name="kategori" value="{{ old('kategori') }}">
                                                    <option value="" selected><-- Pilih Kategori--></option>
                                                    <option value="Pelajaran Wajib">Pelajaran Wajib</option>
                                                    <option value="Muatan Lokal">Muatan Lokal</option>
                                                </select>
                                                @error('editkategori')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <div class="ubah-modal">
                                            <button type="submit" class="btn btn-primary ubah">Ubah</button>
                                        </div>
                                        
                                    </form>
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
    

    $('.detail-student').click(function(){
        let id = $(this).data('id');
        let mataPelajaran = $(this).data('mapel');
        let kategori = $(this).data('kategori');

        $('#editmata_pelajaran').val(mataPelajaran);
        $('#editkategori').val(kategori);

        $('.modal-edit form').attr(`action`,`/subject/${id}/edit`);

    })
    

    $('.subject-delete').click(function(){
        let delete_id = $(this).attr('delete-id');
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/subject/${delete_id}/delete`;
            }
        })
    })
</script>
@endsection