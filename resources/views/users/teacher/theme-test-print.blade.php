<!doctype html>
<html lang="en">
  <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <style>
            body{
                font-family: Arial, Helvetica, sans-serif;
            }

            li{
                font-family: DejaVu Sans, sans-serif;
            }
        </style>

    </head>
    <body>

        <div class="header">
            <table style="width: 100%">
                <tr>
                    <td style="width:10%; text-align:center"><img src="{{public_path('img/yabam.jpeg')}}" alt="logo_sdit" style="width: 135px"></td>
                    <td>
                        <div class="header" style="font-size: 32px; text-align: center">
                            <strong> {{ strtoupper($school->nama_sekolah) }} </strong> 
                        </div>
                        <div class="header" style="font-size: 15px; text-align: center">
                            Alamat :  {{ $school->alamat }}, Desa {{ $school->desa }}, Kec. {{ $school->kecamatan }}, Kab. {{ $school->kota}}
                        </div>
                    </td>
                    <td style="width:10%"></td>
                </tr>
            </table>
        </div>
        

        <hr style="border-width:1.5;">

        <div class="title">
            <h2 style="text-align: center">Ujian {{ $scoreratio->period }}</h2>
            <table style="width: 100%">
                <tr>
                    <td style="width: 25%"></td>
                    <td style="width: 25%">Mata Pelajaran</td>
                    <td style="width: 25%">: {{ $themesubject->tema }}</td>
                    <td style="width: 25%"></td>
                </tr>
                <tr>
                    <td style="width: 25%"></td>
                    <td style="width: 25%">Kelas</td>
                    <td style="width: 25%">: {{ $themesubject->level->kelas }}</td>
                    <td style="width: 25%"></td>
                </tr>
                <tr>
                    <td style="width: 25%"></td>
                    <td style="width: 25%">Tahun Ajaran / Semester</td>
                    <td style="width: 25%">: {{ Year::thisSemester()->year->awal }}-{{ Year::thisSemester()->year->akhir }} / {{ Year::thisSemester()->semester }}</td>
                    <td style="width: 25%"></td>
                </tr>
            </table>
        </div>

        <div class="identity" style="margin-top: 20px">
            <table>
                <tr>
                    <td style="width:15%">Nama</td>
                    <td style="width:250px; border: 1px solid black; height:35px">:</td>
                </tr>
            </table>
        </div>

        <hr>

        <section class="main" style="font-size: 16px">

            @if (Test::objectiveThemeQuestion($themesubject->id, $scoreratio->id) > 0)
                <div class="objective-answer" style="margin-top: 10px">
                    <h3><i>Pilihlah jawaban objective dengan benar</i> </h3>                      
                    <table style="width: 100%;">
                        @foreach ($questions as $question)
                            @if ($question->answer_type == 'objective')
                                <tr >
                                    <td style="width: 15px" align="right" valign="top">{{ $question->number }}.</td>
                                    <td>
                                        @if ($question->image)
                                            <div class="image">
                                                <img src="{{public_path('img/test/' . $question->image)}}" alt="gambar_soal" style="width: 135px">
                                            </div>
                                        @endif
        
                                        @if ($question->explanation)
                                        <div class="explanation">
                                            {{ ucfirst($question->explanation) }}
                                        </div>
                                        @endif
        
                                        <div class="question">
                                            {{ ucfirst($question->question) }}
                                        </div>
        
                                        <table>
                                            @foreach (Test::answer($question->id) as $item)
                                                <tr>
                                                    <td>{{ $item->option }}.</td>
                                                    <td>{{ $item->detail }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        
                                    </td>
                                </tr>
                                <tr style="width: 25px">
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            @endif

            @if (Test::essayThemeQuestion($themesubject->id, $scoreratio->id) > 0)
                <div class="essay-answer" style="margin-top: 10px">
                    <h3><i>Isilah soal-soal berikut dengan benar</i></h3>                            
                    <table style="width: 100%;">
                        @foreach ($questions as $question)
                            @if ($question->answer_type == 'essay')
                                <tr >
                                    <td style="width: 15px" align="right" valign="top">{{ $question->number }}.</td>
                                    <td>
                                        @if ($question->image)
                                            <div class="image">
                                                <img src="{{public_path('img/test/' . $question->image)}}" alt="gambar_soal" style="width: 135px">
                                            </div>
                                        @endif
        
                                        @if ($question->explanation)
                                        <div class="explanation">
                                            {{ ucfirst($question->explanation) }}
                                        </div>
                                        @endif
        
                                        <div class="question">
                                            {{ ucfirst($question->question) }}
                                        </div>

                                        <div class="essay" style="border: 1px solid black; width:100%; height: 100px">
    
                                        </div>
                                    </td>
                                </tr>
                                <tr style="width: 25px">
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </div>
            @endif

            <div class="footer" style="margin-top: 20px">
                <table style="width: 100%">
                    
                </table>
            </div>
            
            
        </section>
    </body>
</html>