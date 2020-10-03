@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cetak Rapor Tengah Semester {{ $sublevel->level->kelas }} {{ $sublevel->alias }}</h1>
                    </div>
                <div class="col-sm-6">
                    <h5 class="text-right">Semester {{ Year::thisSemester()->semester }}</h5>
                    <h5 class="text-right">Tahun Ajaran {{ Year::thisSemester()->year->awal }}/{{ Year::thisSemester()->year->akhir }}</h5>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card ">
                        <div class="card-body ">
                            <div class="row">
                                <div class="mt-2 mx-auto">
                                    <table class="table table-hover table-responsive" id="table-student">
                                            <thead>
                                                <tr>
                                                    <th>NISN</th>
                                                    <th>Nomor Induk</th>
                                                    <th>Nama Siswa</th>
                                                    <th>Peringkat</th>
                                                    <th>Aksi</th>
                                                    
                                                </tr>
                                            </thead>
                                            
                                            <tbody>

                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{$student->nisn}}</td>
                                                    <td>{{$student->no_induk}}</td>
                                                    <td>{{$student->nama}}</td>
                                                    <td class="text-center">{{ Score::rank($student->student_id, $semester->id)->rank }}</td>
                                                    <td style="width: 8em">
                                                        <a href="/cetak-rapor/tengah-semester/{{ $sublevel->id }}/{{ $semester->id }}/{{ $student->student_id }}" class="btn btn-primary btn-sm " data-id={{$student->student_id}} data-controller = "delete-knowledge-competence" data-sublevel = "{{ $sublevel->id }}" >Cetak Rapor</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>                                
                                    
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
    <!-- /.content-wrapper -->
@endsection

@section('script')

<script>
    

    window.addEventListener('load', async function(){
        $('#table-student').DataTable();
    })
    

</script>
    
@endsection