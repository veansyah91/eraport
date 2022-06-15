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
            <div class="attitude">
                <div class="sub-title" style="margin-bottom: 5px">
                    <strong>A. Kompetensi Sikap</strong> 
                </div>
                <div class="main-table">
                    <table style="width: 100%;border: 1px solid black;border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 2em; text-align: center;border: 1px solid black;border-collapse: collapse;">No</th>
                                <th scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">Kompetensi Inti</th>
                                <th scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">Capaian Kompetensi</th>
                                <th scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col" style="width: 2em; text-align: center;border: 1px solid black;border-collapse: collapse;">1</td>
                                <td scope="col" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;">
                                    Sikap Spiritual (KI-1)</td>
                                <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$predikatspiritual->nilai_huruf}}</td>
                                <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$predikatspiritual->penjelasan}}</td>
                            </tr>
                            <tr>
                                <td scope="col" style="width: 2em; text-align: center;border: 1px solid black;border-collapse: collapse;">2</td>
                                <td scope="col" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;">Sikap Sosial (KI-2)</td>
                                <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$predikatsocial->nilai_huruf}}</td>
                                <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$predikatsocial->penjelasan}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="subject" style="margin-top: 20px">
                <div class="sub-title" style="margin-bottom: 5px">
                    <strong>B. Kompetensi Pengetahuan (KI-3) dan Keterampilan (KI-4)</strong> 
                </div>
                <div class="main-table">
                    <table style="width: 100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 2em; text-align: center;width: 5%;border: 1px solid black;border-collapse: collapse;" rowspan="2">No</th>
                                <th scope="col" style="text-align: center; width: 35%;border: 1px solid black;border-collapse: collapse;" rowspan="2">Mata Pelajaran</th>
                                <th scope="col" style="text-align: center; width: 12%;border: 1px solid black;border-collapse: collapse;" rowspan="2">KKM</th>
                                <th scope="col" style="text-align: center; width: 16%;border: 1px solid black;border-collapse: collapse;" colspan="2">Pengetahuan (KI-3)</th>
                                <th scope="col" style="text-align: center; width: 16%;border: 1px solid black;border-collapse: collapse;" colspan="2">Keterampilan (KI-4)</th>
                                <th scope="col" style="text-align: center; width: 16%;border: 1px solid black;border-collapse: collapse;" colspan="2">Rata-Rata Kelas</th>
                            </tr>
                            <tr>
                                <th scope="col" style="text-align: center; width: 8%;border: 1px solid black;border-collapse: collapse;" >Nilai</th>
                                <th scope="col" style="text-align: center; width: 8%;border: 1px solid black;border-collapse: collapse;" >Huruf</th>
                                <th scope="col" style="text-align: center; width: 8%;border: 1px solid black;border-collapse: collapse;" >Nilai</th>
                                <th scope="col" style="text-align: center; width: 8%;border: 1px solid black;border-collapse: collapse;" >Huruf</th>
                                <th scope="col" style="text-align: center; width: 8%;border: 1px solid black;border-collapse: collapse;" >KI-3</th>
                                <th scope="col" style="text-align: center; width: 8%;border: 1px solid black;border-collapse: collapse;" >KI-4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $PAI = 0;
                            @endphp
                            @foreach ($jumlahNilaiPengetahuanSiswa as $nilai)
                                @if ($nilai["kategori"] == "Pelajaran Wajib" && $nilai["sub_of"] == "on")
                                @php
                                    $PAI++;
                                @endphp
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="9" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;"><strong>Kelompok A (Mata Pelajaran Wajib)</strong></td>
                            </tr>
                            <tr>
                                <td style="text-align: center;vertical-align:top;border: 1px solid black;border-collapse: collapse;" rowspan="{{$PAI+1}}">1</td>
                                <td colspan="8" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;">Pendidikan Agama Islam</td>
                            </tr>
                            @php
                                $i = 1;
                                
                                $jumlahNilai = 0;
                                $jumlahNilaiRata2 = 0;
                                $jumlahData = 0;
                            @endphp
                            @foreach ($jumlahNilaiPengetahuanSiswa as $nilai)
                                @if ($nilai["kategori"] == "Pelajaran Wajib" && $nilai["sub_of"] == "on")
                                <tr>
                                    <td scope="col" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;">{{$i++}}. {{$nilai['mapel']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['kkm']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{$nilai['nilaipengetahuan']}}
                                        @php
                                            $jumlahNilai += $nilai['nilaipengetahuan'];
                                            $jumlahData++;
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['nilaihurufpengetahuan']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{$nilai['nilaiketerampilan']}}
                                        @php
                                            $jumlahNilai += $nilai['nilaiketerampilan'];
                                            $jumlahData++;
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['nilaihurufketerampilan']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{round(avKnowledgePerClass($nilai['id']))}}
                                        @php
                                            $jumlahNilaiRata2 += round(avKnowledgePerClass($nilai['id']));
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{round(Score::avgPracticePerClass($nilai['id']))}}
                                        @php
                                            $jumlahNilaiRata2 += round(Score::avgPracticePerClass($nilai['id']));
                                        @endphp
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            
                            @php
                                $i = 2;
                            @endphp
                            @foreach ($jumlahNilaiPengetahuanSiswa as $nilai)
                                @if ($nilai["kategori"] == "Pelajaran Wajib" && $nilai["sub_of"] == "")
                                <tr>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$i++}}</td>
                                    <td scope="col" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;">{{$nilai['mapel']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['kkm']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{$nilai['nilaipengetahuan']}}
                                        @php
                                            $jumlahNilai += $nilai['nilaipengetahuan'];
                                            $jumlahData++;
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['nilaihurufpengetahuan']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{$nilai['nilaiketerampilan']}}
                                        @php
                                            $jumlahNilai += $nilai['nilaiketerampilan'];
                                            $jumlahData++;
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['nilaihurufketerampilan']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{round(avKnowledgePerClass($nilai['id']))}}
                                        @php
                                            $jumlahNilaiRata2 += round(avKnowledgePerClass($nilai['id']));
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{round(Score::avgPracticePerClass($nilai['id']))}}
                                        @php
                                            $jumlahNilaiRata2 += round(Score::avgPracticePerClass($nilai['id']));
                                        @endphp
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            
                            <tr>
                                <td colspan="9" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;"><strong>Kelompok B (Muatan Lokal)</strong></td>
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($jumlahNilaiPengetahuanSiswa as $nilai)
                                @if ($nilai["kategori"] == "Muatan Lokal" && $nilai["sub_of"] == "")
                                <tr>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$i++}}</td>
                                    <td scope="col" style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;">{{$nilai['mapel']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['kkm']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{$nilai['nilaipengetahuan']}}
                                        @php
                                            $jumlahNilai += $nilai['nilaipengetahuan'];
                                            $jumlahData++;
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['nilaihurufpengetahuan']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{$nilai['nilaiketerampilan']}}
                                        @php
                                            $jumlahNilai += $nilai['nilaiketerampilan'];
                                            $jumlahData++;
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">{{$nilai['nilaihurufketerampilan']}}</td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{round(avKnowledgePerClass($nilai['id']))}}
                                        @php
                                            $jumlahNilaiRata2 += round(avKnowledgePerClass($nilai['id']));
                                        @endphp
                                    </td>
                                    <td scope="col" style="text-align: center;border: 1px solid black;border-collapse: collapse;">
                                        {{round(Score::avgPracticePerClass($nilai['id']))}}
                                        @php
                                            $jumlahNilaiRata2 += round(Score::avgPracticePerClass($nilai['id']));
                                        @endphp
                                    </td>
                                </tr>
                                @endif
                            @endforeach

                            <tr>
                                <td style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;" colspan="2">Jumlah Nilai</td> 
                                <td style="border: 1px solid black;border-collapse: collapse;"></td>
                                <td style="text-align: center;border: 1px solid black;border-collapse: collapse;" colspan="4">{{$jumlahNilai}}</td>
                                <td style="text-align: center;border: 1px solid black;border-collapse: collapse;" colspan="2">{{$jumlahNilaiRata2}}</td>
                            </tr>
                            <tr>
                                <td style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;" colspan="2">Nilai Rata-Rata</td> 
                                <td ></td>
                                <td style="text-align: center;border: 1px solid black;border-collapse: collapse;" colspan="4">{{round($jumlahNilai/$jumlahData,2)}}</td>
                                <td style="text-align: center;border: 1px solid black;border-collapse: collapse;" colspan="2">{{round($jumlahNilaiRata2/$jumlahData,2)}}</td>
                            </tr>
                            <tr>
                                <td style="padding-left: 5px;border: 1px solid black;border-collapse: collapse;" colspan="2">Rangking Ke:</td> 
                                <td style="text-align: center;border: 1px solid black;border-collapse: collapse;" colspan="7"><strong>{{$rank->rank}}</strong> dari <strong>{{$jumlahSiswa}}</strong> siswa</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($semester->semester == "GENAP")
                <div class="keputusan" style="margin-top: 20px">
                    <table style="width: 100%">
                        <tr>
                            <th style="width: 50%"></th>
                            <td style="width: 50%"><strong>Keputusan:</strong></td>
                        </tr>
                        <tr>
                            <th style="width: 50%"></th>
                            <td style="width: 50%">Berdasarkan pencapaian seluruh kompetensi,<td>
                        </tr>
                        <tr>
                            <th style="width: 50%"></th>
                            <td style="width: 50%">maka Peserta Didik dinyatakan:<td>
                        </tr>
                        <tr>
                            <th style="width: 50%"></th>
                            @if ($uplevel->status == 1)
                                @if ($sublevel->level->kelas == 6)
                                    <td style="width: 50%"><strong>Lulus</strong><td>
                                @else
                                    <td style="width: 50%"><strong>Naik Ke Kelas {{$sublevel->level->kelas + 1}}</strong><td>     
                                @endif
                            @else
                                <td style="width: 50%"><strong>Tinggal Kelas {{$sublevel->level->kelas}}</strong><td>
                            @endif
                        </tr>
                        <tr>
                            <th style="width: 50%"></th>
                            <td style="width: 50%;text-align: center;">{{$school->desa}}, {{Date("d")}} {{bulan(Date("m"))}} {{Date("Y")}}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%;text-align: center;">Orang Tua/ Wali</td>
                            <td style="width: 50%;text-align: center;">Guru Kelas</td>   
                        </tr>
                        <tr>
                            <td style="width: 50%;text-align: center;height:80px;vertical-align:bottom"><strong>{{$student->nama_ayah}}</strong></td>
                            <td style="width: 50%;text-align: center;height:80px;vertical-align:bottom"><strong><u>{{$teacher->nama}}<u></strong></td>
                        </tr>
                        <tr>
                            <th style="width: 50%"></th>
                            <th style="width: 50%">
                                @if ($teacher->nik)
                                    <strong>NIGY. {{$teacher->nik}}</strong>
                                @else
                                    <strong>NIGY. -</strong>
                                @endif
                            </th>
                        </tr>
                        
                        
                    </table>
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 100%;text-align: center;">Mengetahui</td>
                        </tr>
                        <tr>
                            <td style="width: 100%;text-align: center;">Kepala Sekolah</td>
                        </tr>
                        <tr>
                            <td style="width: 100%;text-align: center;height:80px;vertical-align:bottom"><strong><u>{{$kepalasekolah->nama}}<u></strong></td>
                        </tr>
                        <tr>
                            <td style="width: 100%;text-align: center;height:80px;vertical-align:top">
                                @if ($kepalasekolah->nik)
                                    <strong>NIGY. {{$kepalasekolah->nik}}</strong>
                                @else
                                    <strong>NIGY. -</strong>
                                @endif

                            </td>
                        </tr>
                    </table>
                </div>
            @endif
            
        </section>
    </body>
</html>