<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>SDIT Abu Bakar</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    {{-- datatable --}}
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-select/css/select.bootstrap4.min.css')}}">

    <link rel = "icon" href ="{{asset('img/yabam.ico')}}" type = "image/x-icon"> 

    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="/" class="navbar-brand">
                    <img src="{{asset('/img/yabam.jpeg')}}" alt="toSchool Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">SDIT Abu Bakar</span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        @if (Auth::user()->staff_id || Auth::user()->student_id)
                            <li class="nav-item">
                                <a href="/" class="nav-link">Profil</a>
                            </li>
                        @endif

                        @if (Auth::user()->student_id)
                            <li class="nav-item dropdown">
                                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="nav-link dropdown-toggle">Pembayaran</a>
                                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                    <li><a href="{{ url('/psb-siswa') }}" class="dropdown-item">PSB </a></li>

                                    <!-- Level two dropdown-->
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">SPP</a>
                                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                            <li>
                                                @foreach (levelStudent(Auth::user()->student_id) as $levelstudent)
                                                    <a href="{{ url('/' . $levelstudent->year_id .'/spp-siswa') }}" class="dropdown-item">{{ $levelstudent->year->awal }}/{{ $levelstudent->year->akhir }}</a>
                                                    
                                                @endforeach
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- End Level two -->

                                    <!-- Level two dropdown-->
                                    <li class="dropdown-submenu dropdown-hover">
                                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Buku</a>
                                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                            <li>
                                                @foreach (levelStudent(Auth::user()->student_id) as $levelstudent)
                                                    <a href="{{ url('/' . $levelstudent->year_id .'/pembayaran-buku-siswa') }}" class="dropdown-item">{{ $levelstudent->year->awal }}/{{ $levelstudent->year->akhir }}</a>
                                                    
                                                @endforeach
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- End Level two -->
                                </ul>
                            </li>

                            @if (Student::test(Date('Y-m-d')))
                                <li class="nav-item">
                                    <a href="/ujian/testScheduleId={{ Student::test(Date('Y-m-d'))->id }}" class="nav-link">
                                        <strong class="text-primary">Ujian {{ Student::test(Date('Y-m-d'))->kategori }}</strong>
                                    </a>
                                </li>
                            @endif
                        @endif

                        @if (Auth::user()->staff_id)
                            @if (Teacher::checkTeacher())
                            
                                <li class="nav-item dropdown">
                                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="nav-link dropdown-toggle">Penilaian</a>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                        @foreach (Teacher::getLevel() as $kelas)
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">
                                                Kelas {{ $kelas->kelas }}
                                            </a>
                                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                                @if (count(Level::subLevel($kelas->kelas)) > 1)
                                                    @foreach (Level::subLevel($kelas->kelas) as $subKelas)
                                                        <!-- Level three dropdown-->
                                                        <li class="dropdown-submenu">
                                                            <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">{{ $subKelas->alias }}</a>
                                                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">

                                                                @if (Teacher::getHomeRoom())
                                                                    @if (Teacher::getHomeRoom()->sub_level_id == $subKelas->id)    
                                                                        <li>
                                                                            <a href="/subLevelId={{ Teacher::getHomeRoom()->sub_level_id }}/penilaian/spiritual" class="dropdown-item">
                                                                                Nilai Spiritual (KI-1)
                                                                            </a>
                                                                        </li>
                                                                        <hr>
                                                                    @endif
                                                                @endif
                                                                
                                                                @foreach (Teacher::getSubjects($subKelas->id) as $subject)
                                                                    <li>
                                                                        <a href="/penilaian/{{ $subject->sub_level_id }}/{{ $subject->level_subject_id }}" class="dropdown-item">
                                                                            {{ $subject->mata_pelajaran}} 
                                                                        </a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </li>
                                                    @endforeach
                                                @else
                                                    @if (Teacher::getHomeRoom())
                                                        @if (Teacher::getHomeRoom()->sub_level_id == Level::subLevel($kelas->kelas)[0]->id)
                                                            <li>
                                                                <a 
                                                                href="/subLevelId={{ Teacher::getHomeRoom()->sub_level_id }}/penilaian/spiritual" 
                                                                
                                                                class="dropdown-item">
                                                                    Nilai Spiritual (KI-1)
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a 
                                                                    href="/subLevelId={{ Teacher::getHomeRoom()->sub_level_id }}/penilaian/sosial" 
                                                                    class="dropdown-item">
                                                                    Nilai Sosial (KI-2)
                                                                </a>
                                                            </li>
                                                            <hr>
                                                            <li>
                                                                <a 
                                                                    href="/subLevelId={{ Teacher::getHomeRoom()->sub_level_id }}/ekstrakurikuler" 
                                                                    class="dropdown-item">
                                                                    Extrakurikuler
                                                                </a>
                                                            </li>
                                                            <hr>
                                                            <li>
                                                                <a 
                                                                    href="/subLevelId={{ Teacher::getHomeRoom()->sub_level_id }}/saran" 
                                                                    class="dropdown-item">
                                                                    Saran
                                                                </a>
                                                            </li>
                                                            <hr>
                                                            <li>
                                                                <a 
                                                                    href="/subLevelId={{ Teacher::getHomeRoom()->sub_level_id }}/ketidakhadiran" 
                                                                    class="dropdown-item">
                                                                    Ketidakhadiran
                                                                </a>
                                                            </li>
                                                            <hr>
                                                        @endif
                                                    @endif
                                                    
                                                    @foreach (Teacher::getSubjects(Level::subLevel($kelas->kelas)[0]->id) as $subject)
                                                        <li>
                                                            <a href="/penilaian/{{ $subject->sub_level_id }}/{{ $subject->level_subject_id }}" class="dropdown-item">
                                                                {{ $subject->mata_pelajaran}} 
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="nav-link dropdown-toggle">Ujian</a>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                        @foreach (Teacher::getLevel() as $kelas)
                                        <li class="dropdown-submenu dropdown-hover">
                                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">
                                                Kelas {{ $kelas->kelas }}
                                            </a>
                                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                                @foreach (Teacher::getSubject($kelas->id) as $subject)
                                                    @if (!$subject->tema)
                                                        <li>
                                                            <a href="/ujian/levelsubjectid={{ $subject->level_subject_id }}" class="dropdown-item">
                                                                {{ $subject->mata_pelajaran }} 
                                                            </a>
                                                        </li>
                                                        <hr>
                                                    @endif
                                                @endforeach
                                                
                                                @if (Teacher::getHomeRoom() && Teacher::getHomeRoom()->level_id == $kelas->id)
                                                    
                                                    <li>
                                                        <a href="/ujian/tema/levelid={{ $kelas->id }}" class="dropdown-item">
                                                            <strong>Tema</strong> 
                                                        </a>
                                                    </li>
                                                @endif
                                                
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>

                                
                                @if (Teacher::getHomeRoom())
                                    <li class="nav-item dropdown">
                                        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Cetak Raport Kelas {{ Teacher::getHomeRoom()->kelas }}{{ Teacher::getHomeRoom()->alias }}</a>
                                        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                            <li><a href="/cetak-rapor/tengah-semester/{{ Teacher::getHomeRoom()->sub_level_id }}/{{ Year::thisSemester()->id }}" class="dropdown-item">Tengah Semester</a></li>
                                            <li><a href="/cetak-rapor/akhir-semester/{{ Teacher::getHomeRoom()->sub_level_id }}" class="dropdown-item">Akhir Semester</a></li>
                                        </ul>
                                    </li>
                                @endif
                                
                                
                            @endif
                        @endif
                                                
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
                        @hasanyrole('ADMIN|SUPER ADMIN')
                            <li class="nav-item">
                                <a href="/sekolah" class="nav-link text-primary"><strong>Halaman Admin</strong></a>
                            </li>
                        @endrole
                        
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if (Auth::user()->staff_id)
                                    {{ Auth::user()->staff->nama }} <span class="caret"></span>
                                @elseif (Auth::user()->student_id)
                                    {{ Auth::user()->student->nama }} <span class="caret"></span>
                                @endif
                            </a>
                            
                            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                <li>
                                    <a href="/change-password" class="dropdown-item">Ubah Password</a>
                                </li>
                                <hr>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        
                    </li>
                
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer text-sm">
            <strong>Copyright &copy; {{date('Y')}} </strong>
            All rights reserved.
            
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    {{-- <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script> --}}
    <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <script src="{{asset('js/wilayah.js')}} "></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}} "></script>
    
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-select/js/select.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    
    @yield('script')
</body>

</html>
