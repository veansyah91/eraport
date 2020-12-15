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
                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                Rekap Nilai
                                            </h3>
                        
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row ">
                                                <div class="col-sm-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered" id="rekap-nilai-table">
                                                            <thead class="table-primary text-center">
                                                                <tr>
                                                                    <th rowspan="3" scope="col" style="width: 2em">#</th>
                                                                    <th rowspan="3" scope="col">Nama</th>
                                                                    <th rowspan="2" scope="col" colspan="2">Spiritual KI-1</th>
                                                                    <th rowspan="2" scope="col" colspan="2">Sosial KI-2</th>
                                                                    
                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='on')
                                                                            <th scope="col" colspan="4">{{$levelsubject->mata_pelajaran}}</th>
                                                                        @endif
                                                                    @endforeach 
                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='')
                                                                            <th scope="col" colspan="4">{{$levelsubject->mata_pelajaran}}</th>
                                                                        @endif
                                                                    @endforeach   
                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        @if ($levelsubject->kategori == "Muatan Lokal")
                                                                            <th scope="col" colspan="4">{{$levelsubject->mata_pelajaran}}</th>
                                                                        @endif
                                                                    @endforeach  
                                                                    <th rowspan="3" scope="col">Jumlah Nilai</th>
                                                                    <th rowspan="3" scope="col">Rata-Rata</th>
                                                                    <th rowspan="3" scope="col">Ranking</th>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        <th scope="col" colspan="2">Pengetahuan</th>
                                                                        <th scope="col" colspan="2">Keterampilan</th>
                                                                    @endforeach
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col">A</th>
                                                                    <th scope="col">H</th>
                                                                    <th scope="col">A</th>
                                                                    <th scope="col">H</th>
                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        <th scope="col">A</th>
                                                                        <th scope="col">H</th>
                                                                        <th scope="col">A</th>
                                                                        <th scope="col">H</th>
                                                                    @endforeach
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($studentperiods as $student)
                                                                    
                                                                    <tr>
                                                                        <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                                                        <td>{{$student->nama}}</td>
                                                                        <td scope="col" class="text-center">
                                                                            @php
                                                                                $nilaispiritual = avSpiritualScore($student->student_id,$spiritualperiods);
                                                                            @endphp
                                                                            {{$nilaispiritual}}
                                                                        </td>
                                                                        <td scope="col" class="text-center">
                                                                            @if (is_object(konversiNilai($nilaispiritual,"predikat")))
                                                                                {{konversiNilai($nilaispiritual,"predikat")->nilai_huruf}}  
                                                                            @else
                                                                                {{konversiNilai($nilaispiritual,"predikat")}}                                                                                         
                                                                            @endif
                                                                        </td>
                                                                        <td scope="col" class="text-center">
                                                                            @php
                                                                                $nilaiSosial = avSocialScore($student->student_id,$socialperiods);
                                                                            @endphp
                                                                            {{round($nilaiSosial)}}
                                                                        </td>
                                                                        <td scope="col" class="text-center">
                                                                            @if (is_object(konversiNilai($nilaiSosial,"predikat")))
                                                                                {{konversiNilai($nilaiSosial,"predikat")->nilai_huruf}}  
                                                                            @else
                                                                                {{konversiNilai($nilaiSosial,"predikat")}}                                                                                         
                                                                            @endif
                                                                        </td>
                                                                        
                                                                        @php
                                                                            $jumlahNilaiAngkaPerSiswa = 0;
                                                                            $jumlahNilaiKeterampilanPerSiswa = 0;
                                                                            $jumlahData = 0;
                                                                        @endphp
                                                                        @foreach ($levelsubjects as $levelsubject)
                                                                            @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='on')
                                                                            <td scope="col" class="text-center">
                                                                                @php
                                                                                    $nilaiAngka = round(Score::reportScorePerSubject($student->student_id,$levelsubject->id));
                                                                                    $jumlahNilaiAngkaPerSiswa += Score::reportScorePerSubject($student->student_id,$levelsubject->id);
                                                                                    $jumlahData++;
                                                                                @endphp
                                                                                {{round($nilaiAngka)}}
                                                                            </td>
                                                                            <td scope="col" class="text-center">
                                                                                    {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}}                                                                                            
                                                                            </td>

                                                                            <td scope="col" class="text-center">
                                                                                @php
                                                                                    $nilaiKeterampilan = round(Score::avgPracticeScore($student->student_id,$levelsubject->id));
                                                                                    $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->student_id,$levelsubject->id);
                                                                                    $jumlahData++;
                                                                                @endphp
                                                                                {{$nilaiKeterampilan}}
                                                                            </td>
                                                                            <td scope="col" class="text-center">
                                                                                {{konversiNilai($nilaiKeterampilan,"nilai")->nilai_huruf}}
                                                                            </td>
                                                                            @endif
                                                                        @endforeach

                                                                        @foreach ($levelsubjects as $levelsubject)
                                                                            @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='')
                                                                            <td scope="col" class="text-center">
                                                                                @php
                                                                                    $nilaiAngka = round(Score::reportScorePerSubject($student->student_id,$levelsubject->id));
                                                                                    $jumlahNilaiAngkaPerSiswa += Score::reportScorePerSubject($student->student_id,$levelsubject->id);
                                                                                    $jumlahData++;
                                                                                @endphp
                                                                                {{$nilaiAngka}}
                                                                            </td>
                                                                            <td scope="col" class="text-center">
                                                                                    {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}}                                                                                            
                                                                            </td>

                                                                            <td scope="col" class="text-center">
                                                                                @php
                                                                                    $nilaiKeterampilan = round(Score::avgPracticeScore($student->student_id,$levelsubject->id));
                                                                                    $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->student_id,$levelsubject->id);
                                                                                    $jumlahData++;
                                                                                @endphp
                                                                                {{$nilaiKeterampilan}}
                                                                            </td>
                                                                            <td scope="col" class="text-center">
                                                                                {{konversiNilai($nilaiKeterampilan,"nilai")->nilai_huruf}}
                                                                            </td>
                                                                            @endif
                                                                        @endforeach

                                                                        @foreach ($levelsubjects as $levelsubject)
                                                                            @if ($levelsubject->kategori == "Muatan Lokal")
                                                                            <td scope="col" class="text-center">
                                                                                @php
                                                                                    $nilaiAngka = round(Score::reportScorePerSubject($student->student_id,$levelsubject->id));
                                                                                    $jumlahNilaiAngkaPerSiswa += Score::reportScorePerSubject($student->student_id,$levelsubject->id);
                                                                                    $jumlahData++;
                                                                                @endphp
                                                                                {{$nilaiAngka}}
                                                                            </td>
                                                                            <td scope="col" class="text-center">
                                                                                    {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}} 
                                                                            </td>
                                                                            <td scope="col" class="text-center">
                                                                                @php
                                                                                    $nilaiKeterampilan = round(Score::avgPracticeScore($student->student_id,$levelsubject->id));
                                                                                    $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->student_id,$levelsubject->id);
                                                                                    $jumlahData++;
                                                                                @endphp
                                                                                {{$nilaiKeterampilan}}
                                                                            </td>
                                                                            <td scope="col" class="text-center">
                                                                                {{konversiNilai($nilaiKeterampilan,"nilai")->nilai_huruf}}
                                                                            </td>
                                                                            
                                                                            @endif
                                                                        @endforeach
                                                                        <td class="text-center">{{ round($jumlahNilaiAngkaPerSiswa + $jumlahNilaiKeterampilanPerSiswa) }}</td>
                                                                        <td class="text-center">{{ round(($jumlahNilaiAngkaPerSiswa + $jumlahNilaiKeterampilanPerSiswa)/$jumlahData) }}</td>
                                                                        <td class="text-center">{{ranking($student->student_id,Year::thisSemester()->id)->rank}}</td>
                                                                    </tr>
                                                                    
                                                                    
                                                                @endforeach
                                                                <tr>
                                                                    @php
                                                                        $totalRata2KelasPerMapel = 0;
                                                                        $jumlahData = 0;
                                                                    @endphp
                                                                    <th class="text-right" colspan="6">Rata-Rata Kelas</th>
                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='on')
                                                                        <th colspan="2" class="text-center">
                                                                            @php
                                                                                $totalRata2KelasPerMapel += avKnowledgePerClass($levelsubject->id);
                                                                                $jumlahData++;
                                                                            @endphp
                                                                            {{round(avKnowledgePerClass($levelsubject->id))}}
                                                                        </th>

                                                                        <th colspan="2" class="text-center">
                                                                            @php
                                                                                $totalRata2KelasPerMapel += avPracticePerClass($levelsubject->id);
                                                                                $jumlahData++;
                                                                            @endphp
                                                                            {{round(avPracticePerClass($levelsubject->id))}}
                                                                        </th>
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of =='')
                                                                        <th colspan="2" class="text-center">
                                                                            @php
                                                                                $totalRata2KelasPerMapel += avKnowledgePerClass($levelsubject->id);
                                                                                $jumlahData++;
                                                                            @endphp
                                                                            {{round(avKnowledgePerClass($levelsubject->id))}}
                                                                        </th>

                                                                        <th colspan="2" class="text-center">
                                                                            @php
                                                                                $totalRata2KelasPerMapel += avPracticePerClass($levelsubject->id);
                                                                                $jumlahData++;
                                                                            @endphp
                                                                            {{round(avPracticePerClass($levelsubject->id))}}
                                                                        </th>
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach ($levelsubjects as $levelsubject)
                                                                        @if ($levelsubject->kategori == "Muatan Lokal")
                                                                        <th colspan="2" class="text-center">
                                                                            @php
                                                                                $totalRata2KelasPerMapel += avKnowledgePerClass($levelsubject->id);
                                                                                $jumlahData++;
                                                                            @endphp
                                                                            {{round(avKnowledgePerClass($levelsubject->id))}}
                                                                        </th>

                                                                        <th colspan="2" class="text-center">
                                                                            @php
                                                                                $totalRata2KelasPerMapel += avPracticePerClass($levelsubject->id);
                                                                                $jumlahData++;
                                                                            @endphp
                                                                            {{round(avPracticePerClass($levelsubject->id))}}
                                                                        </th>
                                                                        @endif
                                                                    @endforeach
                                                                    <th class="text-center">
                                                                        {{round($totalRata2KelasPerMapel)}}
                                                                    </th><th class="text-center">
                                                                        {{round($totalRata2KelasPerMapel/$jumlahData)}}
                                                                    </th><th class="text-center">
                                                                        {{round($totalRata2KelasPerMapel)}}
                                                                    </th>
                                                                </tr>
                                                                
                                                            </tbody>
                                                        </table>
                                                        {{ $studentperiods->links() }}
                                                    </div>
                                                </div>
                                                
                                            </div> 

                                            <br>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-primary card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Cetak Raport
                                                            </h3>
                                        
                                                            <div class="card-tools">
                                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-bordered" id="rekap-nilai-table">
                                                                            <thead class="table-primary text-center">
                                                                                <tr>
                                                                                    <th scope="row" class="text-center" style="width: 2em" rowspan="2">#</th>
                                                                                    <th scope="row" class="text-center" rowspan="2">Nama</th>
                                                                                    <th scope="row" class="text-center" colspan="3">Cetak Raport</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row" class="text-center">Cetak Cover</th>
                                                                                    <th scope="row" class="text-center">Cetak Raport Angka</th>
                                                                                    <th scope="row" class="text-center">Cetak Raport Deskripsi</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($studentperiods as $student)
                                                                                    <tr>
                                                                                        <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                                                                        <td>{{$student->nama}}</td>
                                                                                        <td class="text-center">
                                                                                            <a href="/cetak-rapor/akhir-semester/sublevelId={{ $sublevel->id }}/studentId={{ $student->student_id }}/cover" class="btn btn-sm btn-primary" target="_blank">Cover</a>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <a href="/cetak-rapor/akhir-semester/sublevelId={{ $sublevel->id }}/studentId={{ $student->student_id }}/score" class="btn btn-sm btn-danger">Angka</a>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <a href="/cetak-rapor/akhir-semester/sublevelId={{ $sublevel->id }}/studentId={{ $student->student_id }}/description" class="btn btn-sm btn-success">Deskripsi</a>
                                                                                        </td>
                                                                                        
                                                                                    </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                        </table>
                                                                        {{ $studentperiods->links() }}
                                                                    </div>
                                                                </div>
                                                                
                                                            </div> 
                                                            
                                                        </div>
                                                        <!-- /.card-body-->
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- /.card-body-->
                                    </div>
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

    })
    

</script>
    
@endsection