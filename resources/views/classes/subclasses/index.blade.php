@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-5">
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">                    
                    <div class="card-body">                      
                        <h2 class="mt-4">Kelas {{$level->kelas}}</h2>
                        <div class="row mt-3">
                            <div class="col-7 col-sm-9">                                
                                <div class="tab-content" id="vert-tabs-right-tabContent">
                                    @foreach ($sublevel as $sl)
                                        <div class="tab-pane fade 
                                        @if ($loop->iteration == 1)
                                        active show
                                        @endif
                                        " id="vert-tabs-right-{{$loop->iteration}}" role="tabpanel" aria-labelledby="vert-tabs-right-{{$loop->iteration}}-tab">
                                            {{$sl->alias}}
                                        </div>
                                    @endforeach
                                </div>                                
                            </div>
                            <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($sublevel as $sl)
                                    <a class="nav-link @if ($loop->iteration == 1) active @endif" id="vert-tabs-right-{{$loop->iteration}}-tab" data-toggle="pill" href="#vert-tabs-right-{{$loop->iteration}}" role="tab" aria-controls="vert-tabs-right-{{$loop->iteration}}" aria-selected="
                                        @if ($loop->iteration == 1)
                                            true 
                                        @else 
                                            false 
                                        @endif">{{$sl->alias}} 
                                        <button class="btn float-right btn-sm btn-primary sub-class-edit" data-id="{{$sl->id}}" data-level="{{$level->id}}" data-toggle="modal" data-target="#editSub" data-alias="{{$sl->alias}} "><i class="far fa-list-alt"></i></button>
                                        @if (count($sublevel) > 1)
                                            <button class="btn float-right btn-sm btn-danger sub-class-delete" data-id="{{$level->id}}" delete-idsub="{{$sl->id}}"><i class="far fa-trash-alt"></i></button>
                                        @endif                                        
                                    </a>
                                    @endforeach                                    

                                    <button type="button" class="btn btn-outline-secondary tambah-kelas" data-toggle="modal" data-target="#tambahKelas" data-kelas="{{$level->kelas}}" data-jumlah="{{$level->jumlah}}" data-id="{{$level->id}}">
                                    + Tambah Kelas
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <!-- Modal Tambah Sub Menu-->
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="tambahKelasLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="tambahKelasLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="jumlah" class="col-sm-3 col-form-label">Jumlah Kelas</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Kelas" value="1">
                                        @error('jumlah')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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

                <!-- Modal Edit Alias Sub Menu-->
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="editSub" tabindex="-1" role="dialog" aria-labelledby="editSubLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="editSubLabel">Edit Alias Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="alias" class="col-sm-3 col-form-label">Alias Kelas</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control alias" id="alias" name="alias" placeholder="Alias Kelas">
                                        @error('alias')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
<script type="text/javascript">
    $('.tambah-kelas').click(function(){
        let kelas= $(this).data('kelas');
        let id=$(this).data('id');
        $('form').attr(`action`,`/classes/${id}/edit`);
        let judul = `<div>Kelas ${kelas}</div>`;
        $('.modal-title').html(judul);
    });

    $('.sub-class-delete').click(function(){
        let delete_id = $(this).attr('delete-idsub');
        let levelid = $(this).data('id');
        swal({
            title: "Apakah Anda Yakin Menghapus Kelas Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/classes/${levelid}/${delete_id}/delete`;                
            }
        })
    });

    $('.sub-class-edit').click(function(){
        let id=$(this).data('id');
        let level=$(this).data('level');    
        let alias=$(this).data('alias');
        $('.alias').val(alias);              
        $('form').attr(`action`,`/classes/${level}/${id}/edit`);
    });    
    
</script>
    
@endsection
