@extends('layouts.main')

@section('content')
        <!-- Content Header (Page header) -->
        <div class="content-header mt-5">
            <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                <h1 class="m-0 text-dark">
                    Siswa Yang Mengikuti Pendaftaran Tahun ({{ Date('Y') }})
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
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($students->isNotEmpty())
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->nik }}</td>
                                            <td>{{ $student->nama }}</td>
                                            <td>{{ $student->tempat_lahir }} / {{ $student->tgl_lahir }}</td>
                                            <td>{{ $student->nama_ayah }}</td>
                                            <td>{{ $student->nama_ibu }}</td>
                                            <td>{{ $student->status }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col">
                                                        <form action="/accept-student" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{ $student->id }}" name="id">
                                                            <button type="submit" class="btn btn-primary btn-sm">Terima</button>
                                                        </form>
                                                    </div>
                                                    <div class="col">
                                                        <form action="/reject-student" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{ $student->id }}" name="id">
                                                            <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                        </form>
                                                    </div>
                                                </div> 
                                            </td>
                                        </tr>                                    
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">Data Kosong</td>
                                    </tr>
                                @endif
                                

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
