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

    <link rel = "icon" href ="{{asset('img/yabam.ico')}}" type = "image/x-icon"> 
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="#" class="navbar-brand">
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
                            </ul>
                        </li>
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
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.min.js')}}"></script>
    <script src=" {{asset('js/wilayah.js')}} "></script>
    @yield('script')
</body>

</html>
