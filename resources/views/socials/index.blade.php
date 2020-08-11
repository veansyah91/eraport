@extends('layouts.main')

@section('content')
    
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        Data Aspek Pengamatan Sikap Sosial
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
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#inputModal">
                            Tambah Aspek Sosial
                        </button>
                        <hr>
                        @if ($socials->isEmpty())
                            <p class="font-italic">Data Belum Diisi</p>
                        @else
                        
                        <div class="container">
                            <div class="row">
                                <div class="col-sm">
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($socials as $social)
                                            <tr>
                                                <td><strong>Aspek {{$i++}}</strong></td>
                                                <td>{{ $social->aspek }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm edit-social" 
                                                    data-toggle="modal" 
                                                    data-target="#socialEditModal"
                                                    data-id="{{ $social->id }}" data-aspek="{{ $social->aspek }}">
                                                    <i class="far fa-list-alt"></i></button>
                                                    <button class="btn btn-danger btn-sm social-delete" data-id="{{ $social->id }}"><i class="far fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
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
                <form action="/add-socials" method="POST">    
                    @csrf            
                    <div class="modal fade" id="inputModal" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
                        <div class="modal-dialog " role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="inputModalLabel">Tambah Aspek Sosial</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">                                    
                                    <div class="form-group col-sm-12">
                                        <label for="aspek_social">Aspek Sosial</label>
                                        <input type="text" class="form-control" id="aspek_social" name="aspek_social" placeholder="Aspek Sosial" value="{{ old('aspek_social') }}">
                                        @error('aspek_social')
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

                {{-- Form Modal Edit --}}
                <div class="modal-edit">
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="modal fade" id="socialEditModal" tabindex="-1" role="dialog" aria-labelledby="socialEditModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="inputModalLabel">Edit Aspek Sosial</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group row">                                    
                                            <div class="form-group col-sm-12">
                                                <label for="aspek_social">Aspek Sosial</label>
                                                <input type="text" class="form-control aspek_social" name="aspek_social" placeholder="Aspek Sosial" >
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

    $('.edit-social').click(function(){
        let id = $(this).data('id');
        let aspek = $(this).data('aspek');

        $('.aspek_social').val(aspek);

        $('.modal-edit form').attr(`action`,`/social/${id}/edit`);

    })

    $('.social-delete').click(function(){
        let delete_id = $(this).data('id');
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/social/${delete_id}/delete`;
            }
        })
    })
</script>
@endsection