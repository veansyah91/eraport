@extends('layouts.main')

@section('content')
    
    <!-- Content Wrapper. Contains page content -->
        <!-- Content Header (Page header) -->
        <div class="content-header ">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">
                        <strong>Isi Nilai</strong>  
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
                                                    <div class="card card-danger card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Nilai Spritual (KI-1)
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
                                                                        <table class="table table-bordered" id="spiritual-table">
                                                                            <thead class="table-danger text-center">
                                                                                <tr>
                                                                                    <th rowspan="2" scope="col" style="width: 2em">#</th>
                                                                                    <th rowspan="2" scope="col">Nama</th>
                                                                                    <th scope="col" colspan="{{count($spiritualperiods)}}" class="text-center">Aspek</th>
                                                                                    
                                                                                    <th rowspan="2" scope="col">Nilai</th>
                                                                                    <th rowspan="2" scope="col">Predikat</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    @foreach ($spiritualperiods as $spiritualperiod)
                                                                                        <th scope="col">Aspek {{$loop->iteration}}</th>
                                                                                    @endforeach
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($studentperiods as $student)
                                                                                    @if ($student->sub_level_id == $sublevel->id)
                                                                                        <tr>
                                                                                            <th scope="row">{{$loop->iteration}}</th>
                                                                                            <td>{{$student->nama}}</td>
                                                                                            @php
                                                                                                $jumlahNilai = 0;
                                                                                                $totalData = 0;
                                                                                            @endphp
                                                                                            @foreach ($spiritualperiods as $spiritualperiod)
                                                                                                <td scope="col" class="text-center">
                                                                                                    @php
                                                                                                        $totalData++;
                                                                                                    @endphp
                                                                                                    @if (is_object(spiritualScore($student->id,$spiritualperiod->id)))
                                                                                                        {{spiritualScore($student->id,$spiritualperiod->id)->score}}
                                                                                                    @else 
                                                                                                        0
                                                                                                    @endif
                                                                                                    
                                                                                                    <button 
                                                                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                                                                        
                                                                                                        data-target="#tambahSatuanSocialSpiritualModal"
                                                                                                        
                                                                                                        data-toggle="modal" 

                                                                                                        data-nama="{{$student->nama}}"
                                                                                                        data-spiritualperiod = "{{$spiritualperiod->id}}"
                                                                                                        @if (is_object(spiritualScore($student->id,$spiritualperiod->id)))
                                                                                                            data-score = "{{spiritualScore($student->id,$spiritualperiod->id)->score}}"
                                                                                                        @endif
                                                                                                        
                                                                                                        data-student = "{{$student->id}}"
                                                                                                    >
                                                                                                        <i class="fas fa-edit"></i>
                                                                                                    </button>
                                                                                                    
                                                                                                </td>
                                                                                                @php
                                                                                                    if (is_object(spiritualScore($student->id,$spiritualperiod->id))) {
                                                                                                        $jumlahNilai = $jumlahNilai + spiritualScore($student->id,$spiritualperiod->id)->score;
                                                                                                    }
                                                                                                @endphp
                                                                                            @endforeach
                                                                                            @php
                                                                                                $rata2 = 0;
                                                                                            @endphp
                                                                                            <td class="text-center">
                                                                                                @if (count($spiritualperiods) > 0)
                                                                                                    @php
                                                                                                        $rata2 = $jumlahNilai/count($spiritualperiods);
                                                                                                    @endphp
                                                                                                @endif
                                                                                                
                                                                                                {{$rata2}}
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @if (is_object(konversiNilai($rata2,"predikat")))
                                                                                                    {{konversiNilai($rata2,"predikat")->penjelasan}}
                                                                                                @else
                                                                                                    {{konversiNilai($rata2,"predikat")}}
                                                                                                @endif
                                                                                                

                                                                                            </td>
                                                                                            
                                                                                        </tr>
                                                                                    @endif
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

                                                            <div class="row ">
                                                                <div class="col-sm-6">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr class="table-danger">
                                                                                <th rowspan="2" scope="col" style="width: 2em">Aspek</th>
                                                                                <th rowspan="2" scope="col">Aspek Pengamatan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($spiritualperiods as $spiritualperiod)
                                                                            <tr>
                                                                                <td style="width: 2em" class="text-center">{{$loop->iteration}}</td>
                                                                                <td>
                                                                                    {{$spiritualperiod->aspek}}
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                            
                                                                        </tbody>
                                                                    </table>
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
                                                                Nilai Sosial (KI-2)
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
                                                                        <table class="table table-bordered" id="social-table">
                                                                            <thead class="table-primary text-center">
                                                                                <tr>
                                                                                    <th rowspan="2" scope="col" style="width: 2em">#</th>
                                                                                    <th rowspan="2" scope="col">Nama</th>
                                                                                    <th scope="col" colspan="{{count($socialperiods)}}" class="text-center">Aspek</th>
                                                                                    
                                                                                    <th rowspan="2" scope="col">Nilai</th>
                                                                                    <th rowspan="2" scope="col">Predikat</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    @foreach ($socialperiods as $socialperiod)
                                                                                        <th scope="col">Aspek {{$loop->iteration}}</th>
                                                                                    @endforeach
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($studentperiods as $student)
                                                                                    @if ($student->sub_level_id == $sublevel->id)
                                                                                    <tr>
                                                                                        <th scope="row">{{$loop->iteration}}</th>
                                                                                        <td>{{$student->nama}}</td>
                                                                                        @php
                                                                                            $jumlahNilai = 0;
                                                                                            $totalData = 0;
                                                                                        @endphp
                                                                                        @foreach ($socialperiods as $socialperiod)
                                                                                            <td scope="col" class="text-center">
                                                                                                @php
                                                                                                    $totalData++;
                                                                                                @endphp
                                                                                                @if (is_object(socialScore($student->id,$socialperiod->id)))
                                                                                                    {{socialScore($student->id,$socialperiod->id)->score}}
                                                                                                @else 
                                                                                                    0
                                                                                                @endif
                                                                                                
                                                                                                <button 
                                                                                                    class="btn btn-sm btn-link social-score-button"
                                                                                                    
                                                                                                    data-target="#tambahSatuanSocialSpiritualModal"
                                                                                                    
                                                                                                    data-toggle="modal" 

                                                                                                    data-nama="{{$student->nama}}"
                                                                                                    data-socialperiod = "{{$socialperiod->id}}"
                                                                                                    @if (is_object(socialScore($student->id,$socialperiod->id)))
                                                                                                        data-score = "{{socialScore($student->id,$socialperiod->id)->score}}"
                                                                                                    @endif
                                                                                                    
                                                                                                    data-student = "{{$student->id}}"
                                                                                                >
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                </button>
                                                                                                
                                                                                            </td>
                                                                                            @php
                                                                                                if (is_object(socialScore($student->id,$socialperiod->id))) {
                                                                                                    $jumlahNilai = $jumlahNilai + socialScore($student->id,$socialperiod->id)->score;
                                                                                                }
                                                                                            @endphp
                                                                                        @endforeach
                                                                                        <td class="text-center">
                                                                                            @php
                                                                                                $rata2 = 0;
                                                                                            @endphp
                                                                                            @if (count($socialperiods)>0)
                                                                                                @php
                                                                                                    $rata2 = $jumlahNilai/count($socialperiods);
                                                                                                @endphp
                                                                                            @endif
                                                                                            
                                                                                            {{$rata2}}
                                                                                        </td>
                                                                                        <td class="text-center">
                                                                                            @if (is_object(konversiNilai($rata2,"predikat")))
                                                                                                {{konversiNilai($rata2,"predikat")->penjelasan}}
                                                                                            @else
                                                                                                {{konversiNilai($rata2,"predikat")}}
                                                                                            @endif
                                                                                        </td>
                                                                                        
                                                                                    </tr>
                                                                                    @endif
                                                                                    
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

                                                            <div class="row ">
                                                                <div class="col-sm-6">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr class="table-primary">
                                                                                <th rowspan="2" scope="col" style="width: 2em">Aspek</th>
                                                                                <th rowspan="2" scope="col">Aspek Pengamatan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($socialperiods as $socialperiod)
                                                                            <tr>
                                                                                <td style="width: 2em" class="text-center">{{$loop->iteration}}</td>
                                                                                <td>
                                                                                    {{$socialperiod->aspek}}
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <!-- /.card-body-->
                                                    </div>
                                                </div>
                                            </div>

                                            

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-success card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Nilai Pengetahuan (K-3)
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
                                                                        <table class="table table-bordered" id="spiritual-table">
                                                                            <thead class="table-dsuccess text-center">
                                                                                <tr>
                                                                                    <th rowspan="2" scope="col" style="width: 2em">#</th>
                                                                                    <th rowspan="2" scope="col" colspan="2">Mata Pelajaran</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="3">
                                                                                        <strong>Pelajaran Wajib</strong>   
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>1</td>
                                                                                    <td colspan="2">Pendidikan Agama Islam</td>
                                                                                </tr>
                                                                                @php
                                                                                    $i = 1;
                                                                                @endphp
                                                                                @foreach ($levelsubjects as $levelsubject)  
                                                                                    @if ($levelsubject->kategori=="Pelajaran Wajib" && $levelsubject->sub_of == 'on')
                                                                                        <tr>
                                                                                            <th scope="row"></th>
                                                                                            <td>{{$i++}}. {{$levelsubject->mata_pelajaran}}</td>
                                                                                            <td class="text-center">
                                                                                                <a href="/score/{{$levelsubject->id}}/{{$sublevel->id}}/add-score-subject" target="_blank" class="btn btn-sm btn-success">Isi Nilai</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach

                                                                                @php
                                                                                    $i = 2;
                                                                                @endphp
                                                                                @foreach ($levelsubjects as $levelsubject)  
                                                                                    @if ($levelsubject->kategori=="Pelajaran Wajib" && $levelsubject->sub_of == '')
                                                                                        <tr>
                                                                                            <th scope="row">{{$i++}}</th>
                                                                                            <td>{{$levelsubject->mata_pelajaran}}</td>
                                                                                            <td class="text-center">
                                                                                                <a href="/score/{{$levelsubject->id}}/{{$sublevel->id}}/add-score-subject" target="_blank" class="btn btn-sm btn-success">Isi Nilai</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                                
                                                                                <tr>
                                                                                    <td colspan="3">
                                                                                        <strong>Muatan Lokal</strong>   
                                                                                    </td>
                                                                                </tr>
                                                                                @php
                                                                                    $i = 1;
                                                                                @endphp
                                                                                @foreach ($levelsubjects as $levelsubject)  
                                                                                    @if ($levelsubject->kategori=="Muatan Lokal")
                                                                                        <tr>
                                                                                            <th scope="row">{{$i++}}</th>
                                                                                            <td>{{$levelsubject->mata_pelajaran}}</td>
                                                                                            <td class="text-center"><a href="/score/{{$levelsubject->id}}/{{$sublevel->id}}/add-score-subject" target="_blank" class="btn btn-sm btn-success">Isi Nilai</a></td>
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

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-warning card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Nilai Keterampilan (K-4)
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
                                                                        <table class="table table-bordered" id="spiritual-table">
                                                                            <thead class="table-dsuccess text-center">
                                                                                <tr>
                                                                                    <th rowspan="2" scope="col" style="width: 2em">#</th>
                                                                                    <th rowspan="2" scope="col" colspan="2">Mata Pelajaran</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="3">
                                                                                        <strong>Pelajaran Wajib</strong>   
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>1</td>
                                                                                    <td colspan="2">Pendidikan Agama Islam</td>
                                                                                </tr>
                                                                                @php
                                                                                    $i = 1;
                                                                                @endphp
                                                                                @foreach ($levelsubjects as $levelsubject)  
                                                                                    @if ($levelsubject->kategori=="Pelajaran Wajib" && $levelsubject->sub_of == 'on')
                                                                                        <tr>
                                                                                            <th scope="row"></th>
                                                                                            <td>{{$i++}}. {{$levelsubject->mata_pelajaran}}</td>
                                                                                            <td class="text-center">
                                                                                                <a href="/score/{{$levelsubject->id}}/{{$sublevel->id}}/add-score-practice-subject" target="_blank" class="btn btn-sm btn-warning">Isi Nilai</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach

                                                                                @php
                                                                                    $i = 2;
                                                                                @endphp
                                                                                @foreach ($levelsubjects as $levelsubject)  
                                                                                    @if ($levelsubject->kategori=="Pelajaran Wajib" && $levelsubject->sub_of == '')
                                                                                        <tr>
                                                                                            <th scope="row">{{$i++}}</th>
                                                                                            <td>{{$levelsubject->mata_pelajaran}}</td>
                                                                                            <td class="text-center">
                                                                                                <a href="/score/{{$levelsubject->id}}/{{$sublevel->id}}/add-score-practice-subject" target="_blank" class="btn btn-sm btn-warning">Isi Nilai</a>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endif
                                                                                @endforeach
                                                                                
                                                                                
                                                                                <tr>
                                                                                    <td colspan="3">
                                                                                        <strong>Muatan Lokal</strong>   
                                                                                    </td>
                                                                                </tr>
                                                                                @php
                                                                                    $i = 1;
                                                                                @endphp
                                                                                @foreach ($levelsubjects as $levelsubject)  
                                                                                    @if ($levelsubject->kategori=="Muatan Lokal")
                                                                                        <tr>
                                                                                            <th scope="row">{{$i++}}</th>
                                                                                            <td>{{$levelsubject->mata_pelajaran}}</td>
                                                                                            <td class="text-center"><a href="/score/{{$levelsubject->id}}/{{$sublevel->id}}/add-score-practice-subject" target="_blank" class="btn btn-sm btn-warning">Isi Nilai</a></td>
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

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-info card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Ekstrakurikuler
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
                                                                        <table class="table table-bordered" id="extracurricular-table">
                                                                            <thead class="table-info text-center">
                                                                                <tr>
                                                                                    <th rowspan="2" scope="col" style="width: 2em">#</th>
                                                                                    <th rowspan="2" scope="col">Nama Siswa</th>
                                                                                    <th scope="col" colspan="6">Ekstrakurikuler</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="col">Eks 1</th>
                                                                                    <th scope="col">Keterangan</th>
                                                                                    <th scope="col">Eks 2</th>
                                                                                    <th scope="col">Keterangan</th>
                                                                                    <th scope="col">Eks 3</th>
                                                                                    <th scope="col">Keterangan</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($studentperiods as $student)
                                                                                    @if ($student->sub_level_id == $sublevel->id)
                                                                                        <tr>
                                                                                            
                                                                                            <td>
                                                                                                {{$loop->iteration}}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{$student->nama}}
                                                                                            </td>

                                                                                            @foreach (extracurricular($student->id, $semester->id) as $item)
                                                                                                <td class="text-center">
                                                                                                    {{$item->nama}}
                                                                                                </td>
                                                                                                <td class="text-center">
                                                                                                    @if (!convert($item->convert_id))
                                                                                                        0
                                                                                                    @else
                                                                                                        {{convert($item->convert_id)->nilai_huruf}}
                                                                                                    @endif
                                                                                                    <button 
                                                                                                        class="btn btn-sm btn-link edit-extra-button"

                                                                                                        data-semester = "{{$semester->id}}"
                                                                                                        
                                                                                                        data-target="#editScoreExtraModal"

                                                                                                        data-toggle="modal" 
                                                                                                        
                                                                                                        data-nama="{{$student->nama}}"
                                                                                                        
                                                                                                        data-student = "{{$student->id}}"
                                                                                                        
                                                                                                        data-level = "{{$level->id}}"
                                                                                                        
                                                                                                        data-id = "{{($item->id)}}"
                                                                                                        data-convert = "{{($item->convert_id)}}"
                                                                                                        data-ekstra = "{{$item->nama}}"
                                                                                                    >
                                                                                                        <i class="fas fa-edit"></i>
                                                                                                    </button>
                                                                                                </td>
                                                                                            @endforeach

                                                                                            @php
                                                                                                $i = 0;
                                                                                                $jumlah = count(extracurricular($student->id, $semester->id));
                                                                                                $sisa = 3 - $jumlah;
                                                                                            @endphp


                                                                                            @while ($i < $sisa)
                                                                                                <td class="text-center">
                                                                                                    -
                                                                                                    <button 
                                                                                                        class="btn btn-sm btn-link extra-button"

                                                                                                        data-semester = "{{$semester->id}}"
                                                                                                        
                                                                                                        data-target="#tambahExtraModal"
                                                                                                        
                                                                                                        data-toggle="modal" 

                                                                                                        data-nama="{{$student->nama}}"                        
                                                                                                        
                                                                                                        data-student = "{{$student->id}}"

                                                                                                        data-level = "{{$level->id}}"
                                                                                                    >
                                                                                                        <i class="fas fa-edit"></i>
                                                                                                    </button>
                                                                                                </td>
                                                                                                <td>-</td>
                                                                                                @php
                                                                                                    $i++;
                                                                                                @endphp
                                                                                            @endwhile
                                                                                            
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

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-secondary card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Saran
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
                                                                        <table class="table table-bordered" id="advice-table">
                                                                            <thead class="table-secondary text-center">
                                                                                <tr>
                                                                                    <th scope="col" style="width: 2em">#</th>
                                                                                    <th scope="col" >Nama Siswa</th>
                                                                                    <th scope="col" >Saran</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($studentperiods as $student)
                                                                                    @if ($student->sub_level_id == $sublevel->id)
                                                                                        <tr>
                                                                                            <td class="text-center">{{$loop->iteration}}</td>
                                                                                            <td>{{$student->nama}}</td>
                                                                                            <td>
                                                                                                @if (!is_object(advice($student->id,$level->id,$semester->id)))
                                                                                                    -
                                                                                                @else
                                                                                                    {{advice($student->id,$level->id,$semester->id)->saran}}
                                                                                                @endif
                                                                                                <button 
                                                                                                    class="btn btn-sm btn-link advice-button"
                                                                                                    
                                                                                                    data-target="#tambahAdviceModal"
                                                                                                    
                                                                                                    data-toggle="modal" 

                                                                                                    data-nama="{{$student->nama}}"
                                                                                                    @if (is_object(advice($student->id,$level->id,$semester->id)))
                                                                                                        data-saran = "{{advice($student->id,$level->id,$semester->id)->saran}}"
                                                                                                    @endif 
                                                                                                    
                                                                                                    data-student = "{{$student->id}}"
                                                                                                    data-semester = "{{$semester->id}}"
                                                                                                    data-level = "{{$level->id}}"
                                                                                                >
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                </button>
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

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card card-light card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                Ketidakhadiran
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
                                                                        <table class="table table-bordered" id="absent-table">
                                                                            <thead class="table-light text-center">
                                                                                <tr>
                                                                                    <th scope="col" style="width: 2em">#</th>
                                                                                    <th scope="col" >Nama Siswa</th>
                                                                                    <th scope="col" >Sakit</th>
                                                                                    <th scope="col" >Izin</th>
                                                                                    <th scope="col" >Tanpa Keterangan</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                @foreach ($studentperiods as $student)
                                                                                    @if ($student->sub_level_id == $sublevel->id)
                                                                                        <tr>
                                                                                            <td class="text-center">{{$loop->iteration}}</td>
                                                                                            <td>{{$student->nama}}</td>
                                                                                            <td class="text-center">
                                                                                                @if (!is_object(absent($student->id,$level->id,$semester->id)))
                                                                                                    -
                                                                                                @else
                                                                                                    {{absent($student->id,$level->id,$semester->id)->sakit}}
                                                                                                @endif
                                                                                                <button 
                                                                                                    class="btn btn-sm btn-link absent-button"
                                                                                                    
                                                                                                    data-target="#tambahAbsentModal"
                                                                                                    
                                                                                                    data-toggle="modal" 

                                                                                                    data-nama="{{$student->nama}}"
                                                                                                    @if (is_object(absent($student->id,$level->id,$semester->id)))
                                                                                                        data-absent = "{{absent($student->id,$level->id,$semester->id)->sakit}}"
                                                                                                    @endif 
                                                                                                    
                                                                                                    data-student = "{{$student->id}}"
                                                                                                    data-semester = "{{$semester->id}}"
                                                                                                    data-level = "{{$level->id}}"
                                                                                                    data-name = "sakit"
                                                                                                    data-label = "Sakit"
                                                                                                >
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                </button>
                                                                                                
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @if (!is_object(absent($student->id,$level->id,$semester->id)))
                                                                                                    -
                                                                                                @else
                                                                                                    {{absent($student->id,$level->id,$semester->id)->izin}}
                                                                                                @endif
                                                                                                <button 
                                                                                                    class="btn btn-sm btn-link absent-button"
                                                                                                    
                                                                                                    data-target="#tambahAbsentModal"
                                                                                                    
                                                                                                    data-toggle="modal" 

                                                                                                    data-nama="{{$student->nama}}"
                                                                                                    @if (is_object(absent($student->id,$level->id,$semester->id)))
                                                                                                        data-absent = "{{absent($student->id,$level->id,$semester->id)->izin}}"
                                                                                                    @endif 
                                                                                                    
                                                                                                    data-student = "{{$student->id}}"
                                                                                                    data-semester = "{{$semester->id}}"
                                                                                                    data-level = "{{$level->id}}"
                                                                                                    data-name = "izin"
                                                                                                    data-label = "Izin"
                                                                                                >
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                </button>
                                                                                            </td>
                                                                                            <td class="text-center">
                                                                                                @if (!is_object(absent($student->id,$level->id,$semester->id)))
                                                                                                    -
                                                                                                @else
                                                                                                    {{absent($student->id,$level->id,$semester->id)->tanpa_keterangan}}
                                                                                                @endif
                                                                                                <button 
                                                                                                    class="btn btn-sm btn-link absent-button"
                                                                                                    
                                                                                                    data-target="#tambahAbsentModal"
                                                                                                    
                                                                                                    data-toggle="modal" 

                                                                                                    data-nama="{{$student->nama}}"
                                                                                                    @if (is_object(absent($student->id,$level->id,$semester->id)))
                                                                                                        data-absen= "{{absent($student->id,$level->id,$semester->id)->tanpa_keterangan}}"
                                                                                                    @endif 
                                                                                                    
                                                                                                    data-student = "{{$student->id}}"
                                                                                                    data-semester = "{{$semester->id}}"
                                                                                                    data-level = "{{$level->id}}"

                                                                                                    data-name = "tanpa_keterangan"
                                                                                                    data-label = "Tanpa Keterangan"
                                                                                                >
                                                                                                    <i class="fas fa-edit"></i>
                                                                                                </button>
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

                                            @if ($semester->semester == "GENAP")
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    Status Kenaikan Kelas
                                                                </h3>
                                            
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered" id="spiritual-table">
                                                                        <thead class="table-primary text-center">
                                                                            <tr>
                                                                                <th scope="col" style="width: 2em">#</th>
                                                                                <th scope="col">Nama</th>
                                                                                <th scope="col" class="text-center">Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($studentperiods as $student)
                                                                                @if ($student->sub_level_id == $sublevel->id)
                                                                                    <tr>
                                                                                        <th scope="row">{{$loop->iteration}}</th>
                                                                                        <td>{{$student->nama}}</td>
                                                                                        <td class="text-center">
                                                                                            @if (!is_object(Uplevel($student->id,$semester->id)))
                                                                                                -
                                                                                            @else
                                                                                                @if (Uplevel($student->id,$semester->id)->status == 1)
                                                                                                    <span class="text-primary">Naik Kelas</span> 
                                                                                                @else
                                                                                                    <span class="text-danger">Tidak Naik Kelas</span>
                                                                                                @endif
                                                                                            @endif

                                                                                            <button 
                                                                                                class="btn btn-sm btn-link status-button"
                                                                                                
                                                                                                data-target="#aturKenaikanModal"
                                                                                                
                                                                                                data-toggle="modal" 

                                                                                                data-nama="{{$student->nama}}"
                                                                                                @if (is_object(Uplevel($student->id,$semester->id)))
                                                                                                    data-status = "{{is_object(Uplevel($student->id,$semester->id))->status}}"
                                                                                                @endif 
                                                                                                
                                                                                                data-student = "{{$student->id}}"
                                                                                                data-semester = "{{$semester->id}}"
                                                                                                data-level = "{{$level->id}}"
                                                                                            >
                                                                                                <i class="fas fa-edit"></i>
                                                                                            </button>
                                                                                        </td>
                                                                                        
                                                                                    </tr>
                                                                                @endif
                                                                            @endforeach
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-body-->
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
    
            {{-- Modal Input Aspek Sosial --}}
            <div class="modal-tambah-social-spiritual">
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="tambahSatuanSocialSpiritualModal" tabindex="-1" role="dialog" aria-labelledby="#tambahSatuanSocialSpiritualModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title-social-spiritual" id="#tambahSatuanSocialSpiritualModalLabel" >Tambah Nilai Aspek Sosial</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="score" class="col-sm-3 col-form-label">Nilai</label>
                                    <div class="col-sm-9 ">
                                        <input type="number" class="form-control score" name="score" min="1" max="4">
                                        <small class="text-danger">Isi Nilai dengan Rentang 1 - 4</small>
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

            {{-- Modal Input Ekstrakurukuler --}}
            <div class="modal-tambah-extra">
                <form action="" method="POST">
                    @csrf
                    <div class="modal fade" id="tambahExtraModal" tabindex="-1" role="dialog" aria-labelledby="#tambahExtraModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title-extra" id="#tambahExtraModalLabel" >Tambah Ekstrakurikuler</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="score" class="col-sm-3 col-form-label">Eks</label>
                                    <div class="col-sm-9 ">
                                        <select class="custom-select" id="extra " name="extra">
                                            @foreach ($extras as $extra)
                                                <option value="{{$extra->id}}">{{$extra->nama}}</option>
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
            </div>

            {{-- Modal Input Nilai Ekstrakurukuler --}}
            <div class="modal-edit-extra">
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="editScoreExtraModal" tabindex="-1" role="dialog" aria-labelledby="#editScoreExtraModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title-extra" id="#editScoreExtraModalLabel" >Tambah Nilai Ekstrakurikuler</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="ekstra" class="col-sm-3 col-form-label">Eks</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control ekstra" name="ekstra" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="score" class="col-sm-3 col-form-label">Nilai</label>
                                    <div class="col-sm-9 ">
                                        <select class="custom-select score" id="score" name="score">
                                            @foreach ($converts as $convert)
                                                <option value="{{$convert->id}}">{{$convert->nilai_huruf}}</option>
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
            </div>

            {{-- Modal Input Saran --}}
            <div class="modal-tambah-advice">
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="tambahAdviceModal" tabindex="-1" role="dialog" aria-labelledby="#tambahAdviceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title-extra" id="#tambahAdviceModalLabel" >Tambah Saran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="advice" class="col-sm-3 col-form-label">Saran</label>
                                    <div class="col-sm-9 ">
                                        <textarea class="form-control advice" name="advice"></textarea>
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

            {{-- Modal Input Ketidakhadiran --}}
            <div class="modal-tambah-absent">
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="tambahAbsentModal" tabindex="-1" role="dialog" aria-labelledby="#tambahAbsentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title-extra" id="#tambahAbsentModalLabel" >Ketidakhadiran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="absent" class="col-sm-3 col-form-label absent-label"></label>
                                    <div class="col-sm-9 ">
                                        <input type="number" class="form-control absent" id="absent" name="">
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

            {{-- Modal Input Status Kenaikan Kelas --}}
            <div class="modal-status-kenaikan-kelas">
                <form action="" method="POST">
                    @csrf
                    @method('patch')
                    <div class="modal fade" id="aturKenaikanModal" tabindex="-1" role="dialog" aria-labelledby="#aturKenaikanModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title modal-title-extra" id="#aturKenaikanModalLabel" >Status Kenaikan Kelas</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="nama-siswa" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9 ">
                                        <input type="text" class="form-control nama-siswa" name="nama_siswa" readonly>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label for="absent" class="col-sm-3 col-form-label absent-label">Status</label>
                                    <div class="col-sm-9 ">
                                        <select name="status" class="custom-select status" id="status">
                                            <option value="1">Naik Kelas</option>
                                            <option value="0">Tidak Naik Kelas</option>
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
            </div>
        </section>
        <!-- /.content -->

        
@endsection

@section('script')
<script type="text/javascript">
    $('#social-table').DataTable();
    $('#spiritual-table').DataTable();
    $('#extracurricular-table').DataTable();
    $('#advice-table').DataTable();
    $('#absent-table').DataTable();
    
    $(document).ready(function(){
        $('.social-score-button').click(function(){
            let student = $(this).data('student');
            let socialPeriod = $(this).data('socialperiod');
            let nama = $(this).data('nama');
            let score = $(this).data('score');  

            if (!score){
                score = 1;
            }

            $('.modal-title-social-spiritual').text("Tambah Nilai Aspek Sosial")
            $('.nama-siswa').val(nama);
            $('.score').val(score);

            $('.modal-tambah-social-spiritual form').attr(`action`,`/score/${socialPeriod}/${student}/create-social-score`);
            
        })

        $('.spiritual-score-button').click(function(){
            let student = $(this).data('student');
            let spiritualPeriod = $(this).data('spiritualperiod');
            let nama = $(this).data('nama');
            let score = $(this).data('score');  

            if (!score){
                score = 1;
            }

            $('.modal-title-social-spiritual').text("Tambah Nilai Aspek Spiritual")
            $('.nama-siswa').val(nama);
            $('.score').val(score);

            $('.modal-tambah-social-spiritual form').attr(`action`,`/score/${spiritualPeriod}/${student}/create-spiritual-score`);
            
        })

        $('.extra-button').click(function(){
            let student = $(this).data('student');
            let semester = $(this).data('semester');
            let level = $(this).data('level');

            let nama = $(this).data('nama');
            $('.nama-siswa').val(nama);
            
            $('.modal-tambah-extra form').attr(`action`,`/score/${level}/${semester}/${student}/create-extra`);
            
        })

        $('.edit-extra-button').click(function(){
            let student = $(this).data('student');
            let semester = $(this).data('semester');
            let level = $(this).data('level');

            let nama = $(this).data('nama');
            $('.nama-siswa').val(nama);

            let ekstra = $(this).data('ekstra');
            $('.ekstra').val(ekstra);

            let convert = $(this).data('convert');            

            if (convert) $('.score').val(convert);

            let id = $(this).data('id');
            
            $('.modal-edit-extra form').attr(`action`,`/score/${level}/${semester}/${student}/${id}/edit-extra`);            
        })
        
        $('.advice-button').click(function(){
            let student = $(this).data('student');
            let semester = $(this).data('semester');
            let level = $(this).data('level');

            let nama = $(this).data('nama');
            $('.nama-siswa').val(nama);

            let saran = $(this).data('saran');

            if (saran) $('.advice').text(saran);
            $('.modal-tambah-advice form').attr(`action`,`/score/${level}/${semester}/${student}/add-advice`);
        })

        $('.absent-button').click(function(){
            let student = $(this).data('student');
            let semester = $(this).data('semester');
            let level = $(this).data('level');

            let nama = $(this).data('nama');
            $('.nama-siswa').val(nama);

            let name = $(this).data('name');
            let label = $(this).data('label');

            $('.absent-label').text(label);
            $('.absent').attr('name',name);

            $('.modal-tambah-absent form').attr(`action`,`/score/${level}/${semester}/${student}/add-absent`);
        })

        $('.status-button').click(function(){
            let student = $(this).data('student');
            let semester = $(this).data('semester');
            let level = $(this).data('level');

            let nama = $(this).data('nama');
            $('.nama-siswa').val(nama);

            $('.modal-status-kenaikan-kelas form').attr(`action`,`/score/${level}/${semester}/${student}/add-status`);
        })
        
    })    
</script>
    
@endsection