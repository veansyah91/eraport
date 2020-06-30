<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            .main-table table, .main-table th, .main-table td{
                border: solid black 0.5px;
                border-collapse: collapse; m           
            }
        </style>

    </head>
    <body>
        <div class="title">
            <h3 style="text-align: center"><strong>RAPOR DAN PROFIL PESERTA DIDIK</strong></h3>
        </div>

        <div class="header">
            <table style="width: 100%;font-size: 14px">
                <tr>
                    <td style="40%">
                        Nama Peserta Didik
                    </td>
                    <td  style="40%">
                        : <strong>{{$student->nama}}</strong>
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
                        Semester
                    </td>
                    <td  style="10%">
                        : {{$semester->semester}}
                    </td>
                </tr>

                <tr>
                    <td style="40%">
                        Nama Sekolah
                    </td>
                    <td  style="40%">
                        : {{$school->nama_sekolah}}
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
                        Alamat
                    </td>
                    <td  style="40%">
                        : {{$school->alamat}}
                    </td>
                    
                    <td  style="10%">
                        
                    </td>
                    <td  style="10%">
                        
                    </td>
                </tr>
            </table>
        </div>

        <section class="main" style="margin-top: 20px">
            <div class="attitude">
                <div class="sub-title" style="margin-bottom: 5px">
                    <strong>A. Kompetensi Sikap</strong> 
                </div>
                <div class="main-table">
                    <table style="width: 100%;font-size: 12px">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 3%; text-align: center">No</th>
                                <th scope="col" style="width: 30%;text-align: center">Kompetensi Inti</th>
                                <th scope="col" style="width: 65%;text-align: center">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding:5px; text-align: center; vertical-align:top">1</td>
                                <td style="padding:5px; vertical-align:top">Sikap Spiritual (KI-1)</td>
                                <td style="padding:5px; text-align: justify;vertical-align:top">
                                    Ananda {{$student->nama}}
                                    {{ strtolower(description($student->id,$semester->id,1,$spiritual)) }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding:5px; text-align: center; vertical-align:top">2</td>
                                <td style="padding:5px; vertical-align:top">Sikap Sosial (KI-2)</td>
                                <td style="padding:5px; text-align: justify;vertical-align:top">
                                    Ananda {{$student->nama}}
                                    {{ strtolower(description($student->id,$semester->id,1,$social)) }}
                                </td>
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
                    <table style="width: 100%;font-size: 12px">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 2em; text-align: center;width: 3%" rowspan="2">No</th>
                                <th scope="col" style="text-align: center; width: 21%" rowspan="2">Mata Pelajaran</th>
                                <th scope="col" style="text-align: center; width: 38%" colspan="3">Pengetahuan (KI-3)</th>
                                <th scope="col" style="text-align: center; width: 38%" colspan="3">Keterampilan (KI-4)</th>
                            </tr>
                            <tr>
                                <td scope="col" style="text-align: center; width: 3%;" >Angka</td>
                                <td scope="col" style="text-align: center; width: 3%;" >Predikat</td>
                                <td scope="col" style="text-align: center; width: 50%;" >Deskripsi</td>

                                <td scope="col" style="text-align: center; width: 3%;" >Angka</td>
                                <td scope="col" style="text-align: center; width: 3%;" >Predikat</td>
                                <td scope="col" style="text-align: center; width: 50%;" >Deskripsi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $PAI = 1;
                            @endphp

                            @foreach ($levelSubjects as $nilai)
                                @if ($nilai->kategori == "Pelajaran Wajib" && $nilai->sub_of == "on")
                                    @php
                                        $PAI++;
                                    @endphp
                                @endif
                            @endforeach
                            <tr>
                                <td style="text-align: center; padding:5px; vertical-align:top" rowspan="{{$PAI}}">1</td>
                                <td style="padding:5px; vertical-align:top" colspan="7">Pendidikan Agama Islam (PAI)</td>
                            </tr>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($levelSubjects as $nilai)
                                @if ($nilai->kategori == "Pelajaran Wajib" && $nilai->sub_of == "on")
                                <tr>
                                    <td style="text-align: left; padding:5px; vertical-align:top">{{$i++}}. {{$nilai->mata_pelajaran}}</td>
                                    <td style="text-align: center; padding:5px; vertical-align:top">{{round(avKnowledge($student->id,$nilai->id))}}</td>
                                    <td style="text-align: center; padding:5px; vertical-align:top">{{konversiNilai(avKnowledge($student->id,$nilai->id),"nilai")->nilai_huruf}}</td>
                                    <td style="text-align: justify; padding:5px; vertical-align:top">Ananda {{$student->nama}} {{descCompetence($student->id,$nilai->id,$semester->id)}}</td>

                                    <td style="text-align: center; padding:5px; vertical-align:top">{{round(avPractice($student->id,$nilai->id))}}</td>
                                    <td style="text-align: center; padding:5px; vertical-align:top">{{konversiNilai(avPractice($student->id,$nilai->id),"nilai")->nilai_huruf}}</td>
                                    <td style="text-align: justify; padding:5px; vertical-align:top">Ananda {{$student->nama}} {{descPractice($student->id,$nilai->id,$semester->id)}}</td>
                                </tr>
                                @endif
                            @endforeach

                            @foreach ($levelSubjects as $nilai)
                                @if ($nilai->kategori == "Pelajaran Wajib" && $nilai->sub_of == "")
                                <tr>
                                    <td style="text-align: center; padding:5px; vertical-align:top">{{$i++}}</td>
                                    <td style="text-align: left; padding:5px; vertical-align:top">{{$nilai->mata_pelajaran}}</td>
                                    <td style="text-align: center; padding:5px; vertical-align:top">{{round(avKnowledge($student->id,$nilai->id))}}</td>
                                    <td style="text-align: center; padding:5px; vertical-align:top">{{konversiNilai(avKnowledge($student->id,$nilai->id),"nilai")->nilai_huruf}}</td>
                                    <td style="text-align: justify; padding:5px; vertical-align:top">Ananda {{$student->nama}} {{descCompetence($student->id,$nilai->id,$semester->id)}}</td>

                                    <td style="text-align: center; padding:5px; vertical-align:top">{{round(avPractice($student->id,$nilai->id))}}</td>
                                    <td style="text-align: center; padding:5px; vertical-align:top">{{konversiNilai(avPractice($student->id,$nilai->id),"nilai")->nilai_huruf}}</td>
                                    <td style="text-align: justify; padding:5px; vertical-align:top">Ananda {{$student->nama}} {{descPractice($student->id,$nilai->id,$semester->id)}}</td>
                                </tr>
                                @endif
                        @endforeach

                        @foreach ($levelSubjects as $nilai)
                            @if ($nilai->kategori == "Muatan Lokal")
                            <tr>
                                <td style="text-align: center; padding:5px; vertical-align:top">{{$i++}}</td>
                                <td style="text-align: left; padding:5px; vertical-align:top">{{$nilai->mata_pelajaran}}</td>
                                <td style="text-align: center; padding:5px; vertical-align:top">{{round(avKnowledge($student->id,$nilai->id))}}</td>
                                <td style="text-align: center; padding:5px; vertical-align:top">{{konversiNilai(avKnowledge($student->id,$nilai->id),"nilai")->nilai_huruf}}</td>
                                <td style="text-align: justify; padding:5px; vertical-align:top">Ananda {{$student->nama}} {{descCompetence($student->id,$nilai->id,$semester->id)}}</td>

                                <td style="text-align: center; padding:5px; vertical-align:top">{{round(avPractice($student->id,$nilai->id))}}</td>
                                <td style="text-align: center; padding:5px; vertical-align:top">{{konversiNilai(avPractice($student->id,$nilai->id),"nilai")->nilai_huruf}}</td>
                                <td style="text-align: justify; padding:5px; vertical-align:top">Ananda {{$student->nama}} {{descPractice($student->id,$nilai->id,$semester->id)}}</td>
                            </tr>
                            @endif
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="ekstrakurikuler" style="margin-top: 20px">
                <div class="sub-title" style="margin-bottom: 5px">
                    <strong>C. Ekstrakurikuler</strong> 
                </div>
                <div class="main-table">
                    <table style="width: 100%;font-size: 12px">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 3%; text-align: center">No</th>
                                <th scope="col" style="width: 30%;text-align: center">Kegiatan EKstrakurikuler</th>
                                <th scope="col" style="width: 65%;text-align: center">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ekstrakurikuler as $item)
                                <tr>
                                    <td style="padding:5px; text-align: center; vertical-align:top">{{$loop->iteration}}</td>
                                    <td style="padding:5px; vertical-align:top">{{$item->nama}}</td>
                                    <td style="padding:5px; text-align: center;vertical-align:top">
                                        {{$item->nilai_huruf}}
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="saran" style="margin-top: 20px">
                <div class="sub-title" style="margin-bottom: 5px">
                    <strong>D. Saran</strong> 
                </div>
                <div class="main-table">
                    <table style="width: 100%;font-size: 12px">
                        <tbody>
                                <tr>
                                    <td style="padding:5px; text-align: justify; vertical-align:top">Ananda {{$student->nama}} {{$advice->saran}}</td>
                                </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="prestasi" style="margin-top: 20px">
                <div class="sub-title" style="margin-bottom: 5px">
                    <strong>E. Prestasi</strong> 
                </div>
                <div class="main-table">
                    <table style="width: 100%;font-size: 12px">
                        <thead>
                            <tr style="font-size: 12px; text-align:center">
                                <th style="width:5%">No</th>
                                <th style="width:40%">Jenis Prestasi</th>
                                <th style="width:55%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td style="text-align:center">1</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center">2</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="text-align:center">3</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="close" style="margin-top: 20px">
                <div class="sub-title" style="margin-bottom: 5px">
                    <strong>F. Ketidakhadiran</strong> 
                </div>

                <div>
                    <div class="ketidakhadiran" style="float: left; font-size: 14px;">
                        <table style="width: 50%">
                            <tr>
                                <td>Sakit</td>
                                <td>: {{$absent->sakit}} Hari</td>
                            </tr>
                            <tr>
                                <td>Izin</td>
                                <td>: {{$absent->izin}} Hari</td>
                            </tr>
                            <tr>
                                <td>Tanpa Keterangan</td>
                                <td>: {{$absent->tanpa_keterangan}} Hari</td>
                            </tr>
                        </table>
                    </div>
                    @if ($semester->semester == "GENAP")
                        <div class="keputusan" style="font-size: 14px;float: right">
                            <table style="width: 50%">
                                <tr>
                                    <td style=""><strong>Keputusan:</strong></td>
                                </tr>
                                <tr>
                                    <td style="">Berdasarkan pencapaian seluruh kompetensi,<td>
                                </tr>
                                <tr>
                                    <td style="">maka Peserta Didik dinyatakan:<td>
                                </tr>
                                <tr>
                                    @if ($uplevel->status == 1)
                                        @if ($sublevel->level->kelas == 6)
                                            <td style=""><strong>Lulus</strong><td>
                                        @else
                                            <td style=""><strong>Naik Ke Kelas {{$sublevel->level->kelas + 1}}</strong><td>     
                                        @endif
                                    @else
                                        <td style=""><strong>Tinggal Kelas {{$sublevel->level->kelas}}</strong><td>
                                    @endif
                                </tr>
                                
                            </table>
                        </div>
                    @endif
                </div>
                
            </div>

            <div class="tanda-tangan" style="font-size:14px;clear: left;clear: right;">
                <table style="width: 100%">
                    <tr>    
                        <td style="width:50%"></td>
                        <td style="text-align: center;">{{$school->desa}}, {{Date("d")}} {{bulan(Date("m"))}} {{Date("Y")}}</td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">Orang Tua/ Wali</td>
                        <td style="text-align: center;">Guru Kelas</td>   
                    </tr>
                    <tr>
                        <td style="text-align: center;height:80px;vertical-align:bottom"><strong>{{$student->nama_ayah}}</strong></td>
                        <td style="text-align: center;height:80px;vertical-align:bottom"><strong><u>{{$teacher->nama}}<u></strong></td>
                    </tr>
                    <tr>
                        <th style=""></th>
                        <th style="">
                            @if ($teacher->nik)
                                <strong>NIK. {{$teacher->nik}}</strong>
                            @else
                                <strong>NIK. -</strong>
                            @endif
                        </th>
                    </tr>

                </table >
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
                                <strong>NIK. {{$kepalasekolah->nik}}</strong>
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