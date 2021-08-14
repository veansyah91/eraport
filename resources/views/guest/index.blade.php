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
    <link rel="stylesheet" href="{{ asset('css/guest.css') }}">

</head>
<body>
    <nav>
        <div class="row justify-content-between">
            <div class="col-8">
                <a class="h2 font-weight-bold nav-link" href="{{ url('/home') }}">
                    SDIT Abu Bakar
                </a>
            </div>

            @guest
                <div class="col-4 text-right ">
                    <a class="btn btn-primary tombol" href="{{ route('login') }}">Login</a>
                </div>
            @else
                <div class="col-4 text-right ">
                    <a class="btn btn-primary tombol" href="/profile">Profil</a>
                </div>
            @endguest

        </div>
    </nav>

    {{-- jumbotron --}}

    <div class="jumbotron" style="background: url({{ asset('img/jumbotron.png') }})">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-2">
                    <div class="logo">
                        <img src="{{ asset('img/sdit.png') }}" alt="Logo" class="float-left">
                    </div>
                </div>

                <div class="col-lg-10">
                    <div class="detail-sekolah">
                        <h2>
                            Yayasan abu bakar air molek
                        </h2>
                        <h1>
                            Sdit abu bakar air molek
                        </h1>
                        <h5>
                            Jl. Bupati Tulus, Gg. Abu Bakar RT.006/RW.004 Sumber Sari
                        </h5>
                        <h5>
                            Desa Air Molek, Kec. Pasir Penyu, Kab. INHU - RIAU
                        </h5>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- akhir jumbotron --}}

    {{-- visi dan misi --}}

    <div class="container about-school">
        <div class="row">
            <div class="col-lg-6 visi-misi">
                <div class="row">
                    <div class="col-lg-4 image">
                        <img src="{{ asset('img/book.png') }}" alt="target" class="float-left">
                    </div>

                    <div class="col-lg-8 detail">
                        <h3>Visi dan misi</h3>
                        <p>menjadi yang terdepan dalam pelayanan pendidikan yang bersumber dari al qur'an dan sunnah atas pemahaman salafus shalih bertaqwa, cerdas dan berakhlak mulia</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 keunggulan">
                <div class="row justify-content-center">
                    <div class="col-lg-4 image">
                        <img src="{{ asset('img/quran.png') }}" alt="quran" class="float-left">
                    </div>
                    <div class="col-lg-8 detail">
                        <h3 class="my-auto">program unggulan</h3>
                        <ul class="my-auto">
                            <li>tahsin al qur'an</li>
                            <li>tahfizh 2 juz</li>
                            <li>hadits arbain</li>
                            <li>bahasa arab</li>
                            <li>doa harian sesuai sunnah</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- akhir visi dan misi --}}

    {{-- Info Pembukaan Pendaftaran --}}
    <div class="info-pendaftaran mb-3">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center keterangan">
                        <h3 class="font-weight-bold"> Penerimaan </h3>
                        <h4> Siswa-Siswi Baru </h4>
                        <h5> Dan Pindahan Kelas 2,3,4 & 5 </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 my-3 my-auto">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        @if ($gelombang1 && $gelombang2)
                            @if ($gelombang1->mulai < Date('Y-m-d') && $gelombang1->akhir > Date('Y-m-d') || $gelombang2->mulai < Date('Y-m-d') && $gelombang2->akhir > Date('Y-m-d'))
                                <a href="{{ route('guest-registry') }}" class="mx-auto my-auto tombol-daftar">
                                    Daftar Sekolah
                                </a>
                            @else
                                <h3 class="text-danger">
                                    <strong>Pendaftaran Siswa Baru Tahun {{ Date('Y') }} Belum Dibuka</strong>
                                </h3>
                            @endif
                        @else
                            <h3 class="text-danger">
                                <strong>Pendaftaran Siswa Baru Tahun {{ Date('Y') }} Belum Dibuka</strong>
                            </h3>
                        @endif


                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    {{-- tambahkan class "sekarang" jika memasuki peiode --}}
                    <div class="col-lg-12 text-center
                        @if($gelombang1)
                            @if($gelombang1->mulai < Date('Y-m-d') && $gelombang1->akhir > Date('Y-m-d')) sekarang @endif
                        @endif
                    ">
                        @if($gelombang1)
                            Gelombang I : {{ explode("-",$gelombang1->mulai)[2] }} {{ bulan(explode("-",$gelombang1->mulai)[1]) }} {{ explode("-",$gelombang1->mulai)[0] }}
                            /
                            {{ explode("-",$gelombang1->akhir)[2] }} {{ bulan(explode("-",$gelombang1->akhir)[1]) }} {{ explode("-",$gelombang1->akhir)[0] }}
                        @else
                            Gelombang I : Belum Diatur
                        @endif

                    </div>
                    <div class="col-lg-12 text-center
                        @if ($gelombang2)
                            @if($gelombang2->mulai < Date('Y-m-d') && $gelombang2->akhir > Date('Y-m-d')) sekarang @endif
                        @endif
                    ">
                        @if($gelombang2)
                            Gelombang II : {{ explode("-",$gelombang2->mulai)[2] }} {{ bulan(explode("-",$gelombang2->mulai)[1]) }} {{ explode("-",$gelombang2->mulai)[0] }}
                            /
                            {{ explode("-",$gelombang2->akhir)[2] }} {{ bulan(explode("-",$gelombang2->akhir)[1]) }} {{ explode("-",$gelombang2->akhir)[0] }}
                        @else
                            Gelombang II : Belum Diatur
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Akhir Info Pembukaan Pendaftaran --}}

    {{-- cek status pendaftaran --}}

    <div class="row justify-content-center">
        <div class="col-sm-6 d-flex justify-content-center">
            <form action="{{ route('status-registry') }}" method="post" class="form-inline">
                @csrf
                <div class="form-group mx-sm-3 mb-2">
                    <label for="inputnik" class="sr-only">NIK</label>
                    <input type="text" class="form-control" id="inputnik" placeholder="Masukkan NIK Anak" name="nik">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Cek</button>
            </form>
        </div>
    </div>

    {{-- akhir cek status pendaftaran --}}

    {{-- Detail Biaya --}}
    <div class="container">
        <div class="detail-biaya">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <table class="table table-borderless tabel-rincian">
                        <tbody>
                            <tr>
                                <td class='keterangan'>
                                    Uang Pangkal
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    Rp
                                </td>
                                <td class="text-right">
                                    2.700.000
                                </td>
                            </tr>
                            <tr>
                                <td class='keterangan'>
                                    Seragam
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    Rp
                                </td>
                                <td class="text-right">
                                    1.700.000
                                </td>
                            </tr>
                            <tr>
                                <td class='keterangan'>
                                    SPP
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    Rp
                                </td>
                                <td class="text-right">
                                    300.000
                                </td>
                            </tr>
                            <tr id="footer">
                                <td class='keterangan'>
                                    Total
                                </td>
                                <td>
                                    :
                                </td>
                                <td>
                                    Rp
                                </td>
                                <td class="text-right">
                                    4.000.000
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Akhir Detail Biaya --}}




    <footer class="d-flex align-items-center">
        <div class="container">
            <div class="row info justify-content-between">
                <div class="col-lg-4">
                    <table>
                        <tr>
                            <td>CP :</td>
                            <td>Ustadz Azriyat</td>
                            <td>(0852 1796 2916)</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Ustadz Qodirul</td>
                            <td>
                                (0853 6562 0617)
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4 tentang-sekolah">
                    <h5>Yayasan Abu Bakar Air Molek</h5>
                    <h5><strong>SDIT ABU BAKAR AIR MOLEK</strong> </h5>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 text-center">
                    Designed by Abu Bakar's IT Team
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
