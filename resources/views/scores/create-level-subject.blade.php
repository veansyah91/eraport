@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">
                            Input Nilai {{$levelsubject->subject->mata_pelajaran}}
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
                        <div class="table-responsive">
                            <table class="table table-bordered" id="khowledge-table">
                                <thead class="table-success">
                                    <tr>
                                        <th scope="col" class="text-center" rowspan="2" style="width: 2em">#</th>
                                        <th scope="col" class="text-center" rowspan="2">Nama</th>

                                        @foreach ($ratio as $r)
                                            <th scope="col" class="text-center" colspan="{{count($basecompetences)}}">Penilaian {{$r->period}}</th>
                                        @endforeach

                                        <th scope="col" class="text-center" colspan="{{count($basecompetences)}}">Rata-Rata KD</th>  
                                        <th scope="col" class="text-center" rowspan="2">Nilai Raport</th> 
                                        <th scope="col" class="text-center" rowspan="2">Predikat</th> 
                                    </tr>
                                    <tr>
                                        @foreach ($basecompetences as $basecompetence)
                                            <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                        @endforeach

                                        @foreach ($basecompetences as $basecompetence)
                                            <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                        @endforeach

                                        @foreach ($basecompetences as $basecompetence)
                                            <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                        @endforeach

                                        @foreach ($basecompetences as $basecompetence)
                                            <th scope="col" class="text-center">KD {{$basecompetence->kode}}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($sublevelstudents as $sublevelstudent)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>
                                            {{$sublevelstudent->nama}}
                                        </td>
                                        @foreach ($ratio as $r)
                                            @foreach ($basecompetences as $basecompetence)
                                            
                                                <td class="text-center">

                                                    @if (!is_object(knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id))||knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id)->score==0)
                                                        0
                                                    @else 
                                                        {{knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id)->score}}
                                                    @endif
                                                    <button 
                                                        class="btn btn-sm btn-link add-btn"

                                                        @if (is_object(knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id)))
                                                            data-score = "{{knowledgeScore($sublevelstudent->student_id,$r->id,$basecompetence->id)->score}}"
                                                        @endif

                                                        data-target="#tambahNilaiModal"
                                                        data-toggle="modal" 
                                                        data-student="{{$sublevelstudent->student_id}}"

                                                        data-period="{{$r->id}}"
                                                        data-kd="{{$basecompetence->id}}"
                                                        data-name="{{$sublevelstudent->nama}}"
                                                        data-time="{{$r->period}}"
                                                        data-kode="{{$basecompetence->kode}}"
                                                        data-sublevel="{{$sublevel->id}}"
                                                    >
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </td>

                                            @endforeach
                                            

                                        @endforeach

                                        @foreach ($basecompetences as $basecompetence)
                                            <td scope="col" class="text-center">{{ round(avScorePerCompentence($sublevelstudent->student_id, $basecompetence->id)) }}</td>
                                        @endforeach

                                        <td class="text-center">{{ round(Score::reportScorePerSubject($sublevelstudent->student_id, $levelsubject->id)) }}</td>

                                        <td class="text-center">
                                            @if (is_object(konversiNilai(Score::reportScorePerSubject($sublevelstudent->student_id, $levelsubject->id),"nilai")))
                                                {{konversiNilai(Score::reportScorePerSubject($sublevelstudent->student_id, $levelsubject->id),"nilai")->nilai_huruf}}
                                            @else
                                                -
                                            @endif
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-sm-6">
                        <strong>Keterangan</strong> 
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <th>KD</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($basecompetences as $basecompetence)
                                    <tr>
                                        <td>{{$basecompetence->kode}}</td>
                                        <td>{{$basecompetence->pengetahuan_kompetensi_dasar}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Modal Tambah/Edit Nilai --}}
            <div class="modal-tambah">
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="tambahNilaiModal" tabindex="-1" role="dialog" aria-labelledby="#tambahNilaiModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title-social-spiritual" id="#tambahNilaiModalLabel" ></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                
                                <div class="form-group row">
                                    <label for="kode" class="col-sm-3 col-form-label">Kode</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control kode" name="kode" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="score" class="col-sm-3 col-form-label">Nilai</label>
                                    <div class="col-sm-9 ">
                                        <input type="number" class="form-control score" name="score" min="0" max="100">
                                        <small class="text-danger">Isi Nilai dengan Rentang 0 - 100</small>
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
    
@endsection

@section('script')
<script type="text/javascript">
$(document).ready(function(){
    $('.add-btn').click(function(){
        let name = $(this).data('name');
        let time = $(this).data('time');
        let kode = $(this).data('kode');

        let period = $(this).data('period');
        let kd = $(this).data('kd');

        let student = $(this).data('student');
        let score = $(this).data('score');
        let sublevel = $(this).data('sublevel');

        $('.modal-title-social-spiritual').text(`Nilai ${time}`);
        $('.kode').val(`KD ${kode}`);
        $('.nama-siswa').val(name);
        if (score){
            $('.score').val(score);
        } else {
            $('.score').val(0);
        }

        $('.modal-tambah form').attr(`action`,`/score/${sublevel}/${kd}/${period}/${student}/create-knowledge-score`);

    })

    $('#khowledge-table').DataTable();
})
</script>
    
@endsection
