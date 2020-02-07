@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
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
                            <button class="btn btn-primary btn-sm">Tambah Struktur Jabatan</button>
                        @else
                            <button class="btn btn-primary btn-sm">Tambah Struktur Jabatan</button>                      

                            <a href="/add-staff" class="btn btn-primary btn-sm">Tambah Struktur Jabatan</a>

                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($positions as $position)
                                <tr>  
                                    <td> {{$iteration->loop}} </td>
                                    <td> {{$staff->nama}} </td>

                                @endforeach
                    
                            </tbody>
                        </table>
                        @endif

                    </div>
                </div>            

            </div>
        </section>
        <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@section('script')
<script type="text/javascript">
    
</script>
    
@endsection
