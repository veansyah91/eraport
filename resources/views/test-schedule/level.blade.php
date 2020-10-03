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
                                        @if ($levelsubject->sub_of == 'on' && $levelsubject->kategori == "Pelajaran Wajib")
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
                                                        onclick="ujianSemester({{TestSchedule::schedule($levelsubject->id, 'Akhir Semester')->tanggal}},'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
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
                                    @endphp
                                    @foreach ($levelsubjects as $levelsubject)
                                        @if ($levelsubject->sub_of != 'on' && $levelsubject->kategori == "Pelajaran Wajib")
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
                                                        onclick="ujianSemester({{TestSchedule::schedule($levelsubject->id, 'Akhir Semester')->tanggal}},'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
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
                                                        onclick="ujianSemester({{TestSchedule::schedule($levelsubject->id, 'Akhir Semester')->tanggal}},'{{$levelsubject->mata_pelajaran}}','{{$levelsubject->id}}','Akhir Semester')">
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
    
@endsection

@section('script')
<script type="text/javascript">

    function ujianSemester(tanggal, mapel,idmapel, kategori){

        const headerSubjectScheduleModal = document.getElementById('subjectScheduleModalLabel');
        const inputTanggal = document.getElementById('tanggal');
        const form = document.getElementById('form-tanggal');
        const inputKategori = document.getElementById('kategori');

        const submitSchedule = document.getElementById('submitSchedule');

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

    window.addEventListener('load', async function(){
        $('#sub-level').DataTable();
        const submitSchedule = document.getElementById('submitSchedule');

        submitSchedule.disabled = true;

        const submitAllow= document.getElementsByClassName('submit-allow');
        

        for (let index = 0; index < submitAllow.length; index++) {
            submitAllow[index].style.display = "none"
        }

    })
    
</script>
    
@endsection
