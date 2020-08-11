@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    Pengaturan Otorisasi Khusus
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
                        <h4>Admin</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modaltambah">Tambah Admin</button>
                    </div>
                </div>
                
                <div class="row mt-3" >
                    <div class="col-sm-4">
                        <table class="table">
                            <tbody>
                                @if ($hasRoles->isNotEmpty())
                                    @foreach ($hasRoles as $hasRole)
                                    <tr>
                                        <td>{{ getUser($hasRole->model_id)->staff->nama }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger role-delete" data-id = "{{ $hasRole->id }}">
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <i>Admin Belum Ditetapkan</i>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Modal-->
            <form action="/store-model-role" method="POST">
                @csrf
                <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group row">
                                  <label for="email" class="col-sm-2 col-form-label">Nama</label>
                                  <div class="col-sm-10">
                                    <select class="custom-select" id="user" name="user" aria-label="Example select with button addon">
                                        <option selected>Pilih Staff</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->staff->nama }}</option>
                                        @endforeach                                        
                                      </select>
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
