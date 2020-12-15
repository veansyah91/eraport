@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>Cetak Rapor</strong>  
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
                        <div class="card">
                            <div class="card-header d-flex p-0">
                                <h3 class="card-title p-3">Kelas {{$level->kelas}}</h3>
                                <ul class="nav nav-pills ml-auto p-2">
                                    @foreach ($sublevels as $sublevel)
                                        <li class="nav-item"><a class=" @if ($sublevel->alias) nav-link @endif  @if ($loop->iteration == 1) active @endif" href="#tab_{{$sublevel->id}}" data-toggle="tab">{{$sublevel->alias}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    @foreach ($sublevels as $sublevel)
                                        <div class="tab-pane @if ($loop->iteration == 1) active @endif" id="tab_{{$sublevel->id}}">

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
                                                            <div class="row">
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
                                                                                    @if ($student->sub_level_id == $sublevel->id)
                                                                                    <tr>
                                                                                        <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                                                                        <td>{{$student->nama}}</td>
                                                                                        <td scope="col" class="text-center">
                                                                                            @php
                                                                                                $nilaispiritual = avSpiritualScore($student->id,$spiritualperiods);
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
                                                                                                $nilaiSosial = avSocialScore($student->id,$socialperiods);
                                                                                            @endphp
                                                                                            {{$nilaiSosial}}
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
                                                                                                    $nilaiAngka = round(avKnowledge($student->id,$levelsubject->id));
                                                                                                    $jumlahNilaiAngkaPerSiswa += avKnowledge($student->id,$levelsubject->id);
                                                                                                    $jumlahData++;
                                                                                                @endphp
                                                                                                {{$nilaiAngka}}
                                                                                            </td>
                                                                                            <td scope="col" class="text-center">
                                                                                                    {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}}                                                                                            
                                                                                            </td>

                                                                                            <td scope="col" class="text-center">
                                                                                                @php
                                                                                                    $nilaiKeterampilan = round(Score::avgPracticeScore($student->id,$levelsubject->id));
                                                                                                    $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->id,$levelsubject->id);
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
                                                                                                    $nilaiAngka = round(avKnowledge($student->id,$levelsubject->id));
                                                                                                    $jumlahNilaiAngkaPerSiswa += avKnowledge($student->id,$levelsubject->id);
                                                                                                    $jumlahData++;
                                                                                                @endphp
                                                                                                {{$nilaiAngka}}
                                                                                            </td>
                                                                                            <td scope="col" class="text-center">
                                                                                                    {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}}                                                                                            
                                                                                            </td>

                                                                                            <td scope="col" class="text-center">
                                                                                                @php
                                                                                                    $nilaiKeterampilan = round(Score::avgPracticeScore($student->id,$levelsubject->id));
                                                                                                    $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->id,$levelsubject->id);
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
                                                                                                    $nilaiAngka = round(avKnowledge($student->id,$levelsubject->id));
                                                                                                    $jumlahNilaiAngkaPerSiswa += avKnowledge($student->id,$levelsubject->id);
                                                                                                    $jumlahData++;
                                                                                                @endphp
                                                                                                {{$nilaiAngka}}
                                                                                            </td>
                                                                                            <td scope="col" class="text-center">
                                                                                                    {{konversiNilai($nilaiAngka,"nilai")->nilai_huruf}} 
                                                                                            </td>
                                                                                            <td scope="col" class="text-center">
                                                                                                @php
                                                                                                    $nilaiKeterampilan = round(Score::avgPracticeScore($student->id,$levelsubject->id));
                                                                                                    $jumlahNilaiKeterampilanPerSiswa += Score::avgPracticeScore($student->id,$levelsubject->id);
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
                                                                                        <td class="text-center">{{ ranking($student->id,$semester->id)->rank}}</td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    
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
                                                                    </div>
                                                                </div>
                                                                
                                                            </div> 
                                                            
                                                        </div>
                                                        <!-- /.card-body-->
                                                    </div>
                                                </div>
                                            </div>

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
                                                                                    @if ($student->sub_level_id == $sublevel->id)
                                                                                    <tr>
                                                                                        <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                                                                        <td>{{$student->nama}}</td>
                                                                                        <td class="text-center">
                                                                                            <a href="/report/{{$level->id}}/{{$student->id}}/cover" class="btn btn-sm btn-primary" target="_blank">Cover</a>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <a href="/report/{{$sublevel->id}}/{{$student->id}}/rapor-nilai" class="btn btn-sm btn-danger">Angka</a>
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            <a href="/report/{{$sublevel->id}}/{{$student->id}}/rapor-deskripsi" class="btn btn-sm btn-success">Deskripsi</a>
                                                                                        </td>
                                                                                        
                                                                                    </tr>
                                                                                    @endif
                                                                                    
                                                                                @endforeach
                                                                                
                                                                                
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div> 
                                                            
                                                        </div>
                                                        <!-- /.card-body-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>

        
@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        
    })    
</script>
    
@endsection