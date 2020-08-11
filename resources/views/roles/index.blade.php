@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Role
                </h1>
              </div><!-- /.col -->          
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modaltambah">
                            Tambah Role
                        </button>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <table class="table">
                          <tbody>
                              @foreach ($roles as $role)
                              <tr>
                                  <td>{{ $role->name }}</td>
                                  <td>
                                      <button class="btn btn-sm btn-danger role-delete" data-id = "{{ $role->id }}">
                                          Hapus
                                      </button>
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Modal-->
            <form action="/store-position" method="POST">
                @csrf
                <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group row">
                                  <label for="email" class="col-sm-2 col-form-label">Nama</label>
                                  <div class="col-sm-10">
                                      <input type="text" class="form-control" id="nama" name="nama">
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
            
        </section>
        <!-- /.content -->
    
@endsection

@section('script')
<script type="text/javascript">

    $('.role-delete').click(function(){
        let delete_id = $(this).data('id');
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = `/role/${delete_id}/delete`;
            }
        })
    })

</script>
@endsection
