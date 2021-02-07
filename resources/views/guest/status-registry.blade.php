<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SDIT Abu Bakar</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/status.css') }}" rel="stylesheet">

</head>
<body>

    <div class="container">

      <div class="row mt-2">
        <div class="col-8">
          <a href="{{ route('guest-index') }}" class="btn btn-success">
            Halaman Utama
          </a>
        </div>
      </div>

      @if (!$student)
        <div class="row justify-content-center mt-2">
            <div class="col-8 text-center status">
                <h2 class="font-weight-bold">
                    Mohon Maaf Anak Belum Terdaftar
                </h2>  
                <a href="{{ route('guest-registry') }}" class="mx-auto my-auto tombol-daftar btn btn-primary btn-lg">
                    <strong>Daftar Sekolah</strong>
                    
                </a>
            </div>
        </div>
      @else
        @if (!$student->status)
            <div class="row justify-content-center mt-2">
                <div class="col-8 text-center status diterima">
                    <h2>
                        Ananda <span class="font-weight-bold">{{ $student->nama }}</span>  
                    </h2>
                    <h1>
                        diterima dan terdaftar
                    </h1>  
                    <h3>
                        di SDIT ABU BAKAR AIR MOLEK
                    </h3>
                </div>
            </div>  

            <div class="row justify-content-center syarat mt-4">
                <div class="col-8 text-center" >
                    <div>
                        diharapkan memenuhi administrasi keuangan 70% dari <strong>uang psb</strong> , yaitu sebesar 
                    </div>
                    <div class="nominal">
                        <strong>Rp. 2.800.000,-</strong>                        
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-8 text-center">
                    <h5 class="font-weight-bold">
                        <img src="{{ asset('img/bni-syariah.svg') }}" alt="logo-bni-syariah" style="width: 40px">
                        Rekening BNI Syariah 0902594294 (Azriyat)
                    </h5>  
                </div>
            </div>
            <div class="row justify-content-center mt-5">
                <div class="col-8 text-center">
                    <h5 class="font-weight-bold">
                        Kirim Bukti Pembayaran Melalui WA (0852 1796 2916 - Ustad Azriyat)
                    </h5>  
                    <p class="my-4">
                        <strong>Format:</strong>  Nama Calon Siswa/i#Nama Ayah/Ibu#Pembayaran PSB
                    </p>
                    <p class="font-weight-bold">
                        Contoh:
                    </p>
                    <p>
                        <i>
                            Abdullah#Muhammad/Aminah#Pembayaran PSB
                        </i>
                    </p>
                    <h5 class="mb-5">
                        atau Klik 
                        <a class="btn btn-sm btn-success" href="https://wa.wizard.id/54f63e" target="_blank" >Konfirmasi</a>
                    </h5>
                    
                </div>
            </div>
        @else
            <div class="row justify-content-center mt-2 ">
                <div class="col-8 text-center status waiting">
                    <h1 class="font-weight-bold ">
                        Menunggu
                    </h1>  
                    <h4 class="mt-3">
                        Konfirmasi Penerimaan Siswa Baru 
                    </h4>  
                    <div class="row justify-content-center mt-4">
                        <div class="col-1 text-left">
                            Nama
                        </div>
                        <div class="col-4 text-left font-weight-bold">
                            : {{ $student->nama }}
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-1 text-left">
                            NIK
                        </div>
                        <div class="col-4 text-left font-weight-bold">
                            : {{ $student->nik }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-2">
                <div class="col-8 text-center">
                    <h5 class="">
                        Silakan Melakukan Pembayaran Biaya Pendaftaran Sebesar <span class="biaya">Rp.100.000,- </span> 
                    </h5>  
                </div>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-8">
                    <h5 class="font-weight-bold">
                        <img src="{{ asset('img/bni-syariah.svg') }}" alt="logo-bni-syariah" style="width: 40px">
                        Rekening BNI Syariah 0902594294 (Azriyat)
                    </h5>  
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-8">
                    <h5 class="font-weight-bold">
                        Kirim Bukti Pembayaran Melalui WA (0852 1796 2916 - Ustad Azriyat)
                    </h5>  
                    <p class="my-4">
                        <strong>Format:</strong>  Nama Calon Siswa/i#Nama Ayah/Ibu#Pembayaran Pendaftaran
                    </p>
                    <p class="font-weight-bold">
                        Contoh:
                    </p>
                    <p>
                        <i>
                            Abdullah#Muhammad/Aminah#Pembayaran Pendaftaran
                        </i>
                    </p>
                    <h5 class="mb-5">
                        atau Klik 
                        <a class="btn btn-sm btn-success" href="https://wa.wizard.id/160645" target="_blank" >Konfirmasi</a>
                    </h5>
                    
                </div>
            </div>
        @endif
      @endif

      

         

    </div>

    <script src="{{asset('plugins/jquery/jquery.min.js')}} "></script>

    <script src="{{asset('js/wilayah.js')}} "></script>

    <script type="text/javascript">
        window.addEventListener('load', async function(){
           
        })
    </script>
     
</body>
</html>