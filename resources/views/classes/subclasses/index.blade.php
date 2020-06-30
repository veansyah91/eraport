@extends('layouts.main')

@section('content')

        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary card-outline">                    
                    <div class="card-body">                      
                        <h2 ><strong>Kelas {{$level->kelas}}</strong></h2>
                        <hr>
                        <h4><strong>Sosial</strong></h4>
                        <div class="row">
                            <div class="col-sm">
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambahSocialModal">
                                    Tambah Aspek Sosial
                                </button>                  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                @if ($socialperiods->isNotEmpty())
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            @foreach ($socialperiods as $socialperiod)
                                                    <tr>
                                                        <td>{{$socialperiod->aspek}}</td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm social-delete" delete-id="{{$socialperiod->id}}" data-level="{{$level->id}}"><i class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>    
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h4><strong>Spiritual</strong></h4>
                        <div class="row">
                            <div class="col-sm">
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#tambahSpiritualModal">
                                    Tambah Aspek Spiritual
                                </button>                  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                @if ($spiritualperiods->isNotEmpty())
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            @foreach ($spiritualperiods as $spiritualperiod)
                                                    <tr>
                                                        <td>{{$spiritualperiod->aspek}}</td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm spiritual-delete" delete-id="{{$spiritualperiod->id}}" data-level="{{$level->id}}"><i class="far fa-trash-alt"></i></a>
                                                        </td>
                                                    </tr>    
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <h4><strong>Mata Pelajaran</strong></h4>

                        <div class="row">
                            <div class="col-sm">
                                <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#inputMapelModal">
                                    Tambah Mata Pelajaran
                                </button>                  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm">
                                <h5><strong>Pelajaran Wajib</strong></h5>
                                @if ($levelsubject->isNotEmpty())
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            <tr>
                                                <td colspan="4">Pendidikan Agama Islam</td>
                                            </tr>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($levelsubject as $ls)
                                                @if ($ls->kategori == 'Pelajaran Wajib' && $ls->sub_of == 'on')
                                                    <tr>
                                                        <td >{{$i++}}.</td>
                                                        <td>{{$ls->mata_pelajaran}}</td>
                                                        <td>
                                                            <strong>KKM : </strong>
                                                            @if (!$ls->kkm)
                                                                <i>Data Belum Diatur</i> <button class="btn btn-sm btn-success kkm" data-toggle="modal" data-target="#ubahKKMModal" data-id="{{$ls->id}}" data-kkm="{{$ls->kkm}}">Atur KKM</button>
                                                            @else
                                                                {{$ls->kkm}} <button class="btn btn-sm btn-link kkm" data-toggle="modal" data-target="#ubahKKMModal" data-id="{{$ls->id}}" data-kkm="{{$ls->kkm}}"><i class="fas fa-edit"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm subject-delete" delete-id="{{$ls->id}}" data-level="{{$level->id}}"><i class="far fa-trash-alt"></i></button>
                                                            <a href="/levelsubject/{{$ls->id}}/" class="btn btn-info btn-sm" data-level="{{$level->id}}">Atur KD</a>
                                                        </td>
                                                    </tr>                                   
                                                @endif
                                            @endforeach     
                                            
                                            @foreach ($levelsubject as $ls)
                                                @if ($ls->kategori == 'Pelajaran Wajib' && $ls->sub_of == '')
                                                    <tr>
                                                        <td colspan="2">{{$ls->mata_pelajaran}}</td>
                                                        <td>
                                                            <strong>KKM : </strong>
                                                            @if (!$ls->kkm)
                                                                <i>Data Belum Diatur</i> <button class="btn btn-sm btn-success kkm" data-toggle="modal" data-target="#ubahKKMModal" data-id="{{$ls->id}}" data-kkm="{{$ls->kkm}}">Atur KKM</button>
                                                            @else
                                                                {{$ls->kkm}} <button class="btn btn-sm btn-link kkm" data-toggle="modal" data-target="#ubahKKMModal" data-id="{{$ls->id}}" data-kkm="{{$ls->kkm}}"><i class="fas fa-edit"></i></button>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm subject-delete" delete-id="{{$ls->id}}" data-level="{{$level->id}}"><i class="far fa-trash-alt"></i></button>
                                                            <a href="/levelsubject/{{$ls->id}}/" class="btn btn-info btn-sm" data-level="{{$level->id}}">Atur KD</a>
                                                        </td>
                                                    </tr>                                   
                                                @endif
                                            @endforeach   
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="col-sm">
                                <h5><strong>Muatan Lokal</strong></h5>
                                @if ($levelsubject->isNotEmpty())
                                    <table class="table table-hover table-responsive">
                                        <tbody>
                                            
                                            @foreach ($levelsubject as $ls)
                                                @if ($ls->kategori == 'Muatan Lokal')
                                                    <tr>
                                                        <td>{{$ls->mata_pelajaran}}</td>
                                                        <td>
                                                            <strong>KKM : </strong>
                                                            @if (!$ls->kkm)
                                                                <i>Data Belum Diatur</i> <button class="btn btn-sm btn-success kkm" data-toggle="modal" data-target="#ubahKKMModal" data-id="{{$ls->id}}" data-kkm="{{$ls->kkm}}">Atur KKM</button>
                                                            @else
                                                                {{$ls->kkm}} <button class="btn btn-sm btn-link kkm" data-toggle="modal" data-target="#ubahKKMModal" data-id="{{$ls->id}}" data-kkm="{{$ls->kkm}}"><i class="fas fa-edit"></i></button>
                                                            @endif
                                                            
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-danger btn-sm subject-delete" delete-id="{{$ls->id}}" data-level="{{$level->id}}"><i class="far fa-trash-alt"></i></button>
                                                            <a href="/levelsubject/{{$ls->id}}/" class="btn btn-info btn-sm" data-level="{{$level->id}}">Atur KD</a>
                                                        </td>
                                                    </tr>                                   
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <h4><strong>Siswa</strong></h4>
                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table table-striped"  id="level-student">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nama Siswa</th>
                                            <th>Kelas</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $adasubkelas = false;
                                        @endphp
                                        @foreach ($levelstudents as $levelstudent)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$levelstudent->nama}}</td>
                                            <td>
                                                @if (!subKelasSiswa($levelstudent->id))
                                                    <i>Kelas Belum Diatur</i>
                                                    @php
                                                        $adasubkelas = false;
                                                    @endphp
                                                @else
                                                    {{subKelasSiswa($levelstudent->id)->alias}}
                                                    @php
                                                        $adasubkelas = true;
                                                    @endphp
                                                @endif
                                            </td>
                                            <td>
                                                
                                                    @if ($adasubkelas == false)
                                                        <button class="btn btn-sm btn-primary tambah-sub-kelas" data-toggle="modal" data-target="#tambahSubKelasModal" data-id="{{$levelstudent->id}}" data-nama="{{$levelstudent->nama}}" data-level="{{$level->id}}">
                                                            <i class="far fa-list-alt"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-sm btn-success ubah-sub-kelas" data-toggle="modal" data-target="#ubahSubKelasModal" data-levelstudent="{{$levelstudent->id}}" data-nama="{{$levelstudent->nama}}" data-level="{{$level->id}}" data-subkelas="{{subKelasSiswa($levelstudent->id)->sub_level_id}}" data-id="{{subKelasSiswa($levelstudent->id)->id}}">
                                                            <i class="far fa-list-alt"></i>
                                                        </button>
                                                        <a href="/student/{{$levelstudent->student_id}}" class="btn btn-sm btn-info">Detail</a>
                                                    @endif
                                                
                                                
                                            </td>
                                        </tr> 
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

                <div class="card card-primary card-outline">                    
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
                                            <h3><strong>Wali Kelas {{$level->kelas}} {{$sl->alias}}</strong></h3>
                                            @php
                                                $adawalikelas = false;
                                            @endphp
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    @if ($walikelas->isNotEmpty())
                                                        @foreach ($walikelas as $wk)
                                                            @if ($wk->sub_level_id == $sl->id)
                                                                <table class="table table-borderless">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="h5">{{$wk->nama}}</td>
                                                                            <td>
                                                                                <button class="btn btn-sm btn-primary edit-walikelas" data-toggle="modal" data-target="#editWaliKelasModal" data-staffid="{{$wk->staff_id}}"
                                                                                data-id="{{$wk->id}}" data-sublevel="{{$sl->id}}" data-year="{{$semester->year_id}}">
                                                                                    <i class="far fa-list-alt"></i>
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                @php
                                                                    $adawalikelas = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach                              
                                                    @endif
        
                                                    @if ($adawalikelas == false)
                                                        <p><i>Walikelas Belum Diatur</i></p>
                                                        <button type="button" class="btn btn-primary btn-sm tambah-walikelas" data-sublevel="{{$sl->id}}" data-year="{{$semester->year_id}}" data-toggle="modal" data-target="#inputWaliKelasModal">
                                                            Atur Walikelas
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>

                                            <hr>

                                            <h3><strong>Mata Pelajaran</strong></h3>
                                            <div class="row mt-3">
                                                <div class="col-sm">
                                                    <h5><strong>Pelajaran Wajib</strong></h5>
                                                    @if ($levelsubject->isNotEmpty())
                                                            <table class="table table-hover table-responsive">
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            Pendidikan Agama Islam
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                        $i = 1;
                                                                    @endphp
                                                                    @foreach ($levelsubject as $ls)
                                                                        @if ($ls->kategori == 'Pelajaran Wajib' && $ls->sub_of == 'on')
                                                                            <tr>
                                                                                <td>{{$i++}}</td>
                                                                                <td>{{$ls->mata_pelajaran}}</td>
                                                                                @if (levelsubjectteacher($ls->id,$sl->id)->isNotEmpty())
                                                                                    <td>{{levelsubjectteacher($ls->id,$sl->id)[0]->nama}}</td>
                                                                                    <td>
                                                                                        <button 
                                                                                            class="btn btn-primary btn-sm level-subject-teacher-edit" 
                                                                                            data-id="{{levelsubjectteacher($ls->id,$sl->id)[0]->id}}" 
                                                                                            data-level="{{$level->id}}"
                                                                                            data-staffid="{{levelsubjectteacher($ls->id,$sl->id)[0]->staff_id}}"
                                                                                            data-toggle="modal" data-target="#editWaliKelasModal">
                                                                                                <i class="far fa-list-alt"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                @else
                                                                                <td><i>Guru Pengajar Belum Ditambahkan</i></td>
                                                                                <td>
                                                                                    <button 
                                                                                        class="btn btn-primary btn-sm level-subject-teacher-add"
                                                                                        data-id="{{$ls->id}}"
                                                                                        data-sublevel="{{$sl->id}}"
                                                                                        data-toggle="modal" data-target="#addSubjectTeacherModal">
                                                                                            <i class="far fa-list-alt"></i>
                                                                                    </button>
                                                                                </td>
                                                                                @endif
                                                                            </tr>                                   
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach ($levelsubject as $ls)
                                                                        @if ($ls->kategori == 'Pelajaran Wajib' && $ls->sub_of == '')
                                                                            <tr>
                                                                                <td colspan="2">{{$ls->mata_pelajaran}}</td>
                                                                                @if (levelsubjectteacher($ls->id,$sl->id)->isNotEmpty())
                                                                                    <td>{{levelsubjectteacher($ls->id,$sl->id)[0]->nama}}</td>
                                                                                    <td>
                                                                                        <button 
                                                                                            class="btn btn-primary btn-sm level-subject-teacher-edit" 
                                                                                            data-id="{{levelsubjectteacher($ls->id,$sl->id)[0]->id}}" 
                                                                                            data-level="{{$level->id}}"
                                                                                            data-staffid="{{levelsubjectteacher($ls->id,$sl->id)[0]->staff_id}}"
                                                                                            data-toggle="modal" data-target="#editWaliKelasModal">
                                                                                                <i class="far fa-list-alt"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                @else
                                                                                <td><i>Guru Pengajar Belum Ditambahkan</i></td>
                                                                                <td>
                                                                                    <button 
                                                                                        class="btn btn-primary btn-sm level-subject-teacher-add"
                                                                                        data-id="{{$ls->id}}"
                                                                                        data-sublevel="{{$sl->id}}"
                                                                                        data-toggle="modal" data-target="#addSubjectTeacherModal">
                                                                                            <i class="far fa-list-alt"></i>
                                                                                    </button>
                                                                                </td>
                                                                                @endif
                                                                            </tr>                                   
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                </div>
                                                
                                                <div class="col-sm">
                                                    <h5><strong>Muatan Lokal</strong></h5>
                                                    
                                                        @if ($levelsubject->isNotEmpty())
                                                            <table class="table table-hover table-responsive">
                                                                <tbody>
                                                                    
                                                                    @foreach ($levelsubject as $ls)
                                                                        @if ($ls->kategori == 'Muatan Lokal')
                                                                            <tr>
                                                                                <td>{{$ls->mata_pelajaran}}</td>
                                                                                @if (levelsubjectteacher($ls->id,$sl->id)->isNotEmpty())
                                                                                    <td>{{levelsubjectteacher($ls->id,$sl->id)[0]->nama}}</td>
                                                                                    <td>
                                                                                        <button 
                                                                                            class="btn btn-primary btn-sm level-subject-teacher-edit" 
                                                                                            data-id="{{levelsubjectteacher($ls->id,$sl->id)[0]->id}}" 
                                                                                            data-level="{{$level->id}}"
                                                                                            data-staffid="{{levelsubjectteacher($ls->id,$sl->id)[0]->staff_id}}"
                                                                                            data-toggle="modal" data-target="#editWaliKelasModal">
                                                                                                <i class="far fa-list-alt"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                @else
                                                                                    <td><i>Guru Pengajar Belum Ditambahkan</i></td>
                                                                                    <td>
                                                                                        <button 
                                                                                            class="btn btn-primary btn-sm level-subject-teacher-add"
                                                                                            data-id="{{$ls->id}}"
                                                                                            data-sublevel="{{$sl->id}}"
                                                                                            data-toggle="modal" data-target="#addSubjectTeacherModal">
                                                                                                <i class="far fa-list-alt"></i>
                                                                                        </button>
                                                                                    </td>
                                                                                @endif
                                                                                
                                                                            </tr>                                   
                                                                        @endif
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                            
                                                </div>
                                            </div>

                                            <hr>

                                            <h3><strong>Siswa</strong></h3>
                                            <div class="col-sm-8">
                                                <table class="table table-striped"  id="sub-level-student">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Nama Siswa</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 1;
                                                        @endphp
                                                        @foreach ($sublevelstudents as $sublevelstudent)
                                                            @if ($sublevelstudent->sub_level_id == $sl->id)
                                                            <tr>
                                                                <td>{{$i++}}</td>
                                                                <td>{{$sublevelstudent->nama}}</td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-success ubah-sub-kelas" data-toggle="modal" data-target="#ubahSubKelasModal" data-levelstudent="{{$sublevelstudent->level_student_id}}" data-nama="{{$sublevelstudent->nama}}" data-level="{{$level->id}}" data-subkelas="{{$sublevelstudent->sub_level_id}}" data-id="{{$sublevelstudent->id}}">
                                                                        <i class="far fa-list-alt"></i>
                                                                    </button>
                                                            </tr> 
                                                            @endif
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

                {{-- Modal Ubah KKM --}}
                <div class="kkm-modal">
                    <form action="" method="POST">
                        @csrf
                        @method('patch')
                        <div class="modal fade" id="ubahKKMModal" tabindex="-1" role="dialog" aria-labelledby="ubahKKMModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="ubahKKMModalLabel">Ubah KKM</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control kkm-value" value="" name="kkm">
                                        </div>
                                    </div>
    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Modal Tambah Wali Kelas --}}
                <div class="modal-walikelas">
                    <form action="" method="POST">
                        @csrf
                        <div class="modal fade" id="inputWaliKelasModal" tabindex="-1" role="dialog" aria-labelledby="inputWaliKelasModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="inputWaliKelasModalLabel">Atur Walikelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group">
                                        <label for="guru" class="col-sm-12 col-form-label">Nama Guru</label>
                                        <div class="col-sm-12 guru-input">
                                            <select class="custom-select guru-select" id="guruselect" name="guruselect">
                                                @foreach ($guru as $g)
                                                    <option value="{{$g->staff_id}}">{{$g->nama}}</option>
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

                {{-- Modal tambah pengajar--}}
                <div class="modal-tambah-pengajar">
                    <form action="" method="POST">
                        @csrf
                        <div class="modal fade" id="addSubjectTeacherModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectTeacherModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="addSubjectTeacherModalLabel">Tambah Guru Pengajar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group">
                                        <label for="guru" class="col-sm-12 col-form-label">Nama Guru</label>
                                        <div class="col-sm-12 guru-add">
                                            <select class="custom-select guruselect-add" id="guruselect-add" name="guruselect">
                                                @foreach ($guru as $g)
                                                    <option value="{{$g->staff_id}}">{{$g->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Modal Edit Wali Kelas / pengajar--}}
                <div class="modal-edit-walikelas-pengajar">
                    <form action="" method="POST">
                        @csrf
                        @method('patch')
                        <div class="modal fade" id="editWaliKelasModal" tabindex="-1" role="dialog" aria-labelledby="editWaliKelasModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editWaliKelasModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body ">
                                    <div class="form-group">
                                        <label for="guru" class="col-sm-12 col-form-label">Nama Guru</label>
                                        <div class="col-sm-12 guru-edit">
                                            <select class="custom-select guruselect-edit" id="guruselect-edit" name="guruselect">
                                                @foreach ($guru as $g)
                                                    <option value="{{$g->staff_id}}">{{$g->nama}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Tambah Subject-->
                <form action="/classes/{{$level->id}}/{{$semester->id}}/add-subject" method="POST">
                    @csrf
                    <div class="modal fade" id="inputMapelModal" tabindex="-1" role="dialog" aria-labelledby="inputMapelModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="inputMapelModalLabel">Tambah Mata Pelajaran</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm">
                                    <div class="form-group row">
                                            <!-- checkbox -->
                                            <div class="form-group col-sm-12">
                                                <label for="jumlah" class="col-form-label">Mata Pelajaran Wajib</label>
                                                <div class="form-check">
                                                    @php
                                                        $kosong_wajib = true
                                                    @endphp
                                                    @foreach ($unselectSubject as $subject)
                                                        @if ($subject->kategori == 'Pelajaran Wajib')
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="mapel[{{$loop->index}}]" value="{{$subject->id}}">
                                                                <label class="form-check-label">{{$subject->mata_pelajaran}}</label>
                                                            </div>
                                                            @php
                                                                $kosong_wajib = false;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    
                                                    @if ($kosong_wajib == true)
                                                        <p><i>Semua Mata Pelajaran Wajib Sudah Diinputkan</i></p>
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group row">
                                            <!-- checkbox -->
                                            <div class="form-group col-sm-12">
                                                <label for="jumlah" class="col-form-label">Muatan Lokal</label>
                                                <div class="form-check">
                                                    @php
                                                        $kosongmulok = true
                                                    @endphp
                                                    @foreach ($unselectSubject as $subject)
                                                        @if ($subject->kategori == 'Muatan Lokal')
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="mapel[{{$loop->index}}]" value="{{$subject->id}}">
                                                                <label class="form-check-label">{{$subject->mata_pelajaran}}</label>
                                                            </div>
                                                            @php
                                                                $kosongmulok = false;
                                                            @endphp
                                                        @endif
                                                    @endforeach

                                                    @if ($kosongmulok == true)
                                                        <p><i>Semua Mata Pelajaran Muatan Lokal Sudah Diinputkan</i></p>
                                                    @endif

                                                </div>
                                            </div>
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

                {{-- Modal tambah Kelas --}}
                <div class="tambah-kelas-modal">
                    <form action="" method="POST">
                        @csrf
                        @method('patch')
                        <div class="modal fade" id="tambahKelas" tabindex="-1" role="dialog" aria-labelledby="tambahKelasLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="tambahKelasLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="jumlah" class="col-sm-3 col-form-label">Jumlah Kelas</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah Kelas" value="1">
                                            @error('jumlah')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
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

                <!-- Modal Edit Alias Sub Menu-->
                <div class="modal-sub-class-edit">
                    <form action="" method="POST">
                        @csrf
                        @method('patch')
                        <div class="modal fade" id="editSub" tabindex="-1" role="dialog" aria-labelledby="editSubLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="editSubLabel">Edit Alias Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="alias" class="col-sm-3 col-form-label">Alias Kelas</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control alias" id="alias" name="alias" placeholder="Alias Kelas">
                                            @error('alias')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
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

                {{-- Modal Tambah Sub Kelas Siswa --}}
                <div class="modal-tambah-sub-kelas">
                    <form action="" method="POST">
                        @csrf
                        <input type="text" hidden class="levelstudent" name="levelstudent">
                        <div class="modal fade" id="tambahSubKelasModal" tabindex="-1" role="dialog" aria-labelledby="#tambahSubKelasModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="#tambahSubKelasModalLabel">Tambah Sub Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="alias" class="col-sm-3 col-form-label">Nama Siswa</label>
                                        <div class="col-sm-9">
                                            <input type="text " class="form-control tambah-nama-siswa" name="nama-siswa" value="" readonly>
                                            @error('alias')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alias" class="col-sm-3 col-form-label">Nama SubKelas</label>
                                        <div class="col-sm-9 guru-edit">
                                            <select class="custom-select sub-kelas-select" id="sub-kelas-select" name="subkelasselect">
                                                @foreach ($sublevel as $sl)
                                                    <option value="{{$sl->id}}">{{$sl->alias}}</option>
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

                {{-- Modal Edit Sub Kelas Siswa --}}
                <div class="modal-ubah-sub-kelas">
                    <form action="" method="POST">
                        @csrf
                        <div class="modal fade" id="ubahSubKelasModal" tabindex="-1" role="dialog" aria-labelledby="#ubahSubKelasModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="#ubahSubKelasModalLabel">Edit Sub Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="alias" class="col-sm-3 col-form-label">Nama Siswa</label>
                                        <div class="col-sm-9">
                                            <input type="text " class="form-control edit-nama-siswa" name="nama-siswa" value="" readonly>
                                            @error('alias')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alias" class="col-sm-3 col-form-label">Nama SubKelas</label>
                                        <div class="col-sm-9 guru-edit">
                                            <select class="custom-select sub-kelas-select" id="sub-kelas-select-edit" name="subkelasselect">
                                                {{-- <option value="">--Pilih Sub Kelas--</option> --}}
                                                @foreach ($sublevel as $sl)
                                                    <option value="{{$sl->id}}">{{$sl->alias}}</option>
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

                {{-- Modal Input Aspek Spiritual --}}
                <div class="modal-tambah-spiritual">
                    <form action="/classes/{{$level->id}}/{{$semester->id}}/add-spiritual" method="POST">
                        @csrf
                        <div class="modal fade" id="tambahSpiritualModal" tabindex="-1" role="dialog" aria-labelledby="#tambahSpiritualModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="#tambahSpiritualModalLabel">Tambah Aspek Spiritual</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm">
                                        <div class="form-group row">
                                                <!-- checkbox -->
                                                <div class="form-group col-sm-12">
                                                    <div class="form-check">
                                                        @php
                                                            $kosong = true
                                                        @endphp
                                                        @foreach ($unselectspirituals as $unselectspiritual)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="spiritual[{{$loop->index}}]" value="{{$unselectspiritual->id}}">
                                                                    <label class="form-check-label">{{$unselectspiritual->aspek}}</label>
                                                                </div>
                                                                @php
                                                                    $kosong = false;
                                                                @endphp
                                                        @endforeach
                                                        
                                                        @if ($kosong == true)
                                                            <p><i>Semua Aspek Spiritual Sudah Diinputkan</i></p>
                                                        @endif
                                                    </div>
                                                </div>
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

                {{-- Modal Input Aspek Spiritual --}}
                <div class="modal-tambah-social">
                    <form action="/classes/{{$level->id}}/{{$semester->id}}/add-social" method="POST">
                        @csrf
                        <div class="modal fade" id="tambahSocialModal" tabindex="-1" role="dialog" aria-labelledby="#tambahSocialModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="#tambahSocialModalLabel">Tambah Aspek Sosial</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-sm">
                                        <div class="form-group row">
                                                <!-- checkbox -->
                                                <div class="form-group col-sm-12">
                                                    <div class="form-check">
                                                        @php
                                                            $kosong = true
                                                        @endphp
                                                        @foreach ($unselectsocials as $unselectsocial)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="social[{{$loop->index}}]" value="{{$unselectsocial->id}}">
                                                                    <label class="form-check-label">{{$unselectsocial->aspek}}</label>
                                                                </div>
                                                                @php
                                                                    $kosong = false;
                                                                @endphp
                                                        @endforeach
                                                        
                                                        @if ($kosong == true)
                                                            <p><i>Semua Aspek Sosial Sudah Diinputkan</i></p>
                                                        @endif
                                                    </div>
                                                </div>
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
            </div>
            
        </section>
        <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection

@section('script')
<script type="text/javascript">
    $('.tambah-kelas').click(function(){
        let kelas= $(this).data('kelas');
        let id=$(this).data('id');
        $('.tambah-kelas-modal form').attr(`action`,`/classes/${id}/edit`);
        let judul = `<div>Kelas ${kelas}</div>`;
        $('.modal-title').html(judul);
    });

    $('.sub-class-delete').click(function(){
        let delete_id = $(this).attr('delete-idsub');
        let levelid = $(this).data('id');
        swal({
            title: "Apakah Anda Yakin Menghapus Kelas Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/classes/${levelid}/${delete_id}/delete`;                
            }
        })
    });

    $('.sub-class-edit').click(function(){
        let id=$(this).data('id');
        let level=$(this).data('level');    
        let alias=$(this).data('alias');
        $('.alias').val(alias);              
        $('.modal-sub-class-edit form').attr(`action`,`/classes/${level}/${id}/edit`);
    });

    $('.subject-delete').click(function(){
        let delete_id = $(this).attr('delete-id');
        let level=$(this).data('level'); 
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/classes/${level}/subject/${delete_id}/delete`;
            }
        })
    })

    $('.guru-select').select2({
        theme: "classic",
        width: '80%',        
    });
    

    $('.tambah-walikelas').click(function(){
        let subLevel = $(this).data('sublevel');
        let year = $(this).data('year'); 
        
        $('.modal-walikelas form').attr(`action`,`/classes/${subLevel}/${year}/add-walikelas`);
    })
    
    $('.edit-walikelas').click(function(){
        let subLevel = $(this).data('sublevel');
        let year = $(this).data('year');
        let staffid = $(this).data('staffid');
        let id = $(this).data('id');

        $('#editWaliKelasModalLabel').text("Atur Walikelas");
        $('#guruselect-edit').val(staffid);
        
        $('.modal-edit-walikelas-pengajar form').attr(`action`,`/classes/${subLevel}/${id}/edit-walikelas`);
    })

    $('.level-subject-teacher-edit').click(function(){
        let id = $(this).data('id');
        let staffid = $(this).data('staffid');
        let sublevel = $(this).data('level');

        $('#guruselect-edit').val(staffid);

        $('#editWaliKelasModalLabel').text("Atur Guru Mata Pelajaran");
        $('.modal-edit-walikelas-pengajar form').attr(`action`,`/classes/${sublevel}/${id}/edit-guru-mata-pelajaran`);
    })

    $('.level-subject-teacher-add').click(function(){
        let sublevel = $(this).data('sublevel');
        let id = $(this).data('id');        
        
        $('.modal-tambah-pengajar form').attr(`action`,`/classes/${sublevel}/${id}/tambah-guru-mata-pelajaran`);
    })

    $('#level-student').DataTable();
    $('#sub-level-student').DataTable({
        lengthMenu: [ 10, 25, 50, 75, 100 ],
        }
    );

    $('.tambah-sub-kelas').click(function(){
        let id = $(this).data('id');
        let nama= $(this).data('nama');
        let level= $(this).data('level');        
        $('.tambah-nama-siswa').val(nama);
        $('.levelstudent').val(id);
        $('.modal-tambah-sub-kelas form').attr(`action`,`/classes/${level}/add-subkelas-siswa`);
    })

    $('.ubah-sub-kelas').click(function(){
        let levelstudent = $(this).data('levelstudent');
        let nama= $(this).data('nama');
        let level= $(this).data('level');  
        let sublevel= $(this).data('subkelas');  
        let id= $(this).data('id');  
        
        
        $('.edit-nama-siswa').val(nama);
        $('#sub-kelas-select-edit').val(sublevel);
        
        $('.modal-ubah-sub-kelas form').attr(`action`,`/classes/${level}/${id}/edit-subkelas-siswa`);
        
    })

    $('.spiritual-delete').click(function(){
        let delete_id = $(this).attr('delete-id');
        let level=$(this).data('level'); 
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
            window.location = `/classes/${level}/spiritual/${delete_id}/delete`;
            }
        })
    })

    $('.social-delete').click(function(){
        let delete_id = $(this).attr('delete-id');
        let level=$(this).data('level');
        
        swal({
            title: "Apakah Anda Yakin Menghapus Data Ini?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                window.location = `/classes/${level}/social/${delete_id}/delete`;
            }
        })
    })

    $('.kkm').click(function(){
        let id = $(this).data('id');
        let kkm = $(this).data('kkm');

        $('.kkm-value').val(kkm);
        $('.kkm-modal form').attr(`action`,`/levelsubject/${id}/edit`);

        
    })


    
</script>
    
@endsection
