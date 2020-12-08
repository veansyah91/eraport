<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SDIT Abu Bakar</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">

  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-select/css/select.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  {{-- TOASTR --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <!-- add icon link -->
  <link rel = "icon" href ="{{asset('img/yabam.ico')}}" type = "image/x-icon"> 
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>

      <li>
        <li class="nav-item d-none d-sm-inline-block">
          <div class="nav-link">Semester <strong>{{semester()}}</strong> Tahun Ajaran <strong>{{year()}}/{{year()+1}}</strong></div>          
        </li>
      </li>
      
      
    </ul>

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-primary">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('/img/yabam.jpeg')}}" alt="toSchool Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
      <span class="brand-text font-weight-light">SDIT Abu Bakar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href=" {{url('/sekolah')}} " class="nav-link">
              <i class="nav-icon fas fa-school"></i>
              <p>
                Sekolah                
              </p>
            </a>
          </li>  
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Staff 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{url('/staff')}}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Detail Staff</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="{{ route('registry.staff') }}" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>Registrasi Akun</p>
                </a>
              </li>             
            </ul>
          </li>
          
          <li class="nav-item">
            <a href=" {{url('/positions')}} " class="nav-link">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Jabatan               
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                Siswa 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{url('/students')}}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>Detail Siswa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/registry-student')}}" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>Registrasi Akun</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Penilaian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{url('/socials')}}" class="nav-link">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Sikap Sosial</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/spirituals')}}" class="nav-link">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Sikap Spiritual</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/subjects')}}" class="nav-link">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Pengetahuan & Keterampilan</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/extracurriculars')}}" class="nav-link">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Ekstrakurikuler</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href=" {{url('/converts')}} " class="nav-link">
              <i class="nav-icon fas fa-exchange-alt"></i>
              <p>
                Konversi Nilai               
              </p>
            </a>
          </li>

          @if (kelas()->isEmpty())
          <li class="nav-item">
            <a href="{{url('/classes')}}" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>
                Kelas           
              </p>
            </a>
          </li>
          @else
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book-reader"></i>
              <p>
                Kelas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              @foreach (kelas() as $k)
                  <li class="nav-item">
                    <a href="{{url('/classes/'.$k->id)}}" class="nav-link">
                      <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                      <p>Kelas {{$k->kelas}}</p>
                    </a>
                  </li>                             
              @endforeach              
            </ul>
          </li>              
          @endif

          @if (kelas()->isNotEmpty())
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-pen"></i>
              <p>
                Ujian
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{url('/test-schedule')}}" class="nav-link">
                  <i class="fas fa-calendar-alt nav-icon"></i>
                  <p>Jadwal Ujian</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-newspaper nav-icon"></i>
                  <p>
                    Jadwal dan Perijian Ujian
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">

                  @foreach (kelas() as $k)
                  <li class="nav-item">
                    <a href="{{url('/test-schedule/'.$k->id)}}" class="nav-link">
                      <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                      <p>Kelas {{$k->kelas}}</p>
                    </a>
                  </li>                             
                  @endforeach    
                  
                </ul>
              </li>
            </ul>
          </li>            
          @endif  

          @if (kelas()->isNotEmpty())
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Raport
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-file-alt nav-icon"></i>
                  <p>
                    Isi Nilai
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">

                  @foreach (kelas() as $k)
                  <li class="nav-item">
                    <a href="{{url('/score/'.$k->id)}}" class="nav-link">
                      <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                      <p>Kelas {{$k->kelas}}</p>
                    </a>
                  </li>                             
                  @endforeach    
                  
                </ul>
              </li>
            </ul>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-newspaper nav-icon"></i>
                  <p>
                    Cetak Raport
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">

                  @foreach (kelas() as $k)
                  <li class="nav-item">
                    <a href="{{url('/report/'.$k->id)}}" class="nav-link">
                      <i class="fas fa-long-arrow-alt-right nav-icon"></i>
                      <p>Kelas {{$k->kelas}}</p>
                    </a>
                  </li>                             
                  @endforeach    
                  
                </ul>
              </li>
            </ul>
          </li>            
          @endif   

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-dollar-sign nav-icon"></i>
              <p>
                Pembayaran 
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: none;">
              <li class="nav-item">
                <a href="{{url('/psb')}}" class="nav-link">
                  <i class="fas fa-file-invoice-dollar nav-icon"></i>
                  <p>PSB</p>
                </a>
              </li>   
              <li class="nav-item">
                <a href="{{ url('/spp') }}" class="nav-link">
                  <i class="fas fa-file-invoice-dollar nav-icon"></i>
                  <p>SPP</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="{{ url('/buku') }}" class="nav-link">
                  <i class="fas fa-file-invoice-dollar nav-icon"></i>
                  <p>Buku</p>
                </a>
              </li>            
            </ul>
          </li>

          @hasrole('SUPER ADMIN')
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                  Otoritas
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="display: none;">
                <li class="nav-item">
                  <a href="{{url('/roles')}}" class="nav-link">
                    <i class="fas fa-project-diagram nav-icon"></i>
                    <p>Role</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/special-roles')}}" class="nav-link">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>Pengaturan Otorisasi Khusus</p>
                  </a>
                </li>
                
              </ul>
            </li>

          @else
            <li class="nav-item">
              <a href=" {{url('/')}} " class="nav-link">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  <strong class="text-primary">Halaman Profil  </strong>
                              
                </p>
              </a>
            </li>
          @endhasrole
          

          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Log Out</p>
            </a>
        </li>       
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>



  <div class="content-wrapper mt-5">
      {!!checkyear()!!}
      @if (checkyear()==null)
        @yield('content')
      @endif
  </div>

  


  
  <footer class="main-footer text-sm">
    <strong>Copyright &copy; {{date('Y')}} </strong>
    All rights reserved.
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{asset('plugins/toastr/toastr.min.js')}}"></script>

<script>
  @if(Session::has('status'))
    toastr.success("{{Session::get('status')}}", "Berhasil")
  @endif

  @if(Session::has('failed'))
    toastr.error("{{Session::get('failed')}}", "Gagal")
  @endif
</script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<!-- ChartJS -->
<script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<!-- daterangepicker -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
{{--  Vue.js --}}
<script src=" {{asset('js/app.js')}} "></script>

{{-- DataTables --}}
<script src=" {{asset('plugins/datatables/jquery.dataTables.js')}} "></script>

<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-select/js/select.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-select/js/dataTables.select.min.js')}}"></script>
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<script src=" {{asset('js/wilayah.js')}} "></script>
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

@yield('script')

</body>
</html>
