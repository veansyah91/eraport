<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            .page-break {
                page-break-after: always;
            }
            .logo{
                margin-top: 150px;
            }

            .text-center{
                text-align: center;
            }

            .text-right{
                text-align: right;
            }

            .border-solid{
                border: solid;
            }

            .center {
                margin: auto;
                width: 60%;
                padding: 10px;
            }

            .nama{
                margin-top: 50px;
            }

            .keterangan{
                margin-top: 50px;
            }

            .data-sekolah{
                margin-top: 100px;
                margin-left: 50px;
            }

            .data-sekolah td{
                width: 150px; height:50px;
            }

            .detail-alamat{
                margin-top: 50px;
                margin-left: 50px;
            }
            .detail-alamat td{
                width: 150px; height:50px;
            }

            .petunjuk-penggunaan, .biodata-siswa{
                margin-top: 25px;
                margin-left: 50px;
                margin-right: 50px;
            }

            .petunjuk-penggunaan li{
                margin-bottom: 10px;
                text-align: justify;
            }

            .biodata-siswa td{
                width: 170px; height:35px;
            }

            .footer{
                margin-top: 25px;
            }

            .gambar{
                border: 0.5px solid black;
                width: 3cm;
                height: 4cm;
                float: right;
            }



            

        </style>

    </head>
    <body>
    
        <div class="logo text-center">
            <img src="{{public_path('img/tut-wuri.jpg')}}" alt="Logo" height="200px">
        </div>

        <div class="keterangan text-center">
            <h3><strong>RAPOR</strong></h3>
            <h3><strong>PESERTA DIDIK</strong></h3>
            <h3><strong>SEKOLAH DASAR</strong></h3>
            <h3><strong>(SD)</strong></h3>
        </div>

        <div class="nama center text-center" style="width: 400px">
            <div>
                <h4>Nama Peserta Didik:</h4>
                <h3 class="border-solid" ><Strong>{{$student->nama}}</Strong></h3>
            </div>

            <div>
                <h4>No. Induk/NISN:</h4>
                <h3 class="border-solid" ><Strong>@if ($student->no_induk) {{$student->no_induk}} @else - @endif/@if ($student->nisn) {{$student->nisn}} @else - @endif</Strong></h3>
            </div>
        </div>

        <div class="keterangan text-center">
            <h2><Strong>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN</Strong></h2>
            <h2><Strong>REPUBLIK INDONESIA</Strong></h2>
        </div>

        <div class="page-break"></div>

        <div>
            <h3 class="text-center">LAPORAN</h3>
            <h3 class="text-center">HASIL PENCAPAIAN KOMPETENSI PESERTA DIDIK</h3>
            <h3 class="text-center">SEKOLAH DASAR</h3>
            <h3 class="text-center">(SD)</h3>
        </div>

        <div class="data-sekolah">
            <table>
                <tr>
                    <td >Nama Sekolah</td>
                    <td><strong>: {{ $school->nama_sekolah }}</strong></td>
                </tr>
                <tr>
                    <td >NSS / NPSN</td>  
                    <td><strong>: {{ $school->nss }} / {{ $school->npsn }}</strong></td>      
                </tr>  
                <tr>
                    <td >Alamat Sekolah</td>
                    <td><strong>: {{ $school->alamat }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="detail-alamat">
            <table>
                <tr>
                    <td >Kelurahan / Desa</td>
                    <td><strong>: {{ $school->desa }}</strong></td>
                </tr>
                <tr>
                    <td >Kecamatan</td>  
                    <td><strong>: {{ $school->kecamatan }}</strong></td>      
                </tr>  
                <tr>
                    <td >Kota / Kabupaten</td>
                    <td><strong>: {{ $school->kota }}</strong></td>
                </tr>
                <tr>
                    <td >Provinsi</td>
                    <td><strong>: {{ $school->provinsi }}</strong></td>
                </tr>
                <tr>
                    <td >Website</td>
                    <td><strong>: {{ $school->website }}</strong></td>
                </tr>
                <tr>
                    <td >Email</td>
                    <td><strong>: {{ $school->email }}</strong></td>
                </tr>
            </table>
        </div>

        <div class="page-break"></div>

        <div style="margin-top: 10px">
            <h3 class="text-center">
                PETUNJUK PENGGUNAAN
            </h3>
        </div>
        
        <div class="petunjuk-penggunaan">
            <ol>
                <li>Rapor Peserta Didik dipergunakan selama peserta didik yang bersangkutan mengikuti seluruh program pembelajaran di Sekolah Dasar Islam Terpadu (SDIT) Abu Bakar Air Molek,</li>
                <li>Identitas Sekolah diisi dengan data yang sesuai dengan keberadaan Sekolah Dasar,</li>
                <li>Daftar Peserta Didik diisi oleh data yang sesuai dengan keberadaan peserta didik,</li>
                <li>Identitas Peserta Didik diisi oleh data yang sesuai dengan keberadaan peserta didik,</li>
                <li>Rapor Peserta Didik harus dilengkapi dengan pas foto berwarna (3 x 4) dan pengisiannya dilakukan oleh Guru Kelas,</li>
                <li>Kompetensi Inti 1 (KI-1) untuk sikap Spiritual diambil dari KI-1 pada muatan pelajaran Pendidikan Agama dan Budi Pekerti serta PPKn,</li>
                <li>Kompetensi Inti 2(KI-2) untuk sikap Sosial diambil dari KI-2 pada muatan pelajaran Pendidikan Agama dan Budi Pekerti serta PPKn,</li>
                <li>Kompetensi Inti 3 dan 4 (KI-3 da KI-4) diambil dari KI-3 dan KI-4 pada semua mata pelajaran,</li>
                <li>Hasil Penilaian Pengetahuan dan Keterampilan dilaporkan dalam bentuk Nilai, Predikat dan Deskripsi pencapaian kompetensi Mata Pelajaran,</li>
                <li>Hasil Penilaian Sikap dilaporkan dalm bentuk Predikat dan/atau Deskripsi,</li>
                <li>Predikat yang ditulis dalam Rapor Peserta Didik:
                    <ol type="A">
                        @foreach ($converts as $convert)
                            <li>{{ $convert->penjelasan }}</li>
                        @endforeach
                        
                    </ol>
                </li>
                <li>Deskripsi Pengetahuan dan Keterampilan ditulis dengan kalimat positif sesuai dengan capaian KD tertinggi atau terendah dari masing-masing muatan pelajaran yang diperoleh Peserta Didik. Deskripsi berisi Pengetahuan dan Keterampilan yang sangat baik dan atau yang dikuasai dan penguasaanya belum optimal. Apabila nilai capaian KD muatan pelajaran yang diperoleh dari suatu muatan pelajaran yang sama, kolom deskripsi ditulis sesuai dengan capaian untuk semua KD,</li>
                <li>Laporan Ekstrakurikuler diisi dengan kegiatan ekstrakurikuler yang diikuti oleh Peserta Didik,</li>
                <li>Saran-saran diisi tentang hal-hal yang perlu mendapatkan perhatian Peserta Didik, Pendidik dan Orangtua/Wali,</li>
                <li>Kolom Ketidakhadiran ditulis dengan data akumulasi ketidakhadiran peserta didik karena sakit, izin atau tanpa keterangan selama satu semester,</li>
                <li>Apabila Peserta Didik pindah, maka dicatat di dalam kolom keterangan pindah,</li>
                <li>Kolom pernyataan kenaikan kelas diisi keterangan naik atau tinggal kelas.</li>

            </ol>
        </div>

        <div class="page-break"></div>

        <div style="margin-top: 10px">
            <h3 class="text-center">
                IDENTITAS PESERTA DIDIK
            </h3>
        </div>

        <div class="biodata-siswa">
            <table>
                <tr>
                    <td >Nama Peserta Didik</td>
                    <td><strong>: {{ $student->nama }}</strong></td>
                </tr>
                <tr>
                    <td >NIS / NISN</td>  
                    <td><strong>: @if ($student->nis) {{ $student->nis }} @else - @endif / @if ($student->nisn) {{ $student->nisn }} @else - @endif</strong></td>      
                </tr>  
                <tr>
                    <td >Tempat / Tanggal Lahir</td>
                    @php
                        $date = date_create($student->tgl_lahir);
                    @endphp
                    <td><strong>: {{ $student->tempat_lahir }} / {{ date_format($date, "d M Y") }}</strong></td>
                </tr>
                <tr>
                    <td >Jenis Kelamin</td>
                    <td><strong>: {{ $student->jenis_kelamin }}</strong></td>
                </tr>
                <tr>
                    <td >Agama</td>
                    <td><strong>: {{ $student->agama }}</strong></td>
                </tr>
                <tr>
                    <td >Sekolah Sebelumnya</td>
                    <td><strong>: {{ $student->sekolah_sebelumnya }}</strong></td>
                </tr>
                <tr>
                    <td >Alamat Peserta Didik</td>
                    <td><strong>: {{ $student->alamat }}</strong></td>
                </tr>
                <tr><td></td></tr>
                <tr>
                    <td colspan="2"><strong>Identitas Orang Tua / Wali</strong></td>
                </tr>
                <tr>
                    <td>Nama Ayah</td>
                    <td><strong>: {{ $student->nama_ayah }}</strong></td>
                </tr>
                <tr>
                    <td>Nama Ibu</td>
                    <td><strong>: {{ $student->nama_ibu }}</strong></td>
                </tr>
                <tr>
                    <td>Pekerjaan Ayah</td>
                    <td><strong>: {{ $student->pekerjaan_ayah }}</strong></td>
                </tr>
                <tr>
                    <td>Pekerjaan Ibu</td>
                    <td><strong>: {{ $student->pekerjaan_ibu }}</strong></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><strong>: {{ $student->alamat }}</strong></td>
                </tr>
                <tr>
                    <td>Wali</td>
                    <td><strong>: @if ($student->wali) {{ $student->wali }} @else - @endif</strong></td>
                </tr>
            </table>
            
        </div>
        <div class="footer">
            <table style="width: 100%">
                <tr >
                    <td rowspan="3" class="text-right" style="height: 4.5cm; width:450px;">
                        <div class="gambar" >
                            @if ($student->image)
                                <img src="{{public_path('img/student/'.$student->image)}}" alt="foto-{{$student->nama}}" height="100%">                        
                            @endif
                            
                        </div>
                        
                    </td>
                    <td class="text-center" style="vertical-align: top">
                        {{$school->desa}}, {{Date("d")}} {{bulan(Date("m"))}} {{Date("Y")}}
                    </td>
                </tr>
                <tr>
                    <td class="text-center" style="vertical-align: bottom">
                        {{$teacher->nama}}
                        
                    </td>
                </tr>
                <tr>
                    <td class="text-center" style="vertical-align: top; height:10px">
                        @if ($teacher->nik)
                        NIK. {{$teacher->nik}}
                        @else
                        NIK. -
                        @endif
                                                
                    </td>
                </tr>
            </table>
            
        </div>

        
    </body>
</html>