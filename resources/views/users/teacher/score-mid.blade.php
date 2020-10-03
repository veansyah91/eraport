<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            .main-table table, .main-table th, .main-table td{
                border: solid black 0.5px;
                border-collapse: collapse; 
            }
        </style>

    </head>
    <body>

        <div class="title">
            <h3 style="text-align: center"><strong>RAPOR TENGAH SEMESTER</strong></h3>
        </div>

        <div class="header">
            <table style="width: 100%;font-size: 14px">
                <tr>
                    <td style="40%">
                        Nama Sekolah
                    </td>
                    <td  style="40%">
                        : {{$school->nama_sekolah}}
                    </td>
                    <td  style="10%">
                        Kelas
                    </td>
                    <td  style="10%">
                        : {{$sublevel->level->kelas}} {{$sublevel->alias}}
                    </td>
                </tr>

                <tr>
                    <td style="40%">
                        Alamat
                    </td>
                    <td  style="40%">
                        : {{$school->alamat}}
                    </td>
                    <td  style="10%">
                        Semester
                    </td>
                    <td  style="10%">
                        : {{$semester->semester}}
                    </td>
                </tr>

                <tr>
                    <td style="40%">
                        Nama Peserta Didik
                    </td>
                    <td  style="40%">
                        : <strong>{{$student->nama}}</strong>
                    </td>
                    <td  style="10%">
                        Tahun Ajaran
                    </td>
                    <td  style="10%">
                        : {{$semester->year->awal}}/{{$semester->year->akhir}}
                    </td>
                </tr>

                <tr>
                    <td style="40%">
                        No Induk / NISN
                    </td>
                    <td  style="40%">
                        :
                        @if ($student->no_induk)
                            {{$student->no_induk}}
                        @else
                            -
                        @endif
                         / 
                         @if ($student->nisn)
                            {{$student->nisn}}
                        @else
                            -
                        @endif

                        
                    </td>
                    <td  style="10%">
                        
                    </td>
                    <td  style="10%">
                        
                    </td>
                </tr>
            </table>
        </div>

        <div class="title">
            <h4 style="text-align: center"><strong>CAPAIAN KOMPETENSI</strong></h4>
        </div>

        <section class="main" style="font-size: 12px">

            <div class="subject" style="margin-top: 10px">
                <div class="main-table">
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 2em; text-align: center;width: 5%" rowspan="2">No</th>
                                <th scope="col" style="text-align: center; width: 35%" rowspan="2">Mata Pelajaran</th>
                                <th scope="col" style="text-align: center; width: 12%" rowspan="2">KKM</th>
                                <th scope="col" style="text-align: center; width: 16%" colspan="2">Nilai</th>
                                <th scope="col" style="text-align: center; width: 16%" rowspan="2">Rata-Rata Kelas</th>
                            </tr>
                            <tr>
                                <th scope="col" style="text-align: center; width: 8%" >Capaian</th>
                                <th scope="col" style="text-align: center; width: 8%" >Huruf</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $PAI = 0;
                            @endphp
                            @foreach ($levelsubjects as $levelsubject)
                                @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of == "on")
                                @php
                                    $PAI++;
                                @endphp
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="6" style="padding-left: 5px"><strong>Kelompok A (Mata Pelajaran Wajib)</strong></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align:top;" rowspan="{{$PAI+1}}">1</td>
                                <td colspan="5" style="padding-left: 5px">Pendidikan Agama Islam</td>
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($levelsubjects as $levelsubject)
                                @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of == "on")
                                <tr>
                                    <td scope="col" style="padding-left: 5px">{{ $i = 1 }}. {{ $levelsubject->mata_pelajaran }}</td>
                                    <td scope="col" style="text-align: center">{{ $levelsubject->kkm }}</td>

                                    <td scope="col" style="text-align: center">
                                        @php
                                            $nilaiAngka = round(Score::scoreMid($levelsubject->id, $student->id));
                                        @endphp
                                        {{ $nilaiAngka }}
                                    </td>
                                    <td scope="col" style="text-align: center">{{ Score::nilaiHuruf($nilaiAngka) }}</td>
                            
                                    {{-- Rata-rata Kelas --}}
                                    <td scope="col" style="text-align: center">
                                        {{ round(Score::rataNilaiKelasPerMapelMid($students, $levelsubject->id)) }}
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            
                            @php
                                $i = 2;
                            @endphp

                            @foreach ($levelsubjects as $levelsubject)
                                @if ($levelsubject->kategori == "Pelajaran Wajib" && $levelsubject->sub_of == "")
                                <tr>
                                    <td scope="col" style="padding-left: 5px;text-align: center">{{ $i++ }}</td>
                                    <td scope="col" style="padding-left: 5px">{{ $levelsubject->mata_pelajaran }}</td>
                                    <td scope="col" style="text-align: center">{{ $levelsubject->kkm }}</td>
                                        
                                    <td scope="col" style="text-align: center">
                                        @php
                                            $nilaiAngka = Score::scoreMid($levelsubject->id, $student->id);
                                        @endphp
                                        {{ round($nilaiAngka) }}
                                    </td>
                                    <td scope="col" style="text-align: center">{{ Score::nilaiHuruf($nilaiAngka) }}</td>
                                    
                                    {{-- Rata-rata Kelas --}}
                                    <td scope="col" style="text-align: center">
                                        {{ round(Score::rataNilaiKelasPerMapelMid($students, $levelsubject->id)) }}
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            
                            <tr>
                                <td colspan="6" style="padding-left: 5px"><strong>Kelompok B (Muatan Lokal)</strong></td>
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($levelsubjects as $levelsubject)
                                @if ($levelsubject->kategori == "Muatan Lokal" && $levelsubject->sub_of == "")
                                <tr>
                                    <td scope="col" style="padding-left: 5px;text-align: center">{{ $i++ }}</td>
                                    <td scope="col" style="padding-left: 5px">{{ $levelsubject->mata_pelajaran }}</td>
                                    <td scope="col" style="text-align: center">{{ $levelsubject->kkm }}</td>

                                    <td scope="col" style="text-align: center">
                                        @php
                                            $nilaiAngka = Score::scoreMid($levelsubject->id, $student->id);
                                        @endphp
                                        {{ round($nilaiAngka) }}
                                    </td>
                                    <td scope="col" style="text-align: center">{{ Score::nilaiHuruf($nilaiAngka) }}</td>
                                    
                                    {{-- Rata-rata Kelas --}}
                                    <td scope="col" style="text-align: center">
                                        {{ round(Score::rataNilaiKelasPerMapelMid($students, $levelsubject->id)) }}
                                    </td>
                                </tr>
                                @endif
                            @endforeach

                            <tr>
                                <td style="padding-left: 5px" colspan="2">Nilai Rata-Rata</td> 
                                <td></td>
                                <td style="text-align: center" colspan="2">{{ round(Score::rataMasingScoreMid($student->id, $semester->id)) }} </td>
                                <td style="text-align: center">{{ round(Score::rataNilaiMidKelas($students, $semester->id)) }}</td>
                            </tr>
                            <tr>
                                <td style="padding-left: 5px" colspan="2">Rangking Ke:</td> 
                                <td style="text-align: center" colspan="4"><strong>{{ Score::rank($student->id, $semester->id)->rank }}</strong> dari <strong>{{ count($students) }}</strong> siswa</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="footer" style="margin-top: 20px">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 50%;text-align: center;"></td>
                        <td style="width: 50%;text-align: center;">{{$school->desa}}, {{Date("d")}} {{bulan(Date("m"))}} {{Date("Y")}}</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;text-align: center;">Orang Tua / Wali</td>
                        <td style="width: 50%;text-align: center;">Guru Kelas</td>
                    </tr>
                    <tr>
                        <td style="width: 50%;text-align: center;height:80px;vertical-align:bottom"><strong><u>{{ $student->nama_ayah }}<u></strong></td>
                        <td style="width: 50%;text-align: center;height:80px;vertical-align:bottom"><strong><u>{{ Auth::user()->staff->nama }}<u></strong></td>
                    </tr>
                    <tr>
                        <td style="width: 50%;text-align: center;height:80px;vertical-align:top"></td>

                        <td style="width: 50%;text-align: center;height:80px;vertical-align:top">
                            @if (Auth::user()->staff->nik)
                                <strong>NIK. {{ Auth::user()->staff->nik }}</strong>
                            @else
                                <strong>NIK. -</strong>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            
            
        </section>
    </body>
</html>