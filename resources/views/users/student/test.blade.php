@extends('layouts.user')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm">
                    <h1>Ujian {{ $testschedule->kategori }}</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

        <!-- Main content -->
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header">
                            <h3><strong>Jadwal Ujian Kelas {{ $levelStudentNow->level->kelas }}</strong></h3> 
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead >
                                    <tr>
                                        <th >Tanggal</th>
                                        <th >Mata Pelajaran</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach ($subjectTestSchedules as $subjectTestSchedule)
                                        <tr>
                                            <td 
                                                @if (Date('Y-m-d') == $subjectTestSchedule->tanggal)
                                                    class = "text-primary font-weight-bold"
                                                @endif
                                            >
                                                {{ $subjectTestSchedule->tanggal }}
                                            </td>
                                            <td
                                                @if (Date('Y-m-d') == $subjectTestSchedule->tanggal)
                                                    class = "text-primary font-weight-bold"
                                                @endif
                                            >{{ $subjectTestSchedule->mata_pelajaran }}</td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-primary"><strong>Ujian Hari Ini </strong></h3> 
                        </div>
                        <div class="card-body">
                            @if (Student::testPermit($levelStudentNow->id, $testschedule->id)->allow == 'off' || !Student::testPermit($levelStudentNow->id, $testschedule->id))
                                <p><i>Maaf Kamu Belum Bisa Menikuti Ujian Karena Belum Menyelesaikan Pembayaran SPP</i> </p>
                                <p><i>Silakan Menghubungi <strong>Admin</strong> </i></p>
                                
                            @else
                                @foreach ($subjectTestsNow as $subjectTestNow)
                                    <div class="col-sm mb-3">
                                        <table>
                                            <tr>
                                                <th>Mata Pelajaran:</th>
                                                <th style="font-size: 25px">{{ $subjectTestNow->levelsubject->subject->mata_pelajaran }}</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @if (Student::testUrl($subjectTestNow->level_subject_id, $subjectTestNow->kategori))
                                                        <a target="a_blank" href="{{ Student::testUrl($subjectTestNow->level_subject_id, $subjectTestNow->kategori)->url }}" class="btn btn-success btn-sm text-left font-weight-bold">Klik Disini Untuk Mengikuti Ujian</a>
                                                    @else 
                                                        <i class="text-danger">Soal Ujian Belum Dibuat</i>

                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                @endforeach
                            @endif
                            
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
<script type="text/javascript">    

</script>
    
@endsection