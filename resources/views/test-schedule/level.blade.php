@extends('layouts.main')

@section('content')

        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">                
                    <div class="card-header">
                        <h2 ><strong>Kelas {{$level->kelas}}</strong></h2>
                    </div>    

                    <div class="card-body">
                        <h3><strong>Jadwal Ujian Mata Pelajaran</strong></h3> 
                        <table class="table table-striped"  id="table-subject">
                            <table class="table table-striped table-sm"  id="sub-level-student">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th class="text-center">Mata Pelajaran</th>
                                        <th class="text-center">Tengah Semester</th>
                                        <th class="text-center">Akhir Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="4"><strong>Pelajaran Wajib</strong></td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td colspan="3">Pendidikan Agama Islam</td>
                                    </tr>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($levelsubjects as $levelsubject)
                                        @if ($levelsubject->sub_of == 'on' && $levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->tema != 'on')
                                        <tr>
                                            <td>
                                            </td>
                                            <td>{{ $i++ }}. {{ $levelsubject->mata_pelajaran }}</td>
                                            <td class="text-center">
                                                @if (TestSchedule::schedule($levelsubject->id, "Tengah Semester"))
                                                    {{ TestSchedule::schedule($levelsubject->id, "Tengah Semester")->tanggal }}
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester('{{TestSchedule::schedule($levelsubject->id, 'Tengah Semester')->tanggal}}','{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Tengah Semester')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @else 
                                                    <i>Belum Diatur</i>
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester(0,'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Tengah Semester')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (Student::testUrl($levelsubject->id, 'Tengah Semester'))
                                                    <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                @else
                                                    <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (TestSchedule::schedule($levelsubject->id, "Akhir Semester"))
                                                    {{ TestSchedule::schedule($levelsubject->id, "Akhir Semester")->tanggal }}
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester('{{TestSchedule::schedule($levelsubject->id, 'Akhir Semester')->tanggal}}','{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @else 
                                                    <i>Belum Diatur</i>
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester(0,'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (Student::testUrl($levelsubject->id, 'Akhir Semester'))
                                                    <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                @else
                                                    <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                @endif
                                            </td>
                                        </tr> 
                                        @endif                                            
                                    @endforeach

                                    @php
                                        $i = 2;
                                        $j = 1;
                                    @endphp
                                    
                                    <tr>
                                        <td><strong>{{ $i }}</strong> 
                                        </td>
                                        <td >
                                            <strong>Tema</strong> 
                                            <span class="float-right">
                                                <button 
                                                    class="btn btn-sm btn-primary"
                                                    data-toggle="modal" data-target="#temaScheduleModal" id="tambah-jadwal-tema">Tambah Jadwal Ujian Tema</button>
                                            </span> 
                                        </td>
                                    </tr> 
                                        @if ($temaTestSchedules->isNotEmpty())
                                            @foreach ($temaTestSchedules as $temaTestSchedule)
                                            <tr>
                                                <td>
                                                </td>
                                                <td>{{ $j++ }}. {{ $temaTestSchedule->tema }}</td>

                                                <td class="text-center">
                                                    @if (TestSchedule::themeTest('Tengah Semester', $level->id, $temaTestSchedule->tema))
                                                        {{ TestSchedule::themeTest('Tengah Semester', $level->id, $temaTestSchedule->tema)->tanggal }}
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#themeScheduleModal"
                                                            onclick="themeSchedule('Tengah Semester','{{ $temaTestSchedule->tema }}','{{TestSchedule::themeTest('Tengah Semester', $level->id, $temaTestSchedule->tema)->tanggal}}', {{Year::thisSemester()->id}},  {{$level->id}})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @else
                                                        <i>Belum Diatur</i>
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#themeScheduleModal"
                                                            onclick="themeSchedule('Tengah Semester','{{ $temaTestSchedule->tema }}',0, {{Year::thisSemester()->id}},  {{$level->id}})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @endif

                                                    @if (Student::themeTestUrl('Tengah Semester', Year::thisSemester()->id, $temaTestSchedule->tema, $level->id))
                                                        <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                    @else
                                                        <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                        @if (TestSchedule::themeTest('Akhir Semester', $level->id, $temaTestSchedule->tema))
                                                        {{ TestSchedule::themeTest('Akhir Semester', $level->id, $temaTestSchedule->tema)->tanggal }}
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#themeScheduleModal"
                                                            onclick="themeSchedule('Akhir Semester','{{ $temaTestSchedule->tema }}','{{TestSchedule::themeTest('Akhir Semester', $level->id, $temaTestSchedule->tema)->tanggal}}', {{Year::thisSemester()->id}},  {{$level->id}})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @else
                                                        <i>Belum Diatur</i>
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#themeScheduleModal"
                                                            onclick="themeSchedule('Akhir Semester','{{ $temaTestSchedule->tema }}',0, {{Year::thisSemester()->id}},  {{$level->id}})">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @endif

                                                    @if (Student::themeTestUrl('Akhir Semester', Year::thisSemester()->id, $temaTestSchedule->tema, $level->id))
                                                        <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                    @else
                                                        <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                    <tr>
                                        <td colspan="4" class="text-center text-danger">
                                            <i>Jadwal Ujian Untuk <strong>Tema</strong> Belum Diatur</i>
                                        </td>
                                    </tr>
                                    @endif
                                    

                                    @php
                                        $i = 3;
                                    @endphp
                                    @foreach ($levelsubjects as $levelsubject)
                                        @if ($levelsubject->sub_of != 'on' && $levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->tema != 'on')
                                            <tr>
                                                <td>
                                                    {{ $i++ }}
                                                </td>
                                                <td>{{ $levelsubject->mata_pelajaran }}</td>
                                                <td class="text-center">
                                                    @if (TestSchedule::schedule($levelsubject->id, "Tengah Semester"))
                                                        {{ TestSchedule::schedule($levelsubject->id, "Tengah Semester")->tanggal }}
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#subjectScheduleModal"
                                                            onclick="ujianSemester('{{TestSchedule::schedule($levelsubject->id, 'Tengah Semester')->tanggal}}','{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Tengah Semester')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @else 
                                                        <i>Belum Diatur</i>
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#subjectScheduleModal"
                                                            onclick="ujianSemester(0,'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Tengah Semester')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @endif
                                                    @if (Student::testUrl($levelsubject->id, 'Tengah Semester'))
                                                        <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                    @else
                                                        <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if (TestSchedule::schedule($levelsubject->id, "Akhir Semester"))
                                                        {{ TestSchedule::schedule($levelsubject->id, "Akhir Semester")->tanggal }}
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#subjectScheduleModal"
                                                            onclick="ujianSemester('{{TestSchedule::schedule($levelsubject->id, 'Akhir Semester')->tanggal}}','{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @else 
                                                        <i>Belum Diatur</i>
                                                        <button
                                                            class="btn btn-sm btn-link spiritual-score-button"
                                                            data-toggle="modal" data-target="#subjectScheduleModal"
                                                            onclick="ujianSemester(0,'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    @endif
                                                    @if (Student::testUrl($levelsubject->id, 'Akhir Semester'))
                                                        <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                    @else
                                                        <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                    @endif
                                                </td>
                                            </tr> 
                                        @endif                                            
                                    @endforeach

                                    @php
                                        $i = 1;
                                    @endphp
                                    <tr>
                                        <td colspan="4"><strong>Muatan Lokal</strong></td>
                                    </tr>
                                    @foreach ($levelsubjects as $levelsubject)
                                        @if ($levelsubject->kategori == "Muatan Lokal")
                                        <tr>
                                            <td>
                                                {{ $i++ }}
                                            </td>
                                            <td>{{ $levelsubject->mata_pelajaran }}</td>
                                            <td class="text-center">
                                                @if (TestSchedule::schedule($levelsubject->id, "Tengah Semester"))
                                                    {{ TestSchedule::schedule($levelsubject->id, "Tengah Semester")->tanggal }}
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester('{{TestSchedule::schedule($levelsubject->id, 'Tengah Semester')->tanggal}}','{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Tengah Semester')"
                                                    >
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @else 
                                                    <i>Belum Diatur</i>
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester(0,'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Tengah Semester')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (Student::testUrl($levelsubject->id, 'Tengah Semester'))
                                                    <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                @else
                                                    <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if (TestSchedule::schedule($levelsubject->id, "Akhir Semester"))
                                                    {{ TestSchedule::schedule($levelsubject->id, "Akhir Semester")->tanggal }}
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester('{{TestSchedule::schedule($levelsubject->id, 'Akhir Semester')->tanggal}}','{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @else 
                                                    <i>Belum Diatur</i>
                                                    <button
                                                        class="btn btn-sm btn-link spiritual-score-button"
                                                        data-toggle="modal" data-target="#subjectScheduleModal"
                                                        onclick="ujianSemester(0,'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                @endif
                                                @if (Student::testUrl($levelsubject->id, 'Akhir Semester'))
                                                    <strong><small class="text-primary">Sudah Dibuat</small></strong>
                                                @else
                                                    <strong><small class="text-danger">Belum Dibuat</small></strong>
                                                @endif
                                            </td>
                                        </tr> 
                                        @endif                                            
                                    @endforeach
                                </tbody>
                            </table>
                        </table>
                    </div>
                    <div class="card-body">                      
                        <div class="row mt-3">
                            <div class="col-7 col-sm-9">                                
                                <div class="tab-content" id="vert-tabs-right-tabContent">
                                    @foreach ($sublevel as $sl)
                                        <div class="tab-pane fade 
                                        @if ($loop->iteration == 1)
                                        active show
                                        @endif
                                        " id="vert-tabs-right-{{$loop->iteration}}" role="tabpanel" aria-labelledby="vert-tabs-right-{{$loop->iteration}}-tab">
                                        <h3><strong>Kelas {{$level->kelas}} {{$sl->alias}}</strong></h3>
                                            <div class="col-sm-8">
                                                <table class="table table-striped" id="sub-level">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Nama Siswa</th>
                                                            <th>Tengah Semester</th>
                                                            <th>Akhir Semester</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($sublevelstudents as $sublevelstudent)
                                                            @if ($sublevelstudent->sub_level_id == $sl->id)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td class="student">{{ $sublevelstudent->nama }}</td>
                                                                <td>
                                                                    @if ($testSchedulesForMid)
                                                                        @if (Student::testPermit($sublevelstudent->level_student_id, $testSchedulesForMid->id))
                                                                            @if (Student::testPermit($sublevelstudent->level_student_id, $testSchedulesForMid->id)->allow == 'on')
                                                                                
                                                                                <div class="custom-control custom-switch">
                                                                                    <form action="" method="post" id="mid-form-permit{{$i}}">
                                                                                        @csrf
                                                                                        @method('patch')

                                                                                        <input 
                                                                                            type="checkbox" 
                                                                                            class="custom-control-input" id="mid-customSwitch{{$i}}" name="allow" 
                                                                                            checked value="on"
                                                                                        >

                                                                                        <label 
                                                                                            class="custom-control-label" 
                                                                                            for="mid-customSwitch{{$i}}"  
                                                                                            onclick="izinUjian({{$i}}, 'mid', {{$sublevelstudent->level_student_id}}, {{$testSchedulesForMid->id}})" 
                                                                                            id="mid-label-switch{{$i}}" 
                                                                                            data-change="0"
                                                                                        >
                                                                                            Dizinkan
                                                                                        </label>

                                                                                        <button 
                                                                                            type="submit" 
                                                                                            class=" btn btn-sm btn-primary submit-allow" 
                                                                                            id="mid-submit-allow{{$i}}"
                                                                                        >
                                                                                            Simpan
                                                                                        </button>

                                                                                    </form>
                                                                                </div>

                                                                            @else   
                                                                                <div class="custom-control custom-switch">
                                                                                    <form action="" method="post" id="mid-form-permit{{$i}}">
                                                                                        @csrf
                                                                                        @method('patch')

                                                                                    <input 
                                                                                        type="checkbox" 
                                                                                        class="custom-control-input" 
                                                                                        id="mid-customSwitch{{$i}}" 
                                                                                        name="allow" 
                                                                                        value="off"
                                                                                    >
                                                                                    <label 
                                                                                        class="custom-control-label" 
                                                                                        for="mid-customSwitch{{$i}}" 
                                                                                        id="mid-label-switch{{$i}}" 
                                                                                        onclick="izinUjian({{$i}}, 'mid', {{$sublevelstudent->level_student_id}}, {{$testSchedulesForMid->id}})" 
                                                                                        data-change="0"
                                                                                    >
                                                                                        <span 
                                                                                            class="text-danger"
                                                                                        >
                                                                                            Belum Dizinkan
                                                                                        </span>
                                                                                    </label>
                                                                                    <button 
                                                                                        type="submit" 
                                                                                        class=" btn btn-sm btn-primary submit-allow" 
                                                                                        id="mid-submit-allow{{$i}}"
                                                                                    >
                                                                                        Simpan
                                                                                    </button>
                                                                                </form>
                                                                                </div> 
                                                                            @endif
                                                                        @else 
                                                                        <div class="custom-control custom-switch">
                                                                            <form action="" method="post" id="mid-form-permit{{$i}}">
                                                                                @csrf
                                                                                @method('patch')
                                                                                <input 
                                                                                    type="checkbox" 
                                                                                    class="custom-control-input" 
                                                                                    id="mid-customSwitch{{$i}}" 
                                                                                    name="allow" 
                                                                                    value="off"
                                                                                >
                                                                                <label 
                                                                                    class="custom-control-label" 
                                                                                    for="mid-customSwitch{{$i}}" 
                                                                                    id="mid-label-switch{{$i}}" 
                                                                                    onclick="izinUjian({{$i}}, 'mid', {{$sublevelstudent->level_student_id}}, {{$testSchedulesForMid->id}})" 
                                                                                    data-change="0"
                                                                                >
                                                                                    <span class="text-danger">
                                                                                        Belum Dizinkan
                                                                                    </span>
                                                                                </label>
                                                                                <button 
                                                                                    type="submit" 
                                                                                    class="btn btn-sm btn-primary submit-allow" 
                                                                                    id="mid-submit-allow{{$i}}"
                                                                                >
                                                                                    Simpan
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                        @endif
                                                                    @else 
                                                                        <i>Jadwal Ujian Tengah Semester Belum Diatur</i>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($testSchedulesForLast)
                                                                        @if (Student::testPermit($sublevelstudent->level_student_id, $testSchedulesForLast->id))
                                                                            @if (Student::testPermit($sublevelstudent->level_student_id, $testSchedulesForLast->id)->allow == 'on')
                                                                            <div class="custom-control custom-switch">
                                                                                <form action="" method="post" id="last-form-permit{{$i}}">
                                                                                    @csrf
                                                                                    @method('patch')

                                                                                    <input 
                                                                                        type="checkbox" 
                                                                                        class="custom-control-input" id="last-customSwitch{{$i}}" name="allow" 
                                                                                        checked value="on"
                                                                                    >

                                                                                    <label 
                                                                                        class="custom-control-label" 
                                                                                        for="last-customSwitch{{$i}}"  
                                                                                        onclick="izinUjian({{$i}},'last', {{$sublevelstudent->level_student_id}}, {{$testSchedulesForLast->id}})" 
                                                                                        id="last-label-switch{{$i}}" 
                                                                                        data-change="0"
                                                                                    >
                                                                                        Dizinkan
                                                                                    </label>

                                                                                    <button 
                                                                                        type="submit" 
                                                                                        class=" btn btn-sm btn-primary submit-allow" 
                                                                                        id="last-submit-allow{{$i}}"
                                                                                    >
                                                                                        Simpan
                                                                                    </button>

                                                                                </form>
                                                                            </div>

                                                                        @else   
                                                                            <div class="custom-control custom-switch">
                                                                                <form action="" method="post" id="last-form-permit{{$i}}">
                                                                                    @csrf
                                                                                    @method('patch')

                                                                                    <input 
                                                                                        type="checkbox" 
                                                                                        class="custom-control-input" 
                                                                                        id="last-customSwitch{{$i}}" 
                                                                                        name="allow" 
                                                                                        value="off"
                                                                                    >
                                                                                    <label 
                                                                                        class="custom-control-label" 
                                                                                        for="last-customSwitch{{$i}}" 
                                                                                        id="last-label-switch{{$i}}" 
                                                                                        onclick="izinUjian({{$i}},'last', {{$sublevelstudent->level_student_id}}, {{$testSchedulesForLast->id}})" 
                                                                                        data-change="0"
                                                                                    >
                                                                                        <span 
                                                                                            class="text-danger"
                                                                                        >
                                                                                            Belum Dizinkan
                                                                                        </span>
                                                                                    </label>
                                                                                    <button 
                                                                                        type="submit" 
                                                                                        class=" btn btn-sm btn-primary submit-allow" 
                                                                                        id="last-submit-allow{{$i}}"
                                                                                    >
                                                                                        Simpan
                                                                                    </button>
                                                                                </form>
                                                                            </div> 
                                                                        @endif
                                                                    @else 
                                                                    <div class="custom-control custom-switch">
                                                                        <form action="" method="post" id="last-form-permit{{$i}}">
                                                                            @csrf
                                                                            @method('patch')
                                                                            <input 
                                                                                type="checkbox" 
                                                                                class="custom-control-input" 
                                                                                id="last-customSwitch{{$i}}" 
                                                                                name="allow" 
                                                                                value="off"
                                                                            >
                                                                            <label 
                                                                                class="custom-control-label" 
                                                                                for="last-customSwitch{{$i}}" 
                                                                                id="last-label-switch{{$i}}" 
                                                                                onclick="izinUjian({{$i}},'last', {{$sublevelstudent->level_student_id}}, {{$testSchedulesForLast->id}})" 
                                                                                data-change="0"
                                                                            >
                                                                                <span class="text-danger">
                                                                                    Belum Dizinkan
                                                                                </span>
                                                                            </label>
                                                                            <button 
                                                                                type="submit" 
                                                                                class="btn btn-sm btn-primary submit-allow" 
                                                                                id="last-submit-allow{{$i}}"
                                                                            >
                                                                                Simpan
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                    @endif
                                                                @else 
                                                                    <i>Jadwal Ujian Tengah Semester Belum Diatur</i>
                                                                @endif
                                                                    
                                                                </td>
                                                            </tr> 
                                                            @endif
                                                            @php
                                                                $i++;
                                                            @endphp
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                </div>                                
                            </div>
                            <div class="col-5 col-sm-3">
                                <div class="nav flex-column nav-tabs nav-tabs-right h-100" id="vert-tabs-right-tab" role="tablist" aria-orientation="vertical">
                                    @foreach ($sublevel as $sl)
                                        <a class="nav-link @if ($loop->iteration == 1) active @endif" id="vert-tabs-right-{{$loop->iteration}}-tab" data-toggle="pill" href="#vert-tabs-right-{{$loop->iteration}}" role="tab" aria-controls="vert-tabs-right-{{$loop->iteration}}" aria-selected="
                                            @if ($loop->iteration == 1)
                                                true 
                                            @else 
                                                false 
                                            @endif">{{$sl->alias}} 
                                            <button class="btn float-right btn-sm btn-primary sub-class-edit" data-id="{{$sl->id}}" data-level="{{$level->id}}" data-toggle="modal" data-target="#editSub" data-alias="{{$sl->alias}} "><i class="far fa-list-alt"></i></button>
                                            @if (count($sublevel) > 1)
                                                <button class="btn float-right btn-sm btn-danger sub-class-delete" data-id="{{$level->id}}" delete-idsub="{{$sl->id}}"><i class="far fa-trash-alt"></i></button>
                                            @endif                                        
                                        </a>
                                    @endforeach                                    

                                    <button type="button" class="btn btn-outline-secondary tambah-kelas" data-toggle="modal" data-target="#tambahKelas" data-kelas="{{$level->kelas}}" data-jumlah="{{$level->jumlah}}" data-id="{{$level->id}}">
                                        + Tambah Kelas
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            
        </section>
        <!-- /.content -->
    <!-- /.content-wrapper -->

    {{-- Modal  --}}
    {{-- Modal Set Test Schedule Subject  --}}
    <!-- Modal -->
    <form action="" method="post" id="form-tanggal">
        @csrf
        @method('patch')
        <div class="modal fade" id="subjectScheduleModal" tabindex="-1" aria-labelledby="subjectScheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title subject-schedule-title-modal" id="subjectScheduleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="kategori" id="kategori">
                                    <option value="Tengah Semester">Tengah Semester</option>
                                    <option value="Akhir Semester">Akhir Semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Nama Sekolah">
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitSchedule">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Modal Jadwal Ujian Tema --}}

    <form action="/test-schedule/set-schedule-tema/semesterId={{Year::thisSemester()->id}}/levelId={{$level->id}}" method="post" id="form-tanggal-tema">
        @csrf
        <div class="modal fade" id="temaScheduleModal" tabindex="-1" aria-labelledby="temaScheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title subject-schedule-title-modal" id="temaScheduleModalLabel">Tambah Jadwal Ujian Tema</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="kategori" class="col-sm-2 col-form-label">Tema</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="tema" id="tema">
                                    <option value="Tema 1">Tema 1</option>
                                    <option value="Tema 2">Tema 2</option>
                                    <option value="Tema 3">Tema 3</option>
                                    <option value="Tema 4">Tema 4</option>
                                    <option value="Tema 5">Tema 5</option>
                                    <option value="Tema 6">Tema 6</option>
                                    <option value="Tema 7">Tema 7</option>
                                    <option value="Tema 8">Tema 8</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="mid-semester-checkbox" name="midsemestercheckbox">
                                    <label class="custom-control-label" for="mid-semester-checkbox">Tengah Semester</label>
                                  </div>
                                <div class="form-group row">
                                    <label for="tanggal-tema-mid" class="col-sm-2 col-form-label" >Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal-tema-mid" name="tanggaltemamid" placeholder="Nama Sekolah">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 ml-auto">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="last-semester-checkbox" name="lastsemestercheckbox">
                                    <label class="custom-control-label" for="last-semester-checkbox">Akhir Semester</label>
                                  </div>
                                <div class="form-group row">
                                    <label for="tanggal-tema-last" class="col-sm-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="tanggal-tema-last" name="tanggaltemalast" placeholder="Nama Sekolah">
                                    </div>
                                </div>
                            </div>
                          </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitSchedule-tema">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="" method="post" id="form-tanggal-theme">
        @csrf
        @method('patch')
        <div class="modal fade" id="themeScheduleModal" tabindex="-1" aria-labelledby="themeScheduleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title subject-schedule-title-modal" id="themeScheduleModalLabel"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="temainput" class="col-sm-2 col-form-label">Tema</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="temainput" name="temainput" placeholder="Nama Sekolah">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kategoritema" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="custom-select" name="kategoritema" id="kategoritema">
                                    <option value="Tengah Semester">Tengah Semester</option>
                                    <option value="Akhir Semester">Akhir Semester</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggaltema" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggaltema" name="tanggaltema" placeholder="Nama Sekolah">
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="submitThemeSchedule">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
@endsection

@section('script')
<script type="text/javascript">

    function ujianSemester(tanggal, mapel,idmapel, kategori){

        const headerSubjectScheduleModal = document.getElementById('subjectScheduleModalLabel');
        const inputTanggal = document.getElementById('tanggal');
        const form = document.getElementById('form-tanggal');
        const inputKategori = document.getElementById('kategori');

        const submitSchedule = document.getElementById('submitSchedule');

        console.log(tanggal);

        form.setAttribute('action',`/test-schedule/set-schedule/${idmapel}`)
        headerSubjectScheduleModal.innerHTML = `Atur Jadwal Ujian ${kategori}`;
        inputTanggal.value = tanggal;
        inputKategori.value = kategori;

        if (tanggal + 1 != 1) {
            submitSchedule.disabled = false;
        }

        inputTanggal.addEventListener('change', function(){
            submitSchedule.disabled = false;
        })

    }

    function izinUjian(i, kategori, student, time){
        const label = document.getElementById(`${kategori}-label-switch${i}`);
        const idCheckInput = document.getElementById(`${kategori}-customSwitch${i}`);
        const submitAllow = document.getElementById(`${kategori}-submit-allow${i}`);
        const form =document.getElementById(`${kategori}-form-permit${i}`)

        console.log(submitAllow);

        if (idCheckInput.checked == true) {
            idCheckInput.value = 'off'
            label.innerHTML = `<span class="text-danger">Belum Dizinkan</span>`
        } else {
            idCheckInput.value = 'on'
            label.innerHTML = 'Diizinkan'
        }

        dataChange = label.getAttribute('data-change');
        if (dataChange == '0') {
            label.setAttribute('data-change',`1`)
            submitAllow.style.display = "block"
            form.setAttribute('action',`/test-schedule/${time}/set-student-schedule/${student}`)

        } else {
            label.setAttribute('data-change',`0`)
            submitAllow.style.display = "none"
            form.setAttribute('action',``)
        }
    }

    function themeSchedule(kategori, tema, tanggalUjian, semester, level){

        const form = document.getElementById('form-tanggal-theme');
        const temaInput = document.getElementById('temainput');
        const kategoriInput = document.getElementById('kategoritema');
        const tanggalTema = document.getElementById('tanggaltema');

        const headerModal = document.getElementById('themeScheduleModalLabel');

        form.setAttribute('action',`/test-schedule/set-schedule-tema/update/semesterId=${semester}/levelId=${level}`)
        headerModal.innerHTML = `Atur Jadwal Ujian Tema ${kategori}`;
        temaInput.value = tema;
        kategoriInput .value = kategori;
        tanggalTema .value = tanggalUjian;


    }

    window.addEventListener('load', async function(){
        $('#sub-level').DataTable();
        const submitSchedule = document.getElementById('submitSchedule');
        submitSchedule.disabled = true;

        const submitAllow= document.getElementsByClassName('submit-allow');        

        for (let index = 0; index < submitAllow.length; index++) {
            submitAllow[index].style.display = "none"
        }

        const tanggalMidTema = document.getElementById('tanggal-tema-mid');
        tanggalMidTema.disabled = true;

        const tanggallastTema = document.getElementById('tanggal-tema-last');
        tanggallastTema.disabled = true;

        const midCheckBoxModal = document.getElementById('mid-semester-checkbox');
        const lastCheckBoxModal = document.getElementById('last-semester-checkbox');

        midCheckBoxModal.value = 0;
        lastCheckBoxModal.value = 0;

        midCheckBoxModal.addEventListener('click', () => {

            if (midCheckBoxModal.value == 0) {
                midCheckBoxModal.value = 1;
                tanggalMidTema.disabled = false;
            } else {
                midCheckBoxModal.value = 0;
                tanggalMidTema.disabled = true;
            }
        })

        lastCheckBoxModal.addEventListener('click', () => {
            if (lastCheckBoxModal.value == 0) {
                lastCheckBoxModal.value = 1;
                tanggallastTema.disabled = false;
            } else {
                lastCheckBoxModal.value = 0;
                tanggallastTema.disabled = true;
            }
        })

    })
    
</script>
    
@endsection
