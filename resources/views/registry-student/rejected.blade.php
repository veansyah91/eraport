@extends('layouts.main')

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <h1 class="m-0 text-dark">
                    Siswa Yang Diterima Tahun ({{ Date('Y') }})
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
                    <div class="col-sm-12">
                        <table class="table table-responsive ">
                            <thead>
                                <tr>
                                    <th class="text-center">NIK</th>
                                    <th class="text-center">Nama Siswa</th>
                                    <th class="text-center">Tempat / Tanggal Lahir</th>
                                    <th class="text-center">Nama Ayah</th>
                                    <th class="text-center">Nama Ibu</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->nik }}</td>
                                        <td>{{ $student->nama }}</td>
                                        <td>{{ $student->tempat_lahir }} / {{ $student->tgl_lahir }}</td>
                                        <td>{{ $student->nama_ayah }}</td>
                                        <td>{{ $student->nama_ibu }}</td>
                                        <td class="text-primary font-weight-bolder">Ditolak</td>
                                    </tr>                                    
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>  
            </div>
        </section>             
        
@endsection

@section('script')
<script type="text/javascript">

})


</script>
@endsection
